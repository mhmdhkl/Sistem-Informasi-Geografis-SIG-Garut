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
            <h1 class="text-3xl font-bold text-gray-800">Galeri untuk Kabupaten Garut Satu Peta</h1>
            <a href="{{ route('home') }}" class="text-blue-600 hover:underline">← Kembali ke Home</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6 flex flex-col justify-between">
                <div>
                    <h2 class="text-xl font-bold mb-2">Pariwisata</h2>
                    <p class="text-gray-600 text-sm mb-4">Peta interaktif ini menampilkan berbagai destinasi pariwisata unggulan di Kabupaten Garut, mulai dari pantai hingga pegunungan.</p>
                </div>
                <a href="{{ route('peta.tema', 'pariwisata') }}" class="font-semibold text-blue-600 hover:text-blue-800 self-start">Lihat Peta →</a>
            </div>

            <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6 flex flex-col justify-between">
                <div>
                    <h2 class="text-xl font-bold mb-2">Budaya</h2>
                    <p class="text-gray-600 text-sm mb-4">Jelajahi warisan budaya Garut melalui peta sebaran cagar budaya, situs bersejarah, dan pusat-pusat kesenian tradisional.</p>
                </div>
                <a href="{{ route('peta.tema', 'budaya') }}" class="font-semibold text-blue-600 hover:text-blue-800 self-start">Lihat Peta →</a>
            </div>

            <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6 flex flex-col justify-between opacity-50">
                <div>
                    <h2 class="text-xl font-bold mb-2">Batas Kota</h2>
                    <p class="text-gray-600 text-sm mb-4">Visualisasi batas administrasi untuk perencanaan dan analisis kewilayahan.</p>
                </div>
                <span class="font-semibold text-gray-400">Segera Hadir</span>
            </div>

             <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6 flex flex-col justify-between opacity-50">
                <div>
                    <h2 class="text-xl font-bold mb-2">Geologi Garut</h2>
                    <p class="text-gray-600 text-sm mb-4">Informasi mengenai struktur dan kondisi geologi wilayah Kabupaten Garut.</p>
                </div>
                <span class="font-semibold text-gray-400">Segera Hadir</span>
            </div>
        </div>
    </div>
</body>
</html>