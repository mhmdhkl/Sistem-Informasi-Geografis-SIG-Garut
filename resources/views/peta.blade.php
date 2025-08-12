<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta {{ ucfirst($tema) }} - SIG Garut</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #map {
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>

    <div id="map"></div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        const map = L.map('map').setView([-7.2278, 107.9087], 11);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        fetch('/api/lokasi')
            .then(response => response.json())
            .then(data => {
                const temaPeta = '{{ $tema }}'; 

                data.forEach(lokasi => {
                    if (lokasi.kategori.toLowerCase() === temaPeta.toLowerCase()) {
                        const marker = L.marker([lokasi.latitude, lokasi.longitude]).addTo(map);

                        marker.bindPopup(
                            `<b>${lokasi.nama_lokasi}</b><br>${lokasi.alamat}`
                        );
                    }
                });
            })
            .catch(error => {
                console.error('Error fetching location data:', error);
                alert('Gagal memuat data lokasi. Silakan coba lagi.');
            });
            fetch('/api/layers/batas_desa')
            .then(response => response.json())
            .then(data => {
                L.geoJSON(data, {
                    style: function(feature) {
                        // Atur style poligon di sini (warna garis, warna isian, dll)
                        return {
                            color: "#ff7800",
                            weight: 2,
                            opacity: 0.65
                        };
                    }
                }).addTo(map);
            });
            
    </script>
</body>
</html>