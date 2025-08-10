<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demografi Kabupaten Garut - SIG Garut</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-6 py-12">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Demografi Kabupaten Garut</h1>
            <a href="{{ route('home') }}" class="text-blue-600 hover:underline">← Kembali ke Home</a>
        </div>

        <div class="bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold text-center mb-6">Dasbor Kependudukan</h2>
            <p class="text-center text-gray-500">Fitur dan visualisasi data detail demografi akan segera tersedia di halaman ini.</p>
            </div>
    </div>
</body>
</html>