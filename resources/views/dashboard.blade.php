<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4">Selamat Datang, {{ Auth::user()->name }}!</h3>
                    <p>Ini adalah halaman dashboard admin untuk Sistem Informasi Geografis Garut. Silakan gunakan menu di samping untuk mengelola konten website.</p>
                </div>
            </div>

            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h4 class="text-lg font-semibold text-gray-500">Total Lokasi</h4>
                    <p class="text-3xl font-bold mt-2 text-blue-600"> {{-- Nanti kita isi dengan data dinamis --}} </p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h4 class="text-lg font-semibold text-gray-500">Total Berita</h4>
                    <p class="text-3xl font-bold mt-2 text-green-600"> {{-- Nanti kita isi dengan data dinamis --}} </p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h4 class="text-lg font-semibold text-gray-500">Data Statistik</h4>
                    <p class="text-3xl font-bold mt-2 text-yellow-600"> {{-- Nanti kita isi dengan data dinamis --}} </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>