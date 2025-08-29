<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta {{ ucfirst($tema) }} - SIG Garut</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }
        #map {
            width: 100%;
            height: 100%;
        }
        .leaflet-container {
            font-family: 'Poppins', sans-serif;
        }
        .leaflet-popup-content-wrapper {
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            padding: 1rem;
        }
        .leaflet-popup-content-wrapper .leaflet-popup-content {
            padding: 0;
        }
        .popup-content img {
            max-width: 100%;
            height: auto;
            border-radius: 6px;
            margin-bottom: 0.75rem;
        }
        .popup-content h3 {
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
            color: #1a202c;
        }
        .popup-content p {
            font-size: 0.875rem;
            color: #4a5568;
            margin-bottom: 0.5rem;
        }
        .popup-content a.ticket-button {
            display: inline-block;
            background-color: #3b82f6;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            text-decoration: none;
            font-weight: 500;
            margin-top: 0.5rem;
        }
        .popup-content a.ticket-button:hover {
            background-color: #2563eb;
        }
        
        /* Tata Letak Kontrol Baru */
        .back-button-container {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 1000;
        }
        .search-container {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }
        .search-container input {
            border: none;
            outline: none;
            width: 250px;
            padding: 10px 15px;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .search-container button {
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
            margin-left: 10px;
        }

        /* Menggeser kontrol zoom agar tidak tumpang tindih */
        .leaflet-control-container .leaflet-top.leaflet-left {
            top: 80px !important;
        }
        
        /* Gaya untuk label di atas ikon */
        .leaflet-tooltip.leaflet-tooltip-top.lokasi-label {
            /* Nilai offset di sini tidak terlalu penting karena sudah diatur di JS,
               tapi tetap berguna untuk styling dasar. */
            font-weight: bold;
            font-size: 14px;
            color: #333;
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 2px 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .leaflet-tooltip.leaflet-tooltip-top.lokasi-label::before {
            border-top-color: rgba(255, 255, 255, 0.9);
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

    <div class="search-container">
        <input type="text" id="search-input" placeholder="Cari lokasi...">
        <button id="search-button">🔍</button>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>

    <script>
        const map = L.map('map').setView([-7.2278, 107.9087], 11);
        const markers = {};
        
        const zoomControl = map.zoomControl;
        if (zoomControl) {
            zoomControl.remove();
        }
        L.control.zoom({
            position: 'topleft'
        }).addTo(map);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        fetch('/api/lokasi')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Gagal mengambil data lokasi.');
                }
                return response.json();
            })
            .then(data => {
                const temaPeta = '{{ $tema }}'.toLowerCase();
                const filteredData = data.filter(lokasi => lokasi.kategori.toLowerCase() === temaPeta);
                
                if (filteredData.length === 0) {
                    console.warn('Tidak ada lokasi yang ditemukan untuk kategori ini.');
                }
                
                filteredData.forEach(lokasi => {
                    let photoUrl = '';
                    if (lokasi.foto) {
                        photoUrl = `/storage/${lokasi.foto}`;
                    } else {
                        photoUrl = 'https://via.placeholder.com/300x200.png?text=Tidak+Ada+Foto';
                    }

                    let ticketButton = '';
                    if (lokasi.ticket_url) {
                        ticketButton = `<a href="${lokasi.ticket_url}" target="_blank" class="ticket-button">Beli Tiket</a>`;
                    }

                    const popupContent = `
                        <div class="popup-content">
                            <img src="${photoUrl}" alt="${lokasi.nama_lokasi}" class="w-full h-auto object-cover">
                            <h3>${lokasi.nama_lokasi}</h3>
                            <p class="text-gray-600">${lokasi.deskripsi}</p>
                            <p class="text-sm font-semibold text-gray-800">Alamat:</p>
                            <p class="text-sm text-gray-600">${lokasi.alamat}</p>
                            ${ticketButton}
                        </div>
                    `;

                    const marker = L.marker([lokasi.latitude, lokasi.longitude])
                        .bindPopup(popupContent, { minWidth: 200 })
                        .bindTooltip(lokasi.nama_lokasi, {
                            permanent: true,
                            direction: 'top', 
                            offset: [-15, -15], 
                            className: 'lokasi-label'
                        });
                    
                    marker.addTo(map);
                    markers[lokasi.nama_lokasi.toLowerCase()] = marker;
                });

                if (filteredData.length > 0) {
                    const group = new L.featureGroup(filteredData.map(lokasi => L.marker([lokasi.latitude, lokasi.longitude])));
                    map.fitBounds(group.getBounds());
                }
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
                        return {
                            color: "#ff7800",
                            weight: 2,
                            opacity: 0.65,
                            fillOpacity: 0.1
                        };
                    }
                }).addTo(map);
            });
            
        const searchInput = document.getElementById('search-input');
        const searchButton = document.getElementById('search-button');

        searchButton.addEventListener('click', () => {
            performSearch();
        });

        searchInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                performSearch();
            }
        });

        function performSearch() {
            const query = searchInput.value.toLowerCase().trim();
            const foundMarker = markers[query];

            if (foundMarker) {
                map.flyTo(foundMarker.getLatLng(), 15);
                foundMarker.openPopup();
            } else {
                alert(`Lokasi dengan nama "${searchInput.value}" tidak ditemukan. Pastikan nama lokasi sudah benar.`);
            }
        }
    </script>
</body>
</html>