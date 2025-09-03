<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lokasis = Lokasi::all();
        return response()->json($lokasis);
    }

    /**
     * Search for a location by name.
     *
     * @param  string  $keyword
     * @return \Illuminate\Http\JsonResponse
     */
    public function search($keyword)
    {
        $lokasis = Lokasi::where('nama_lokasi', 'LIKE', '%' . $keyword . '%')->get();

        if ($lokasis->isNotEmpty()) {
            return response()->json([
                'success' => true,
                'data'    => $lokasis
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Lokasi tidak ditemukan'
            ], 404);
        }
    }
}