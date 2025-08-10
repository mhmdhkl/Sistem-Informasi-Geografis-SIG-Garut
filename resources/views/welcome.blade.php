<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIG Kabupaten Garut - Budaya & Pariwisata</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
        }
    </style>
</head>
<body class="bg-gray-50">

    <header class="bg-white/80 backdrop-blur-sm shadow-sm fixed top-0 left-0 right-0 z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <img src="{{ asset('images/logo-garut.png') }}" alt="Logo Garut" class="h-10">
                <span class="text-sm md:text-xl font-bold text-gray-800">Pemerintahan<br>Kabupaten Garut</span>
            </div>
            <nav class="hidden md:flex items-center space-x-8 text-gray-600 font-medium">
                <a href="#home" class="hover:text-blue-600">Dashboard</a>
                <a href="{{ route('peta.kumpulan') }}" class="hover:text-blue-600">Katalog Peta</a>
                <a href="#demografi" class="hover:text-blue-600">Demografi</a>
                <a href="#berita" class="hover:text-blue-600">Berita</a>
                <a href="/login" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors">Login</a>
            </nav>
            <button class="md:hidden text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
            </button>
        </div>
    </header>

    <main class="w-full">
        <section id="home" class="h-screen bg-cover bg-center flex items-center justify-center text-white" style="background-image: url('https://images.unsplash.com/photo-1519046904884-53103b34b206?q=80&w=2070&auto=format&fit=crop');">
            <div class="text-center bg-black/50 p-8 rounded-lg">
                <h1 class="text-3xl md:text-5xl font-bold mb-4">Sistem Informasi Geografis Garut</h1>
                <p class="text-lg md:text-xl">Menjelajahi Potensi Budaya dan Pariwisata Kabupaten Garut</p>
            </div>
        </section>

        <section class="py-20 bg-white">
            <div class="container mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-8 text-center">
                
                <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                    <h3 class="text-2xl md:text-4xl font-bold text-blue-600 mb-2">{{ $statistik['luas_wilayah']->nilai_data ?? 'N/A' }}</h3>
                    <p class="text-gray-500 text-sm md:text-base">Luas Wilayah</p>
                </div>
                
                <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                    <h3 class="text-2xl md:text-4xl font-bold text-blue-600 mb-2">{{ number_format((int) ($statistik['jumlah_penduduk']->nilai_data ?? 0), 0, ',', '.') }}</h3>
                    <p class="text-gray-500 text-sm md:text-base">Jumlah Penduduk</p>
                </div>
                
                <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                    <h3 class="text-2xl md:text-4xl font-bold text-blue-600 mb-2">{{ $statistik['jumlah_kecamatan']->nilai_data ?? 'N/A' }}</h3>
                    <p class="text-gray-500 text-sm md:text-base">Jumlah Kecamatan</p>
                </div>

                <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                    <h3 class="text-2xl md:text-4xl font-bold text-blue-600 mb-2">{{ $statistik['jumlah_desa']->nilai_data ?? 'N/A' }}</h3>
                    <p class="text-gray-500 text-sm md:text-base">Jumlah Desa/Kelurahan</p>
                </div>
            </div>
        </section>

        <section id="katalog" class="py-20 bg-slate-800 text-white">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center mb-12">Katalog Peta Tematik</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="bg-slate-700 p-6 rounded-lg text-center transform hover:scale-105 transition-transform">
                        <h3 class="font-bold text-xl mb-2">Peta Pariwisata</h3>
                        <p class="text-slate-300 mb-4 text-sm">Peta sebaran lokasi wisata alam dan buatan di Garut.</p>
                        <a href="{{ route('peta.tema', 'pariwisata') }}" class="font-semibold text-blue-400 hover:underline">Lihat Peta →</a>
                    </div>
                    <div class="bg-slate-700 p-6 rounded-lg text-center transform hover:scale-105 transition-transform">
                        <h3 class="font-bold text-xl mb-2">Peta Budaya</h3>
                        <p class="text-slate-300 mb-4 text-sm">Peta sebaran lokasi cagar budaya dan situs bersejarah.</p>
                        <a href="{{ route('peta.tema', 'budaya') }}" class="font-semibold text-blue-400 hover:underline">Lihat Peta →</a>
                    </div>
                    <div class="bg-slate-700 p-6 rounded-lg text-center transform hover:scale-105 transition-transform">
                        <h3 class="font-bold text-xl mb-2">Batas Kota</h3>
                        <p class="text-slate-300 mb-4 text-sm">Visualisasi batas administrasi wilayah kota Garut.</p>
                        <a href="#" class="font-semibold text-gray-400 cursor-not-allowed">Segera Hadir</a>
                    </div>
                    <div class="bg-slate-700 p-6 rounded-lg text-center transform hover:scale-105 transition-transform">
                        <h3 class="font-bold text-xl mb-2">Geologi Garut</h3>
                        <p class="text-slate-300 mb-4 text-sm">Informasi mengenai struktur dan kondisi geologi.</p>
                        <a href="#" class="font-semibold text-gray-400 cursor-not-allowed">Segera Hadir</a>
                    </div>
                </div>
            </div>
        </section>

        <section id="demografi" class="py-20 bg-white">
             <div class="container mx-auto px-6 text-center">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Demografi Kabupaten Garut</h2>
                <p class="text-gray-600 mb-8 max-w-2xl mx-auto">Lihat data kependudukan terbaru, komposisi penduduk, dan berbagai statistik penting lainnya dalam visualisasi data yang informatif.</p>
                <a href="/demografi" class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition-colors">Lihat Detail Demografi</a>
            </div>
        </section>

         <section id="berita" class="py-20 bg-gray-100">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Berita Terkini</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse ($berita as $item)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:-translate-y-2 transition-transform">
                        <img src="{{ asset('images/' . $item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="font-bold text-xl mb-2 h-16">{{ Str::limit($item->judul, 50) }}</h3>
                            <p class="text-gray-600 mb-4 text-sm h-20">{{ Str::limit($item->kutipan_singkat, 100) }}</p>
                            <a href="{{ $item->sumber_url }}" target="_blank" class="font-semibold text-blue-600 hover:underline">Selengkapnya →</a>
                        </div>
                    </div>
                    @empty
                    <p class="text-center col-span-3 text-gray-500">Belum ada berita untuk ditampilkan.</p>
                    @endforelse
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-slate-900 text-slate-300 py-12">
        <div class="container mx-auto px-6 text-center text-sm">
            <p>&copy; {{ date('Y') }} - Sistem Informasi Geografis Kabupaten Garut.</p>
            <p class="mt-2">Dikembangkan sebagai bagian dari Kerja Praktek di Dinas Komunikasi dan Informatika (Diskominfo) Kabupaten Garut.</p>
        </div>
    </footer>

</body>
</html>