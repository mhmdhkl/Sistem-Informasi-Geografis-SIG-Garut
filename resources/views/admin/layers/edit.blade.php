<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Layer Peta') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6">Formulir Edit Layer</h3>

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-5" role="alert">
                            <strong class="font-bold">Error!</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>- {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('layers.update', $layer->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="space-y-4">
                            <div>
                                <label for="nama_layer" class="block font-medium text-sm text-gray-700">Nama Layer (Identifier)</label>
                                <input type="text" name="nama_layer" id="nama_layer" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm font-mono" value="{{ old('nama_layer', $layer->nama_layer) }}" required>
                                <p class="text-xs text-gray-500 mt-1">Nama ini akan digunakan di URL API, misal: /api/layers/batas_desa.</p>
                            </div>
                            <div>
                                <label for="deskripsi" class="block font-medium text-sm text-gray-700">Deskripsi Singkat</label>
                                <input type="text" name="deskripsi" id="deskripsi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('deskripsi', $layer->deskripsi) }}">
                            </div>
                            <div>
                                <label for="geojson_file" class="block font-medium text-sm text-gray-700">File GeoJSON (.geojson)</label>
                                <input type="file" name="geojson_file" id="geojson_file" class="mt-1 block w-full" accept=".geojson,application/json">
                                <p class="mt-1 text-sm text-gray-500">Kosongkan jika tidak ingin mengubah file yang sudah ada.</p>
                                @if ($layer->geojson_path)
                                    <p class="text-xs text-green-600 mt-1">File saat ini: {{ basename($layer->geojson_path) }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <a href="{{ route('layers.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded mr-2">Batal</a>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Perbarui Layer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>