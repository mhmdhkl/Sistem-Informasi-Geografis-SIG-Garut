<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Statistik; 
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statistiks = Statistik::all();
        return response()->json($statistiks);
    }
}