<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta Layer: {{ Str::title(str_replace('_', ' ', $nama_layer)) }}</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <style>
        html, body, #map { height: 100%; width: 100%; margin: 0; padding: 0; }
    </style>
</head>
<body>
    <div id="map"></div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const map = L.map('map').setView([-7.2278, 107.9087], 10);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Mengambil nama layer dari variabel yang dikirim controller
        const namaLayer = '{{ $nama_layer }}';

        // Memuat dan menampilkan layer GeoJSON dari API berdasarkan nama layer
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