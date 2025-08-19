<?php

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

        $content = $request->file('geojson_file')->get();

        Layer::create([
            'nama_layer' => $request->nama_layer,
            'deskripsi' => $request->deskripsi,
            'geojson_content' => $content, 
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
            'geojson_file' => 'nullable|file', 
        ]);

        
        $dataToUpdate = $request->only('nama_layer', 'deskripsi');

        
        if ($request->hasFile('geojson_file')) {
            $extension = $request->file('geojson_file')->getClientOriginalExtension();
            if (!in_array(strtolower($extension), ['geojson', 'json'])) {
                return back()->withErrors(['geojson_file' => 'File harus berekstensi .geojson atau .json']);
            }
            
            
            $dataToUpdate['geojson_content'] = $request->file('geojson_file')->get();
        }

        
        $layer->update($dataToUpdate);

        
        return redirect()->route('layers.index')->with('success', 'Layer berhasil diperbarui.');
    }

    public function destroy(Layer $layer)
    {
        
        $layer->delete();
        return redirect()->route('layers.index')->with('success', 'Layer berhasil dihapus.');
    }
}