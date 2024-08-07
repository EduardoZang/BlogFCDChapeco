<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Quem somos</title>
    <link rel="stylesheet" href="assets/css/about_us.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <?php include 'templates/header.php'; ?>

    <div class="intro-section">
        <div class="intro-container">
            <main class="text-container">
                <h1>Bem-vindo à FCD</h1>
                <p>Nossa missão.</p>
            </main>
            <aside class="image-container">
                <img src="assets/images/fcdimage1.png" alt="Nossa Missão">
                <img src="assets/images/fcdimage2.png" alt="Nossa Equipe">
            </aside>
        </div>
    </div>

    <?php include 'templates/footer.php'; ?>

</body>
</html>
