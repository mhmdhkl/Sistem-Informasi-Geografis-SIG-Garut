<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Layer;
use Illuminate\Http\Request;

class LayerController extends Controller
{
    public function show($nama_layer)
    {
        $layer = Layer::where('nama_layer', $nama_layer)->firstOrFail();
        return response()->json(json_decode($layer->geojson_content));
    }
}