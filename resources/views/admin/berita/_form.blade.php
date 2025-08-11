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

<div class="space-y-4">
    <div>
        <label for="judul" class="block font-medium text-sm text-gray-700">Judul Berita</label>
        <input type="text" name="judul" id="judul" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('judul', $berita->judul ?? '') }}" required>
    </div>

    <div>
        <label for="kutipan_singkat" class="block font-medium text-sm text-gray-700">Kutipan Singkat</label>
        <input type="text" name="kutipan_singkat" id="kutipan_singkat" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('kutipan_singkat', $berita->kutipan_singkat ?? '') }}" required>
    </div>

    <div>
        <label for="isi_berita" class="block font-medium text-sm text-gray-700">Isi Berita Lengkap</label>
        <textarea name="isi_berita" id="isi_berita" rows="8" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>{{ old('isi_berita', $berita->isi_berita ?? '') }}</textarea>
    </div>

    <div>
        <label for="sumber_url" class="block font-medium text-sm text-gray-700">URL Sumber Berita</label>
        <input type="url" name="sumber_url" id="sumber_url" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('sumber_url', $berita->sumber_url ?? '') }}" required>
    </div>

    <div>
        <label for="gambar" class="block font-medium text-sm text-gray-700">Gambar Berita</label>
        <input type="file" name="gambar" id="gambar" class="mt-1 block w-full">
        @if(isset($berita) && $berita->gambar)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar saat ini" class="h-32 rounded">
                <small class="text-gray-500">Kosongkan jika tidak ingin mengganti gambar.</small>
            </div>
        @endif
    </div>
</div>

<div class="mt-6 flex justify-end">
    <a href="{{ route('berita.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded mr-2">Batal</a>
    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Simpan
    </button>
</div>