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
            width: 280px;
        }
        .search-container .relative {
            width: 100%;
        }
        .search-container input {
            border: 1px solid #ccc;
            outline: none;
            width: 100%;
            padding: 10px 15px;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        #search-results {
            position: absolute;
            width: 100%;
            background-color: white;
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 8px 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            max-height: 300px;
            overflow-y: auto;
        }
        .search-result-item {
            padding: 10px 15px;
            cursor: pointer;
            border-bottom: 1px solid #eee;
        }
        .search-result-item:hover {
            background-color: #f0f0f0;
        }
        .search-result-item:last-child {
            border-bottom: none;
        }
        .search-result-item h4 {
            font-weight: 600;
            margin: 0;
            font-size: 0.9rem;
        }
        .search-result-item p {
            font-size: 0.8rem;
            color: #666;
            margin: 0;
        }
        .leaflet-control-container .leaflet-top.leaflet-left {
            top: 80px !important;
        }
        .leaflet-tooltip.leaflet-tooltip-top.lokasi-label {
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
        <div class="relative">
            <input type="text" id="search-input" placeholder="Cari lokasi wisata..." autocomplete="off">
            <div id="search-results"></div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        const map = L.map('map', {
            zoomControl: true,
            attributionControl: false  
        }).setView([-7.2278, 107.9087], 11);
        
        const allMarkers = {};

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: ''  
        }).addTo(map);

         

        fetch('/api/lokasi')
            .then(response => {
                if (!response.ok) throw new Error('Gagal mengambil data lokasi.');
                return response.json();
            })
            .then(data => {
                const temaPeta = '{{ $tema }}'.toLowerCase();
                const filteredData = data.filter(lokasi => lokasi.kategori.toLowerCase() === temaPeta);

                if (filteredData.length === 0) {
                    console.warn('Tidak ada lokasi yang ditemukan untuk kategori ini.');
                }

                const markerGroup = L.markerClusterGroup();

                filteredData.forEach(lokasi => {
                    let photoUrl = lokasi.foto ? `/storage/${lokasi.foto}` : 'https://via.placeholder.com/300x200.png?text=Tidak+Ada+Foto';
                    let ticketButton = lokasi.ticket_url ? `<a href="${lokasi.ticket_url}" target="_blank" class="ticket-button">Beli Tiket</a>` : '';

                    const popupContent = `
                        <div class="popup-content">
                            <img src="${photoUrl}" alt="${lokasi.nama_lokasi}">
                            <h3>${lokasi.nama_lokasi}</h3>
                            <p>${lokasi.deskripsi}</p>
                            <p class="text-sm font-semibold">Alamat:</p>
                            <p>${lokasi.alamat}</p>
                            ${ticketButton}
                        </div>`;

                    const marker = L.marker([lokasi.latitude, lokasi.longitude])
                        .bindPopup(popupContent, { minWidth: 250 })
                        .bindTooltip(lokasi.nama_lokasi, {
                            permanent: true,
                            direction: 'top',
                            offset: [-15, -15],
                            className: 'lokasi-label'
                        });

                    markerGroup.addLayer(marker);
                    allMarkers[lokasi.id] = marker;
                });

                map.addLayer(markerGroup);

                if (filteredData.length > 0) {
                    const groupBounds = markerGroup.getBounds();
                    if (groupBounds.isValid()) {
                        map.fitBounds(groupBounds);
                    }
                }
            })
            .catch(error => {
                console.error('Error fetching location data:', error);
                alert('Gagal memuat data lokasi. Silakan coba lagi.');
            });
        
        $(document).ready(function() {
            const searchInput = $('#search-input');
            const searchResults = $('#search-results');

            searchInput.on('keyup', function() {
                const keyword = $(this).val();
                if (keyword.length < 3) {
                    searchResults.html('').hide();
                    return;
                }
                $.ajax({
                    url: `/api/search/lokasi/${keyword}`,
                    type: 'GET',
                    success: function(response) {
                        searchResults.html('').show();
                        if (response.success && response.data.length > 0) {
                            const temaPeta = '{{ $tema }}'.toLowerCase();
                            const filteredResults = response.data.filter(lokasi => lokasi.kategori.toLowerCase() === temaPeta);

                            if (filteredResults.length > 0) {
                                filteredResults.forEach(function(lokasi) {
                                    const item = `
                                        <div class="search-result-item" data-id="${lokasi.id}">
                                            <h4>${lokasi.nama_lokasi}</h4>
                                            <p>${lokasi.alamat}</p>
                                        </div>`;
                                    searchResults.append(item);
                                });
                            } else {
                                searchResults.html('<div class="p-3 text-gray-500">Tidak ada hasil untuk kategori ini.</div>');
                            }
                        } else {
                            searchResults.html('<div class="p-3 text-gray-500">Lokasi tidak ditemukan.</div>');
                        }
                    },
                    error: function() {
                        searchResults.html('<div class="p-3 text-red-500">Gagal melakukan pencarian.</div>').show();
                    }
                });
            });

            $(document).on('click', '.search-result-item', function() {
                const lokasiId = $(this).data('id');
                const selectedMarker = allMarkers[lokasiId];

                if (selectedMarker) {
                    map.flyTo(selectedMarker.getLatLng(), 16);
                    selectedMarker.openPopup();
                }

                searchResults.html('').hide();
                searchInput.val($(this).find('h4').text());
            });

            $(document).on('click', function(e) {
                if (!$(e.target).closest('.search-container').length) {
                    searchResults.hide();
                }
            });
        });
    </script>
</body>
</html>