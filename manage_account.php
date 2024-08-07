<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $user['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $birthdate = $_POST['birthdate'];
    
    // Processar o upload da imagem
    $profile_image = $user['profile_image']; // Mantém a imagem existente
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
                // Remove a imagem antiga se houver
                $oldImagePath = $uploadFileDir . $user['profile_image'];
                if ($user['profile_image'] !== 'perfilPadrao.png' && file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
                $profile_image = basename($dest_path);
            }
        }
    }

    $stmt = $pdo->prepare("UPDATE users SET username = ?, password = ?, email = ?, phone = ?, birthdate = ?, profile_image = ? WHERE id = ?");
    $stmt->execute([$username, $password, $email, $phone, $birthdate, $profile_image, $user_id]);
    $success = "Informações atualizadas com sucesso";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Conta</title>
    <link rel="stylesheet" href="assets/css/manage_account.css">
</head>
<body>
    <?php include 'templates/header.php'; ?> 
    <div class="content-wrapper">
        <div class="about-container">
            <h1>Gerenciar Conta</h1>
            <?php if (isset($success)): ?>
                <p><?php echo $success; ?></p>
            <?php endif; ?>
            <form action="manage_account.php" method="POST" enctype="multipart/form-data">
                <label for="username">Usuário:</label>
                <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                
                <label for="password">Senha (deixe em branco para manter a atual):</label>
                <input type="password" name="password">
                
                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                
                <label for="phone">Telefone:</label>
                <input type="text" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
                
                <label for="birthdate">Data de Nascimento:</label>
                <input type="date" name="birthdate" value="<?php echo htmlspecialchars($user['birthdate']); ?>" required>
                
                <label for="profile_image">Foto de Perfil:</label>
                <?php if ($user['profile_image'] !== 'perfilPadrao.png'): ?>
                    <img src="uploads/<?php echo htmlspecialchars($user['profile_image']); ?>" alt="Foto de Perfil" width="100">
                <?php else: ?>
                    <img src="uploads/perfilPadrao.png" alt="Foto de Perfil Padrão" width="100">
                <?php endif; ?>
                <input type="file" name="profile_image">
                
                <button type="submit">Atualizar</button>
            </form>
        </div>
    </div>
    <?php include 'templates/footer.php'; ?>
</body>
</html>