<?php

// PERBAIKAN UTAMA ADA DI BARIS INI
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LayerController extends Controller
{
    public function index()
    {
        $layers = Layer::all();
        return view('admin.layers.index', compact('layers'));
    }

    public function create()
    {
        return view('admin.layers.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama_layer' => 'required|string|max:255|unique:layers,nama_layer',
            'deskripsi' => 'nullable|string',
            'geojson_file' => 'required|file',
        ]);
        
        $extension = $request->file('geojson_file')->getClientOriginalExtension();
        if (!in_array(strtolower($extension), ['geojson', 'json'])) {
            return back()->withErrors(['geojson_file' => 'File harus berekstensi .geojson atau .json']);
        }

        // Simpan file dan dapatkan path-nya
        $path = $request->file('geojson_file')->store('geojson_layers', 'public');

        Layer::create([
            'nama_layer' => $request->nama_layer,
            'deskripsi' => $request->deskripsi,
            'geojson_path' => $path, // Pastikan nama kolom di DB adalah 'geojson_path'
        ]);

        return redirect()->route('layers.index')->with('success', 'Layer GeoJSON berhasil diunggah.');
    }

    public function edit(Layer $layer)
    {
        return view('admin.layers.edit', compact('layer'));
    }

    public function update(Request $request, Layer $layer)
    {
        $request->validate([
            'nama_layer' => 'required|string|max:255|unique:layers,nama_layer,' . $layer->id,
            'deskripsi' => 'nullable|string',
            'geojson_file' => 'nullable|file', // Opsional saat update
        ]);
        
        // Cek ekstensi jika ada file baru
        if ($request->hasFile('geojson_file')) {
            $extension = $request->file('geojson_file')->getClientOriginalExtension();
            if (!in_array(strtolower($extension), ['geojson', 'json'])) {
                return back()->withErrors(['geojson_file' => 'File harus berekstensi .geojson atau .json']);
            }
        }

        $dataToUpdate = $request->only('nama_layer', 'deskripsi');

        if ($request->hasFile('geojson_file')) {
            // Hapus file lama jika ada
            if ($layer->geojson_path && Storage::disk('public')->exists($layer->geojson_path)) {
                Storage::disk('public')->delete($layer->geojson_path);
            }

            // Simpan file baru dan dapatkan path-nya
            $path = $request->file('geojson_file')->store('geojson_layers', 'public');
            $dataToUpdate['geojson_path'] = $path;
        }

        $layer->update($dataToUpdate);

        return redirect()->route('layers.index')->with('success', 'Layer berhasil diperbarui.');
    }

    public function destroy(Layer $layer)
    {
        // Hapus file dari storage sebelum menghapus record dari DB
        if ($layer->geojson_path && Storage::disk('public')->exists($layer->geojson_path)) {
            Storage::disk('public')->delete($layer->geojson_path);
        }
        
        $layer->delete();

        return redirect()->route('layers.index')->with('success', 'Layer berhasil dihapus.');
    }
}