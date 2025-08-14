<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demografi Kabupaten Garut</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-100">

    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-6 py-4">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Demografi Kabupaten Garut</h1>
            <p class="text-gray-600">Data Kependudukan dan Wilayah Terkini</p>
        </div>
    </header>

    <main class="container mx-auto px-6 py-8">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-gray-500 text-sm md:text-base">Jumlah Penduduk</h3>
                <p class="text-2xl md:text-3xl font-bold text-blue-600 mt-2">
                    @if(isset($statistik['jumlah_penduduk']))
                        {{ number_format($statistik['jumlah_penduduk']->nilai_data, 0, ',', '.') }}
                    @else
                        N/A
                    @endif
                </p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-gray-500 text-sm md:text-base">Luas Wilayah</h3>
                <p class="text-2xl md:text-3xl font-bold text-blue-600 mt-2">
                    @if(isset($statistik['luas_wilayah']))
                        {{ $statistik['luas_wilayah']->nilai_data }}
                    @else
                        N/A
                    @endif
                </p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-gray-500 text-sm md:text-base">Jumlah Kecamatan</h3>
                <p class="text-2xl md:text-3xl font-bold text-blue-600 mt-2">
                    {{ $statistik['jumlah_kecamatan']->nilai_data ?? 'N/A' }}
                </p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-gray-500 text-sm md:text-base">Jumlah Desa/Kelurahan</h3>
                <p class="text-2xl md:text-3xl font-bold text-blue-600 mt-2">
                    {{ $statistik['jumlah_desa']->nilai_data ?? 'N/A' }}
                </p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-gray-700 mb-4">Grafik Perbandingan Wilayah Administrasi</h3>
            <canvas id="demografiChart" data-chart='{{ json_encode($chartData) }}'></canvas>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Dapatkan elemen canvas
        const ctx = document.getElementById('demografiChart');
        
        // DIUBAH: Ambil data dari atribut 'data-chart', lalu parse menjadi objek JSON
        const chartData = JSON.parse(ctx.getAttribute('data-chart'));

        // Buat grafik baru menggunakan Chart.js (sisa kode ini tetap sama)
        const demografiChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: 'Jumlah',
                    data: chartData.data,
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.6)',
                        'rgba(239, 68, 68, 0.6)'
                    ],
                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(239, 68, 68, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Perbandingan Jumlah Kecamatan dan Desa/Kelurahan'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>