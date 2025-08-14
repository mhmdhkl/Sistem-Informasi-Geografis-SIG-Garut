<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Demografi;
use Illuminate\Http\Request;

class DemografiCrudController extends Controller
{
    public function index()
    {
        $demografis = Demografi::orderBy('nama_kecamatan')->get();
        return view('admin.demografi.index', compact('demografis'));
    }

    public function create()
    {
        return view('admin.demografi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kecamatan' => 'required|string|max:255',
            'jumlah_penduduk' => 'required|integer',
            'luas_wilayah' => 'required|numeric',
            'tahun' => 'required|integer|min:2000',
        ]);

        Demografi::create($request->all());

        return redirect()->route('admin.demografi.index')->with('success', 'Data demografi berhasil ditambahkan.');
    }

    public function edit(Demografi $demografi)
    {
        return view('admin.demografi.edit', compact('demografi'));
    }

    public function update(Request $request, Demografi $demografi)
    {
        $request->validate([
            'nama_kecamatan' => 'required|string|max:255',
            'jumlah_penduduk' => 'required|integer',
            'luas_wilayah' => 'required|numeric',
            'tahun' => 'required|integer|min:2000',
        ]);

        $demografi->update($request->all());

        return redirect()->route('admin.demografi.index')->with('success', 'Data demografi berhasil diperbarui.');
    }

    public function destroy(Demografi $demografi)
    {
        $demografi->delete();
        return redirect()->route('admin.demografi.index')->with('success', 'Data demografi berhasil dihapus.');
    }
}