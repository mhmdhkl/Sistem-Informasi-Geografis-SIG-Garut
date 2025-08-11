<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Data Statistik') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6">Edit Statistik Halaman Utama</h3>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('statistik.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="space-y-4">
                            <div>
                                <label for="luas_wilayah" class="block font-medium text-sm text-gray-700">Luas Wilayah</label>
                                <input type="text" name="luas_wilayah" id="luas_wilayah" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ $statistik['luas_wilayah']->nilai_data ?? '' }}">
                            </div>
                            <div>
                                <label for="jumlah_penduduk" class="block font-medium text-sm text-gray-700">Jumlah Penduduk</label>
                                <input type="text" name="jumlah_penduduk" id="jumlah_penduduk" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ $statistik['jumlah_penduduk']->nilai_data ?? '' }}">
                            </div>
                            <div>
                                <label for="jumlah_kecamatan" class="block font-medium text-sm text-gray-700">Jumlah Kecamatan</label>
                                <input type="text" name="jumlah_kecamatan" id="jumlah_kecamatan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ $statistik['jumlah_kecamatan']->nilai_data ?? '' }}">
                            </div>
                             <div>
                                <label for="jumlah_desa" class="block font-medium text-sm text-gray-700">Jumlah Desa/Kelurahan</label>
                                <input type="text" name="jumlah_desa" id="jumlah_desa" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ $statistik['jumlah_desa']->nilai_data ?? '' }}">
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>