<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Doações</title>
    <link rel="stylesheet" href="assets/css/donations.css">
</head>
<body>
    <?php include 'templates/header.php'; ?>
    
    <div class="content-wrapper">
        <div class="donation-container">
            <h1>Doações</h1>
            <p>Para apoiar nosso trabalho, faça uma doação através do QR Code abaixo:</p>
            <div class="qrcode-container">
                <img src="assets/images/qrcodeexample.png" alt="QR Code do Pix">
            </div>
        </div>
    </div>

    <?php include 'templates/footer.php'; ?>
</body>
</html>