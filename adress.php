<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Nosso endereço</title>
    <link rel="stylesheet" href="assets/css/adress.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <?php include 'templates/header.php'; ?>

    <div class="content-wrapper">
        <div class="about-container">
            <h1>Como chegar</h1>
            <div class="button-container">
                <a href="https://www.google.com/maps/dir/?api=1&destination=Fcd, R. São Leopoldo, 449 - Esplanada, Chapecó - SC, 89812-530" target="_blank" class="btn">
                    <i class="fas fa-map-marked-alt"></i> Como Chegar
                </a>
                <a href="tel:+554933313481" class="btn">
                    <i class="fas fa-phone-alt"></i> (49) 3331-3481
                </a>
                <a href="mailto:fcdchapeco@gmail.com" class="btn">
                    <i class="fas fa-envelope"></i> fcdchapeco@gmail.com
                </a>
            </div>
            <div id="map"></div>
        </div>
    </div>

    <?php include 'templates/footer.php'; ?>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([-27.113230348694888, -52.59669763318929], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19
        }).addTo(map);
        L.marker([-27.113230348694888, -52.59669763318929]).addTo(map)
            .bindPopup('Nosso endereço')
            .openPopup();
    </script>
</body>
</html>