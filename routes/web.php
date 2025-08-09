<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetaController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [PetaController::class, 'index'])->name('home');


Route::get('/peta/{tema}', [PetaController::class, 'peta'])->name('peta.tema');