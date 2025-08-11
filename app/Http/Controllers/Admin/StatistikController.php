<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Statistik;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    // Menampilkan halaman form edit statistik
    public function index()
    {
        $statistik = Statistik::all()->keyBy('nama_data');
        return view('admin.statistik.index', compact('statistik'));
    }

    // Menyimpan perubahan data statistik
    public function update(Request $request)
    {
        $data = $request->except('_token');

        foreach ($data as $key => $value) {
            Statistik::where('nama_data', $key)->update(['nilai_data' => $value]);
        }

        return redirect()->route('statistik.index')->with('success', 'Data statistik berhasil diperbarui.');
    }
}