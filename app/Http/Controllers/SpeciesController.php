<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Species;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class SpeciesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Species::class);
        $species = Species::all();
        return view('species.index', compact('species'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Species::class);
        $species = Species::all();
        return view('species.create', compact('species'));
    }

    public function modalStore(Request $request)
{
    $species = Species::create([
        'common_name' => $request->common_name,
        'scientific_name' => $request->scientific_name,
    ]);

    return response()->json([
        'success' => true,
        'species' => $species
    ]);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Species::class);

            $species = new Species();
            $species->common_name = mb_strtoupper($request->common_name, 'UTF-8');
            $species->scientific_name = $request->scientific_name;
            $species->save();

        return redirect()->route('species.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        Gate::authorize('view', Species::class);
        

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $species = Species::find($id);
        Gate::authorize('update', $species);

        if($species) {
            return view('species.edit', compact(['species']));
        }

        return redirect()->route('species.index');
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, string $id)
{
    $species = Species::find($id);
    Gate::authorize('update', $species);


    if($species) {
            $species = new Species();
            $species->common_name = mb_strtoupper($request->common_name, 'UTF-8');
            $species->scientific_name = $request->scientific_name;
            $species->save();
    }

    return redirect()->route('species.index');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $species = Species::find($id);
        Gate::authorize('delete', $species);

        if($species) {
            
            $species->delete();
        }

        return redirect()->route('species.index');
    }

}