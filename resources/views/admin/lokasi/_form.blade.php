@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-5" role="alert">
        <strong class="font-bold">Oops!</strong>
        <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
        <ul>
            @foreach ($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label for="nama_lokasi" class="block font-medium text-sm text-gray-700">Nama Lokasi</label>
        <input type="text" name="nama_lokasi" id="nama_lokasi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('nama_lokasi', $lokasi->nama_lokasi ?? '') }}" required>
    </div>
    <div>
    <label for="kategori" class="block font-medium text-sm text-gray-700">Kategori</label>
        @php
            // Ambil kategori dari URL saat membuat data, atau dari data yang ada saat mengedit
            $defaultKategori = request()->get('kategori', 'Pariwisata');
            $currentKategori = $lokasi->kategori ?? $defaultKategori;
        @endphp
        <input type="text" name="kategori" id="kategori" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100" value="{{ $currentKategori }}" readonly>
    </div>
    <div class="md:col-span-2">
        <label for="alamat" class="block font-medium text-sm text-gray-700">Alamat</label>
        <textarea name="alamat" id="alamat" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>{{ old('alamat', $lokasi->alamat ?? '') }}</textarea>
    </div>
     <div class="md:col-span-2">
        <label for="deskripsi" class="block font-medium text-sm text-gray-700">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>{{ old('deskripsi', $lokasi->deskripsi ?? '') }}</textarea>
    </div>
    <div>
        <label for="latitude" class="block font-medium text-sm text-gray-700">Latitude</label>
        <input type="text" name="latitude" id="latitude" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('latitude', $lokasi->latitude ?? '') }}" required>
    </div>
    <div>
        <label for="longitude" class="block font-medium text-sm text-gray-700">Longitude</label>
        <input type="text" name="longitude" id="longitude" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('longitude', $lokasi->longitude ?? '') }}" required>
    </div>
    <div class="md:col-span-2">
        <label for="foto" class="block font-medium text-sm text-gray-700">Foto Lokasi</label>
        <input type="file" name="foto" id="foto" class="mt-1 block w-full">
        @if(isset($lokasi) && $lokasi->foto)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $lokasi->foto) }}" alt="Foto saat ini" class="h-32 rounded">
            </div>
        @endif
    </div>
</div>
<div class="mt-6 flex justify-end">
    <a href="{{ route('lokasi.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded mr-2">Batal</a>
    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Simpan
    </button>
</div>