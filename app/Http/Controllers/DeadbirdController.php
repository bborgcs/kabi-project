<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sighting;
use App\Models\Species;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class DeadbirdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Sighting::class);
        $sightings = Sighting::all();
        return view('deadbirds.index', compact('sightings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Sighting::class);
        $species = Species::select('id', 'common_name', 'scientific_name')->get();
        return view('deadbirds.create', compact('species'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Sighting::class);

        $species = Species::find($request->species_id);

        if ($species) {

            $sighting = new Sighting();
            $sighting->gender = $request->gender;
            $sighting->found_location = $request->found_location;
            $sighting->description = $request->description;
            $sighting->life_status = "morto";
            $sighting->user_id = auth()->user()->id;

            $sighting->species()->associate($species);
            $sighting->save();

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $name = 'deadbird_'.$sighting->id.'_'.time().'.'.$file->getClientOriginalExtension();

                $file->storeAs('deadbirds', $name, 'public');

                $image = \App\Models\Image::create([
                    'image_path' => 'deadbirds/'.$name
                ]);

                $sighting->image_id = $image->id;
                $sighting->save();
            }
        }

        return redirect()->route('deadbirds.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        Gate::authorize('view', Sighting::class);
    }

    /**
     * Show the form for editing the specified resource.
     */

   
    public function edit(string $id)
{
    $sighting = Sighting::findOrFail($id);

    Gate::authorize('update', $sighting);

    if ($sighting) {
        $species = Species::all();
        return view('deadbirds.edit', compact('sighting', 'species'));
    }

    return redirect()->route('deadbirds.index');
}


    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, string $id)
    {
        $sighting = Sighting::find($id);
        Gate::authorize('update', $sighting);

        $species = Species::find($request->species_id);

        if ($sighting && $species) {

            $sighting->gender = $request->gender;
            $sighting->found_location = $request->found_location;
            $sighting->description = $request->description;
            $sighting->species()->associate($species);

            if ($request->hasFile('foto')) {

                if ($sighting->image && Storage::disk('public')->exists($sighting->image->image_path)) {
                    Storage::disk('public')->delete($sighting->image->image_path);
                }

                $file = $request->file('foto');
                $name = 'deadbird_'.$sighting->id.'_'.time().'.'.$file->getClientOriginalExtension();
                $file->storeAs('deadbirds', $name, 'public');

                if ($sighting->image) {
                    $sighting->image->update([
                        'image_path' => 'deeadbirds/'.$name
                    ]);
                } else {
                    $image = \App\Models\Image::create([
                        'image_path' => 'deadbirds/'.$name
                    ]);
                    $sighting->image_id = $image->id;
                }
            }

            $sighting->save();
        }

        return redirect()->route('deadbirds.index');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sighting = Sighting::find($id);
        Gate::authorize('delete', $sighting);

        if ($sighting) {

            if ($sighting->image && Storage::disk('public')->exists($sighting->image->image_path)) {
                Storage::disk('public')->delete($sighting->image->image_path);
            }

            if ($sighting->image) {
                $sighting->image->delete();
            }

            $sighting->delete();
        }

        return redirect()->route('deadbirds.index');
    }


    /**
     * Generate PDF report.
     */
    public function report()
    {
        $sightings = Sighting::with(['species', 'image'])
                            ->where('life_status', 'morto')
                            ->get();

        $pdf = Pdf::loadView('deadbirds.report', compact('sightings'));

        return $pdf->stream('passarosmortos.pdf');
    }

}