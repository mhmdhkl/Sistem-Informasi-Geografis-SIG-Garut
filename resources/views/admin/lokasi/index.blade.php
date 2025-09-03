<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Lokasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold">Daftar Lokasi {{ $kategori }}</h3>
                        <a href="{{ route('lokasi.create', ['kategori' => $kategori]) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Tambah Data
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="mb-4">
                        <form action="{{ route('lokasi.index') }}" method="GET" class="flex items-center gap-2">
                            <input type="hidden" name="kategori" value="{{ $kategori }}">
                            <input type="text" name="search" placeholder="Cari nama lokasi..." class="w-full md:w-1/3 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ $search ?? '' }}">
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                Cari
                            </button>
                            @if($search)
                            <a href="{{ route('lokasi.index', ['kategori' => $kategori]) }}" class="text-sm text-gray-600 hover:underline">Reset</a>
                            @endif
                        </form>
                    </div>

                    <div class="flex justify-start items-center mb-4 space-x-2">
                        <label for="per_page" class="text-sm font-medium text-gray-700">Tampilkan:</label>
                        <select name="per_page" id="per_page" class="rounded-md border-gray-300 shadow-sm text-sm" onchange="window.location.href = this.value">
                            @php
                                $queryParams = request()->except('per_page');
                            @endphp
                            <option value="{{ route('lokasi.index', array_merge($queryParams, ['per_page' => 10])) }}" {{ $per_page == 10 ? 'selected' : '' }}>10</option>
                            <option value="{{ route('lokasi.index', array_merge($queryParams, ['per_page' => 25])) }}" {{ $per_page == 25 ? 'selected' : '' }}>25</option>
                            <option value="{{ route('lokasi.index', array_merge($queryParams, ['per_page' => 50])) }}" {{ $per_page == 50 ? 'selected' : '' }}>50</option>
                            <option value="{{ route('lokasi.index', array_merge($queryParams, ['per_page' => 'all'])) }}" {{ $per_page == 'all' ? 'selected' : '' }}>Semua</option>
                        </select>
                        <span class="text-sm text-gray-600">data per halaman.</span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="py-3 px-6 text-left">No</th>
                                    <th class="py-3 px-6 text-left">
                                        <a href="{{ route('lokasi.index', array_merge(request()->query(), ['sort' => $sort == 'asc' ? 'desc' : 'asc'])) }}" class="flex items-center hover:underline">
                                            Nama Lokasi
                                            @if($sort == 'asc')
                                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                                            @else
                                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="py-3 px-6 text-left">Kategori</th>
                                    <th class="py-3 px-6 text-left">Alamat</th>
                                    <th class="py-3 px-6 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($lokasis as $index => $lokasi)
                                    <tr class="border-b">
                                        <td class="py-3 px-6">{{ $lokasis instanceof \Illuminate\Pagination\LengthAwarePaginator ? $lokasis->firstItem() + $index : $index + 1 }}</td>
                                        <td class="py-3 px-6">{{ $lokasi->nama_lokasi }}</td>
                                        <td class="py-3 px-6">{{ $lokasi->kategori }}</td>
                                        <td class="py-3 px-6">{{ Str::limit($lokasi->alamat, 50) }}</td>
                                        <td class="py-3 px-6 text-center flex justify-center space-x-2">
                                            <a href="{{ route('lokasi.edit', $lokasi->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded">Edit</a>
                                            <form action="{{ route('lokasi.destroy', $lokasi->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-4 px-6 text-center text-gray-500">
                                            @if($search)
                                                Lokasi dengan nama "{{ $search }}" tidak ditemukan.
                                            @else
                                                Tidak ada data lokasi.
                                            @endif
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        
                        @if($lokasis instanceof \Illuminate\Pagination\LengthAwarePaginator && $lokasis->hasPages())
                            <div class="mt-4">
                                {{ $lokasis->appends(request()->query())->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>