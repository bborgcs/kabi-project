<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SightingController;
use App\Http\Controllers\SpeciesController;
use App\Http\Controllers\DeadbirdController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.register');
});

Route::get('/home', function () {
    return view('home');
})->name('home')->middleware(['auth', 'verified']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('/sightings', SightingController::class)->middleware(['auth', 'verified']);
Route::get('/report/sightings', [SightingController::class, 'report'])->name('report.sightings')->middleware(['auth', 'verified']);
Route::post('/sightings', [SightingController::class, 'store'])->name('sightings.store');


Route::resource('/species', SpeciesController::class)->middleware(['auth', 'verified']);
Route::get('/report/species', [SpeciesController::class, 'report'])->name('report.species')->middleware(['auth', 'verified']);
Route::post('/species/modal-store', [SpeciesController::class, 'modalStore'])->name('species.modalStore');

Route::resource('/deadbirds', DeadbirdController::class)->middleware(['auth', 'verified']);
Route::get('/report/deadbirds', [DeadbirdController::class, 'report'])->name('report.deadbirds')->middleware(['auth', 'verified']);
Route::post('/deadbirds', [DeadbirdController::class, 'store'])->name('deadbirds.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
