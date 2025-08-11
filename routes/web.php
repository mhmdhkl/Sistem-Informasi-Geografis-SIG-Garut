<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetaController;
use App\Http\Controllers\Admin\LokasiController;

// Halaman utama
Route::get('/', [PetaController::class, 'index'])->name('home');

// Halaman peta tematik (Budaya & Pariwisata)
Route::get('/peta/{tema}', [PetaController::class, 'peta'])->name('peta.tema');

// Halaman Kumpulan Peta
Route::get('/kumpulan-peta', [PetaController::class, 'kumpulanPeta'])->name('peta.kumpulan');

// Halaman Demografi
Route::get('/demografi', [PetaController::class, 'demografi'])->name('demografi');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/admin/lokasi', LokasiController::class);
});

require __DIR__.'/auth.php';