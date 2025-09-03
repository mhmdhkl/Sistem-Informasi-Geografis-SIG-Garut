<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LokasiController extends Controller
{
    /**
     * Menampilkan daftar lokasi berdasarkan kategori.
     * Ini adalah gabungan dari kode LAMA dan BARU.
     */
    public function index(Request $request)
    {
        // Mengambil kategori dari URL, defaultnya 'Pariwisata' (seperti kode LAMA Anda)
        $kategori = $request->get('kategori', 'Pariwisata');

        // Mencari lokasi berdasarkan kategori tersebut
        $lokasis = Lokasi::where('kategori', $kategori)->latest()->paginate(10);

        // Mengirimkan KEDUA variabel ($lokasis dan $kategori) ke view
        return view('admin.lokasi.index', compact('lokasis', 'kategori'));
    }

    /**
     * Menampilkan form untuk membuat lokasi baru.
     * Menggunakan kode BARU agar ada dropdown.
     */
    public function create()
    {
        // Mengambil data kategori unik untuk dropdown di form
        $kategori = Lokasi::select('kategori')->distinct()->get();
        return view('admin.lokasi.create', compact('kategori'));
    }

    /**
     * Menyimpan lokasi baru ke database.
     * Menggunakan kode BARU yang sudah mendukung ticket_url.
     */
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
            $path = $request->file('foto')->store('public/lokasi');
            $validatedData['foto'] = basename($path);
        }

        Lokasi::create($validatedData);

        // Mengarahkan kembali ke halaman index dengan kategori yang sesuai
        return redirect()->route('lokasi.index', ['kategori' => $request->kategori])->with('success', 'Lokasi berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit lokasi.
     * Menggunakan kode BARU agar ada dropdown.
     */
    public function edit(Lokasi $lokasi)
    {
        // Mengambil data kategori unik untuk dropdown di form
        $kategori = Lokasi::select('kategori')->distinct()->get();
        return view('admin.lokasi.edit', compact('lokasi', 'kategori'));
    }

    /**
     * Memperbarui data lokasi di database.
     * Menggunakan kode BARU yang sudah mendukung ticket_url.
     */
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
                Storage::delete('public/lokasi/' . $lokasi->foto);
            }
            $path = $request->file('foto')->store('public/lokasi');
            $validatedData['foto'] = basename($path);
        }

        $lokasi->update($validatedData);

        // Mengarahkan kembali ke halaman index dengan kategori yang sesuai
        return redirect()->route('lokasi.index', ['kategori' => $request->kategori])->with('success', 'Lokasi berhasil diperbarui.');
    }

    /**
     * Menghapus data lokasi dari database.
     */
    public function destroy(Lokasi $lokasi)
    {
        $kategori = $lokasi->kategori;
        if ($lokasi->foto) {
            Storage::delete('public/lokasi/' . $lokasi->foto);
        }
        $lokasi->delete();
        return redirect()->route('lokasi.index', ['kategori' => $kategori])->with('success', 'Lokasi berhasil dihapus.');
    }
}