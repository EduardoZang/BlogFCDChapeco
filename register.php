<?php
session_start();
include 'db.php';

if (isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $birthdate = $_POST['birthdate'];
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;
    
    $profile_image = 'perfilPadrao.png';
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['profile_image']['tmp_name'];
        $fileName = $_FILES['profile_image']['name'];
        $fileSize = $_FILES['profile_image']['size'];
        $fileType = $_FILES['profile_image']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];
        
        if (in_array($fileExtension, $allowedExts)) {
            $uploadFileDir = './uploads/';
            $dest_path = $uploadFileDir . 'profile_' . time() . '.' . $fileExtension;
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $profile_image = basename($dest_path);
            }
        }
    }

    $stmt = $pdo->prepare("INSERT INTO users (username, password, email, phone, birthdate, profile_image, is_admin) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$username, $password, $email, $phone, $birthdate, $profile_image, $is_admin]);
    $success = "Usuário cadastrado com sucesso";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'templates/header.php'; ?>
    <h1>Cadastro de Usuário</h1>
    <?php if (isset($success)): ?>
        <p><?php echo $success; ?></p>
    <?php endif; ?>
    <form action="register.php" method="POST" enctype="multipart/form-data">
        <label for="username">Usuário:</label>
        <input type="text" name="username" required>
        <label for="password">Senha:</label>
        <input type="password" name="password" required>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <label for="phone">Telefone:</label>
        <input type="text" name="phone" required>
        <label for="birthdate">Data de Nascimento:</label>
        <input type="date" name="birthdate" required>
        <label for="profile_image">Foto de Perfil:</label>
        <input type="file" name="profile_image">
        <label for="is_admin">Administrador:</label>
        <input type="checkbox" name="is_admin">
        <button type="submit">Cadastrar</button>
    </form>

    <?php include 'templates/footer.php'; ?>
</body>
</html>