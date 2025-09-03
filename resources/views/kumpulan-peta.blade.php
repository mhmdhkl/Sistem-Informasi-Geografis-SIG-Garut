<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Peta - SIG Garut</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-6 py-12">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Galeri Peta Tematik</h1>
            <a href="{{ route('home') }}" class="text-blue-600 hover:underline">← Kembali ke Halaman Utama</a>
        </div>
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div class="relative w-full md:w-72">
                <input type="text" id="searchInput" placeholder="Cari peta..." class="w-full px-4 py-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
            
            <div class="w-full md:w-auto">
                <label for="sortSelect" class="sr-only">Urutkan</label>
                <select id="sortSelect" class="w-full px-8 py- border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="default">Urutkan Berdasarkan</option>
                    <option value="name-asc">Nama (A-Z)</option>
                    <option value="name-desc">Nama (Z-A)</option>
                </select>
            </div>
        </div>

        <div id="petaContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            
            <div class="peta-card bg-white rounded-lg shadow-md border border-gray-200 p-6 flex flex-col justify-between transform hover:scale-105 transition-transform" data-name="Pariwisata">
                <div>
                    <h2 class="text-xl font-bold mb-2">Pariwisata</h2>
                    <p class="text-gray-600 text-sm mb-4">Peta interaktif ini menampilkan berbagai destinasi pariwisata unggulan di Kabupaten Garut.</p>
                </div>
                <a href="{{ route('peta.tema', 'pariwisata') }}" class="font-semibold text-blue-600 hover:text-blue-800 self-start">Lihat Peta →</a>
            </div>

            <div class="peta-card bg-white rounded-lg shadow-md border border-gray-200 p-6 flex flex-col justify-between transform hover:scale-105 transition-transform" data-name="Budaya">
                <div>
                    <h2 class="text-xl font-bold mb-2">Budaya</h2>
                    <p class="text-gray-600 text-sm mb-4">Jelajahi warisan budaya Garut melalui peta sebaran cagar budaya dan situs bersejarah.</p>
                </div>
                <a href="{{ route('peta.tema', 'budaya') }}" class="font-semibold text-blue-600 hover:text-blue-800 self-start">Lihat Peta →</a>
            </div>
            
            @forelse ($katalogPeta as $peta)
            <div class="peta-card bg-white rounded-lg shadow-md border border-gray-200 p-6 flex flex-col justify-between transform hover:scale-105 transition-transform" data-name="{{ $peta->nama_layer }}">
                <div>
                    <h2 class="text-xl font-bold mb-2">{{ $peta->deskripsi }}</h2>
                    <p class="text-gray-600 text-sm mb-4">Menampilkan layer peta: <span class="font-mono bg-gray-100 px-1 rounded">{{ $peta->nama_layer }}</span></p>
                </div>
                <a href="{{ route('peta.layer', $peta->nama_layer) }}" class="font-semibold text-blue-600 hover:text-blue-800 self-start">Lihat Peta →</a>
            </div>
            @empty
                @endforelse

        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const sortSelect = document.getElementById('sortSelect');
            const petaContainer = document.getElementById('petaContainer');
            const petaCards = Array.from(petaContainer.querySelectorAll('.peta-card'));

            // Fungsi untuk melakukan pencarian
            function performSearch() {
                const query = searchInput.value.toLowerCase();
                petaCards.forEach(card => {
                    const name = card.getAttribute('data-name').toLowerCase();
                    if (name.includes(query)) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }

            // Fungsi untuk melakukan pengurutan
            function performSort() {
                const sortValue = sortSelect.value;
                petaCards.sort((a, b) => {
                    const nameA = a.getAttribute('data-name').toLowerCase();
                    const nameB = b.getAttribute('data-name').toLowerCase();
                    if (sortValue === 'name-asc') {
                        return nameA.localeCompare(nameB);
                    } else if (sortValue === 'name-desc') {
                        return nameB.localeCompare(nameA);
                    }
                    return 0; // default
                });
                
                // Hapus semua card dari container
                while (petaContainer.firstChild) {
                    petaContainer.removeChild(petaContainer.firstChild);
                }
                
                // Tambahkan kembali card yang sudah diurutkan
                petaCards.forEach(card => {
                    petaContainer.appendChild(card);
                });
            }

            // Event Listeners
            searchInput.addEventListener('input', performSearch);
            sortSelect.addEventListener('change', performSort);

            // Jalankan pengurutan awal
            performSort();
        });
    </script>
</body>
</html>