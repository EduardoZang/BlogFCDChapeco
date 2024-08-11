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
    
    // Atualizar a imagem de perfil na sessão
    $_SESSION['profile_image'] = $profile_image;

    // Definir a mensagem de sucesso
    $success = "Informações atualizadas com sucesso";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Conta</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/css/manage_account.css">
    <script src="assets/js/manage_account.js" defer></script>
</head>
<body>
    <?php include 'templates/header.php'; ?> 
    <div class="content-wrapper">
        <div class="about-container">
            <h1>Gerenciar Conta</h1>
            <div class="profile-section">
                <div class="profile-image">
                    <?php if ($user['profile_image'] !== 'perfilPadrao.png'): ?>
                        <img id="profilePreview" src="uploads/<?php echo htmlspecialchars($user['profile_image']); ?>" alt="Foto de Perfil" width="100">
                    <?php else: ?>
                        <img id="profilePreview" src="uploads/perfilPadrao.png" alt="Foto de Perfil Padrão" width="100">
                    <?php endif; ?>
                    <input type="file" name="profile_image" id="profile_image" form="update-form">
                </div>
                <form id="update-form" action="manage_account.php" method="POST" enctype="multipart/form-data">
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
                    
                    <button type="submit">Atualizar</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Sucesso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Informações atualizadas com sucesso!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModalButton">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <?php include 'templates/footer.php'; ?>

    <?php if (isset($success)): ?>
    <script>
        $(document).ready(function(){
            $('#successModal').modal('show');

            $('#closeModalButton').on('click', function () {
                window.location.href = 'index.php';
            });
        });
    </script>
    <?php endif; ?>
</body>
</html>