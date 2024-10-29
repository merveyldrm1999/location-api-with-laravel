<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tüm konumlar</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
    </style>
</head>
<body>

<h3>Markerli Konum ve Mesafe Çizgileri</h3>
<div id="map"></div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    const map = L.map('map').setView([37.7749, -122.4194], 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    const locations = @json($model);

    locations.forEach((location, index) => {
        const circleMarker = L.circleMarker([location.latitude, location.longitude], {
            color: location.hex,
            fillColor: location.hex,
            fillOpacity: 0.8,
            radius: 8
        }).addTo(map);

        circleMarker.bindPopup(`<b>${location.name}</b>`);

        if (index < locations.length - 1) {
            const nextLocation = locations[index + 1];
            L.polyline(
                [
                    [location.latitude, location.longitude],
                    [nextLocation.latitude, nextLocation.longitude]
                ],
                {
                    color: '#3388ff',
                    weight: 2,
                    opacity: 0.7
                }
            ).addTo(map);
        }
    });
</script>

</body>
</html>
