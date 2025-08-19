<?php

namespace App\Http\Controllers;

use App\Models\Statistik;
use Illuminate\Http\Request;

class DemografiController extends Controller
{
    /**
     * Menampilkan halaman demografi dengan data statistik dan grafik.
     */
    public function index()
    {
        $statistik = Statistik::all()->keyBy('nama_data');

        
        $jumlahKecamatan = $statistik['jumlah_kecamatan']->nilai_data ?? 0;
        $jumlahDesa = $statistik['jumlah_desa']->nilai_data ?? 0;

        
        $chartData = [
            'labels' => ['Jumlah Kecamatan', 'Jumlah Desa/Kelurahan'],
            'data'   => [$jumlahKecamatan, $jumlahDesa],
        ];

        return view('demografi', compact('statistik', 'chartData'));
    }
}