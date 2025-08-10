<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Statistik;
use Illuminate\Http\Request;

class PetaController extends Controller
{
    public function index()
    {
        $statistik = Statistik::all()->keyBy('nama_data');

        $berita = Berita::latest()->take(6)->get();

        return view('welcome', compact('statistik', 'berita'));
    }

    public function peta($tema)
    {
        return view('peta', ['tema' => $tema]);
    }
    
    public function kumpulanPeta()
    {
        return view('kumpulan-peta');
    }

    public function demografi()
    {
        return view('demografi');
    }
}