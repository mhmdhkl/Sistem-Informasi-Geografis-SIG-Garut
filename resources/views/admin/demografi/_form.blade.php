<div class="mb-4">
    <label for="nama_kecamatan" class="block text-sm font-medium text-gray-700">Nama Kecamatan</label>
    <input type="text" name="nama_kecamatan" id="nama_kecamatan" value="{{ old('nama_kecamatan', $demografi->nama_kecamatan ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
</div>
<div class="mb-4">
    <label for="jumlah_penduduk" class="block text-sm font-medium text-gray-700">Jumlah Penduduk</label>
    <input type="number" name="jumlah_penduduk" id="jumlah_penduduk" value="{{ old('jumlah_penduduk', $demografi->jumlah_penduduk ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
</div>
<div class="mb-4">
    <label for="luas_wilayah" class="block text-sm font-medium text-gray-700">Luas Wilayah (km²)</label>
    <input type="text" name="luas_wilayah" id="luas_wilayah" value="{{ old('luas_wilayah', $demografi->luas_wilayah ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required placeholder="Contoh: 150.75">
</div>
<div class="mb-4">
    <label for="tahun" class="block text-sm font-medium text-gray-700">Tahun Data</label>
    <input type="number" name="tahun" id="tahun" value="{{ old('tahun', $demografi->tahun ?? date('Y')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required placeholder="Contoh: 2024">
</div>

<div>
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
    <a href="{{ route('admin.demografi.index') }}" class="text-gray-600 hover:text-gray-900 ml-4">Batal</a>
</div>