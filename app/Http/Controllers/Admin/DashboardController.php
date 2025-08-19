<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layer;
use App\Models\Lokasi;
use App\Models\Statistik;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalLokasi = Lokasi::count();
        $totalLayer = Layer::count();
        $totalStatistik = Statistik::count();

        return view('dashboard', compact('totalLokasi', 'totalLayer', 'totalStatistik'));
    }
}