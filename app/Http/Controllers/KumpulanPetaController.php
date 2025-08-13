<?php
namespace App\Http\Controllers;
use App\Models\Layer;

class KumpulanPetaController extends Controller
{
    public function index()
    {
        $katalogPeta = Layer::where('tipe', 'katalog')->get();
        return view('kumpulan-peta', compact('katalogPeta'));
    }
}