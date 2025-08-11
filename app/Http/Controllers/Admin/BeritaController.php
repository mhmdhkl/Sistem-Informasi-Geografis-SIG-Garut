<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    /**
     * Menampilkan halaman daftar berita.
     */
    public function index()
    {
        $beritas = Berita::latest()->paginate(10);
        return view('admin.berita.index', compact('beritas'));
    }

    /**
     * Menampilkan form untuk menambah berita baru.
     */
    public function create()
    {
        return view('admin.berita.create');
    }

    /**
     * Menyimpan berita baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kutipan_singkat' => 'required|string|max:255',
            'isi_berita' => 'required|string',
            'sumber_url' => 'required|url',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $gambarPath = $request->file('gambar')->store('berita-gambar', 'public');

        Berita::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'kutipan_singkat' => $request->kutipan_singkat,
            'isi_berita' => $request->isi_berita,
            'sumber_url' => $request->sumber_url,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('berita.index')->with('success', 'Data berita berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit berita.
     */
    public function edit(Berita $berita)
    {
        return view('admin.berita.edit', compact('berita'));
    }

    /**
     * Mengupdate berita di database.
     */
    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kutipan_singkat' => 'required|string|max:255',
            'isi_berita' => 'required|string',
            'sumber_url' => 'required|url',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $gambarPath = $berita->gambar;
        if ($request->hasFile('gambar')) {
            if ($gambarPath) {
                Storage::disk('public')->delete($gambarPath);
            }
            $gambarPath = $request->file('gambar')->store('berita-gambar', 'public');
        }

        $berita->update([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'kutipan_singkat' => $request->kutipan_singkat,
            'isi_berita' => $request->isi_berita,
            'sumber_url' => $request->sumber_url,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('berita.index')->with('success', 'Data berita berhasil diperbarui.');
    }

    /**
     * Menghapus berita dari database.
     */
    public function destroy(Berita $berita)
    {
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Data berita berhasil dihapus.');
    }
}