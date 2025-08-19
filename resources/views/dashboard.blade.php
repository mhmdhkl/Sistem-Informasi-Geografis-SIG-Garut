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
                    <p>Ini adalah halaman dashboard admin untuk Sistem Informasi Geografis Garut. Silakan gunakan menu di atas untuk mengelola konten website.</p>
                </div>
            </div>

            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Kartu Total Layer -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h4 class="text-lg font-semibold text-gray-500">Total Layer Peta</h4>
                    <p class="text-3xl font-bold mt-2 text-blue-600">{{ $totalLayer }}</p>
                    <a href="{{ route('layers.index') }}" class="mt-4 inline-block text-blue-500 hover:underline">
                        Kelola Layer →
                    </a>
                </div>
                <!-- Kartu Total Lokasi -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h4 class="text-lg font-semibold text-gray-500">Total Lokasi</h4>
                    <p class="text-3xl font-bold mt-2 text-green-600">{{ $totalLokasi }}</p>
                    <a href="{{ route('lokasi.index') }}" class="mt-4 inline-block text-green-500 hover:underline">
                        Kelola Lokasi →
                    </a>
                </div>
                <!-- Kartu Total Data Statistik -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h4 class="text-lg font-semibold text-gray-500">Total Data Statistik</h4>
                    <p class="text-3xl font-bold mt-2 text-yellow-600">{{ $totalStatistik }}</p>
                    <a href="{{ route('statistik.index') }}" class="mt-4 inline-block text-yellow-500 hover:underline">
                        Kelola Statistik →
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>