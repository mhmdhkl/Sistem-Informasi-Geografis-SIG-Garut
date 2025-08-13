<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layer;
use Illuminate\Http\Request;

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
            'nama_layer' => 'required|string|unique:layers,nama_layer',
            'deskripsi' => 'nullable|string',
            'tipe' => 'required|string|in:katalog,lapisan', // Validasi baru
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
            'tipe' => $request->tipe, // Simpan data tipe
            'geojson_content' => $content,
        ]);

        return redirect()->route('layers.index')->with('success', 'Layer GeoJSON berhasil diunggah.');
    }

    public function destroy(Layer $layer)
    {
        $layer->delete();
        return redirect()->route('layers.index')->with('success', 'Layer berhasil dihapus.');
    }
}