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
        $sort = $request->get('sort', 'asc');
        $per_page = $request->get('per_page', 10);
        $search = $request->get('search');

        $query = Lokasi::where('kategori', $kategori);

        if ($search) {
            $query->where('nama_lokasi', 'like', '%' . $search . '%');
        }

        $query->orderBy('nama_lokasi', $sort);

        if ($per_page == 'all') {
            $lokasis = $query->get();
        } else {
            $lokasis = $query->paginate(is_numeric($per_page) ? $per_page : 10);
        }

        return view('admin.lokasi.index', compact('lokasis', 'kategori', 'sort', 'per_page', 'search'));
    }

    public function create()
    {
        $kategori = Lokasi::select('kategori')->distinct()->get();
        return view('admin.lokasi.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lokasi' => 'required|string|max:255',
            'kategori' => 'required|string',
            'deskripsi' => 'required|string',
            'alamat' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ticket_url' => 'nullable|url',
        ]);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('lokasi', 'public');
            $validatedData['foto'] = $path;
        }

        Lokasi::create($validatedData);

        return redirect()->route('lokasi.index', ['kategori' => $request->kategori])->with('success', 'Lokasi berhasil ditambahkan.');
    }

    public function edit(Lokasi $lokasi)
    {
        $kategori = Lokasi::select('kategori')->distinct()->get();
        return view('admin.lokasi.edit', compact('lokasi', 'kategori'));
    }

    public function update(Request $request, Lokasi $lokasi)
    {
        $validatedData = $request->validate([
            'nama_lokasi' => 'required|string|max:255',
            'kategori' => 'required|string',
            'deskripsi' => 'required|string',
            'alamat' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ticket_url' => 'nullable|url',
        ]);

        if ($request->hasFile('foto')) {
            if ($lokasi->foto) {
                Storage::disk('public')->delete($lokasi->foto);
            }
            $path = $request->file('foto')->store('lokasi', 'public');
            $validatedData['foto'] = $path;
        }

        $lokasi->update($validatedData);

        return redirect()->route('lokasi.index', ['kategori' => $request->kategori])->with('success', 'Lokasi berhasil diperbarui.');
    }

    public function destroy(Lokasi $lokasi)
    {
        $kategori = $lokasi->kategori;
        if ($lokasi->foto) {
            Storage::disk('public')->delete($lokasi->foto);
        }
        $lokasi->delete();
        return redirect()->route('lokasi.index', ['kategori' => $kategori])->with('success', 'Lokasi berhasil dihapus.');
    }
}