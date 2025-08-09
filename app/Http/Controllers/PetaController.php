<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetaController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function peta($tema)
    {
        return view('peta', ['tema' => $tema]);
    }
}