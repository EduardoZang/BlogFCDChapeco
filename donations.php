<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>FCD - Doações</title>
    <link rel="stylesheet" href="assets/css/donations.css">
    <link rel="icon" href="assets/images/logoFCD.jpeg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            <div class="cnpj-container">
                <p>CNPJ: <span id="cnpj">01.883.943/0001-72</span></p>
                <button id="copy-btn" onclick="copyToClipboard()">
                    <i class="fas fa-copy"></i> Copiar CNPJ
                </button>
            </div>
        </div>
    </div>

    <?php include 'templates/footer.php'; ?>

    <script>
        function copyToClipboard() {
            var cnpj = document.getElementById('cnpj').textContent;
            navigator.clipboard.writeText(cnpj).then(function() {
                alert('CNPJ copiado para a área de transferência!');
            }, function(err) {
                console.error('Erro ao copiar o CNPJ: ', err);
            });
        }
    </script>
</body>
</html>