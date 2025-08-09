<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LokasiController;      
use App\Http\Controllers\Api\StatistikController;  

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/lokasi', [LokasiController::class, 'index']);


Route::get('/statistik', [StatistikController::class, 'index']);