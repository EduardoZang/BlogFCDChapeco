<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Quem Somos</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">
    <style>
        #map {
            height: 400px;
        }
    </style>
</head>
<body>
    <h1>Quem Somos</h1>
    <p>Telefone: (00) 1234-5678</p>
    <div id="map"></div>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([-23.55052, -46.63331], 13); // Coordenadas de exemplo
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19
        }).addTo(map);
        L.marker([-23.55052, -46.63331]).addTo(map)
            .bindPopup('Nosso endereço')
            .openPopup();
    </script>
</body>
</html>