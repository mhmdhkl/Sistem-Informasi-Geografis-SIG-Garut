<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta Layer: {{ Str::title(str_replace('_', ' ', $nama_layer)) }}</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html, body, #map {
            height: 100%;
            width: 100%;
            margin: 0;
            padding: 0;
        }
        .back-button-container {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 1000;
        }
        .leaflet-control-container .leaflet-top.leaflet-left {
            top: 70px !important;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div id="map"></div>
    
    <div class="back-button-container bg-white rounded-lg shadow-md p-3">
        <a href="{{ route('home') }}" class="text-blue-600 hover:underline font-semibold">
            ← Kembali ke Halaman Utama
        </a>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const map = L.map('map', {
            zoomControl: true,
            attributionControl: false  
        }).setView([-7.2278, 107.9087], 11);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: ''
        }).addTo(map);

        const namaLayer = '{{ $nama_layer }}';

        fetch(`/api/layers/${namaLayer}`)
            .then(response => response.json())
            .then(data => {
                L.geoJSON(data, {
                    style: function(feature) {
                        return {
                            color: "#0033ff",
                            weight: 1,
                            opacity: 0.65,
                            fillOpacity: 0.1
                        };
                    }
                }).addTo(map);
            })
            .catch(error => console.error(`Error memuat GeoJSON untuk layer ${namaLayer}:`, error));
    </script>
</body>
</html>