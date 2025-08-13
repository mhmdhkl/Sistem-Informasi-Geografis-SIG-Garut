<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lokasi; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 

class LokasiController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->get('kategori', 'Pariwisata');

        $lokasis = Lokasi::where('kategori', $kategori)->latest()->paginate(10);

        return view('admin.lokasi.index', compact('lokasis', 'kategori'));
    }


    public function create()
    {
        return view('admin.lokasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lokasi' => 'required|string|max:255',
            'kategori' => 'required|string',
            'deskripsi' => 'required|string',
            'alamat' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('lokasi-foto', 'public');
        }

        Lokasi::create([
            'nama_lokasi' => $request->nama_lokasi,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'alamat' => $request->alamat,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('lokasi.index')->with('success', 'Data lokasi berhasil ditambahkan.');
    }


    public function edit(Lokasi $lokasi)
    {
        return view('admin.lokasi.edit', compact('lokasi'));
    }


    public function update(Request $request, Lokasi $lokasi)
    {
        $request->validate([
            'nama_lokasi' => 'required|string|max:255',
            'kategori' => 'required|string',
            'deskripsi' => 'required|string',
            'alamat' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fotoPath = $lokasi->foto;
        if ($request->hasFile('foto')) {
            if ($fotoPath) {
                Storage::disk('public')->delete($fotoPath);
            }
            $fotoPath = $request->file('foto')->store('lokasi-foto', 'public');
        }

        $lokasi->update([
            'nama_lokasi' => $request->nama_lokasi,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'alamat' => $request->alamat,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('lokasi.index')->with('success', 'Data lokasi berhasil diperbarui.');
    }

    public function destroy(Lokasi $lokasi)
    {
        if ($lokasi->foto) {
            Storage::disk('public')->delete($lokasi->foto);
        }

        $lokasi->delete();

        return redirect()->route('lokasi.index')->with('success', 'Data lokasi berhasil dihapus.');
    }
}