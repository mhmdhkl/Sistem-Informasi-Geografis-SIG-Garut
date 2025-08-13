<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetaController;
use App\Http\Controllers\Admin\LokasiController;
use App\Http\Controllers\Admin\StatistikController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\LayerController;
use App\Http\Controllers\KumpulanPetaController;

// Halaman utama
Route::get('/', [PetaController::class, 'index'])->name('home');

// Halaman peta tematik (Budaya & Pariwisata)
Route::get('/peta/{tema}', [PetaController::class, 'peta'])->name('peta.tema');

// Halaman Kumpulan Peta
Route::get('/kumpulan-peta', [KumpulanPetaController::class, 'index'])->name('peta.kumpulan');

// Halaman Demografi
Route::get('/demografi', [PetaController::class, 'demografi'])->name('demografi');

Route::get('/peta-layer/{nama_layer}', [PetaController::class, 'petaLayer'])->name('peta.layer');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    
    Route::get('/admin/lokasi', [LokasiController::class, 'index'])->name('lokasi.index');
    Route::get('/admin/lokasi/create', [LokasiController::class, 'create'])->name('lokasi.create');
    Route::post('/admin/lokasi', [LokasiController::class, 'store'])->name('lokasi.store');
    Route::get('/admin/lokasi/{lokasi}/edit', [LokasiController::class, 'edit'])->name('lokasi.edit');
    Route::put('/admin/lokasi/{lokasi}', [LokasiController::class, 'update'])->name('lokasi.update');
    Route::delete('/admin/lokasi/{lokasi}', [LokasiController::class, 'destroy'])->name('lokasi.destroy');

    Route::get('/admin/statistik', [StatistikController::class, 'index'])->name('statistik.index');
    Route::put('/admin/statistik', [StatistikController::class, 'update'])->name('statistik.update');

    Route::resource('/admin/berita', BeritaController::class)
         ->parameters(['berita' => 'berita']);

    Route::resource('/admin/layers', LayerController::class)
         ->parameters(['layers' => 'layer']);
});

require __DIR__.'/auth.php';