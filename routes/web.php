<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetaController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [PetaController::class, 'index'])->name('home');


Route::get('/peta/{tema}', [PetaController::class, 'peta'])->name('peta.tema');

Route::get('/kumpulan-peta', [PetaController::class, 'kumpulanPeta'])->name('peta.kumpulan');

Route::get('/demografi', [PetaController::class, 'demografi'])->name('demografi');