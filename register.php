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
    <link rel="stylesheet" href="assets/css/register.css">
</head>
<body>
    <?php include 'templates/header.php'; ?>
    <div class="content-wrapper">
        <div class="form-container">
            <h2>Cadastro</h2>
            <?php if (isset($success)): ?>

            <?php endif; ?>
            <form action="register.php" method="POST" enctype="multipart/form-data">
                <div class="input-group">
                    <div>
                        <label for="username">Usuário:</label>
                        <input type="text" name="username" required>
                    </div>
                    <div>
                        <label for="email">Email:</label>
                        <input type="email" name="email" required>
                    </div>
                </div>
                <div class="input-group">
                    <div>
                        <label for="password">Senha:</label>
                        <input type="password" name="password" required>
                    </div>
                    <div>
                        <label for="phone">Telefone:</label>
                        <input type="text" name="phone" required>
                    </div>
                </div>
                <div class="input-group">
                    <div>
                        <label for="birthdate">Data de Nascimento:</label>
                        <input type="date" name="birthdate" required>
                    </div>
                    <div>
                        <label for="profile_image">Foto de Perfil:</label>
                        <input type="file" id="profile_image" name="profile_image" accept="image/*">
                        <img id="image_preview" class="image-preview" alt="Pré-visualização da Imagem">
                    </div>
                </div>
                <label for="is_admin">Administrador:</label>
                <input type="checkbox" name="is_admin">
                <button type="submit">Cadastrar</button>
            </form>
        </div>
    </div>

    <!-- Modal -->
<div id="statusModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="statusModalLabel" class="modal-title">Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="modalMessage"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>


    <?php include 'templates/footer.php'; ?>

    <script>
        document.getElementById('profile_image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById('image_preview');
                    img.src = e.target.result;
                    img.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                document.getElementById('image_preview').style.display = 'none';
            }
        });
    </script>

<script>
    // Função para mostrar o modal com mensagem de sucesso ou erro
    function showStatusModal(message, isSuccess) {
        var modalMessage = document.getElementById('modalMessage');
        var modalTitle = document.getElementById('statusModalLabel');
        
        // Atualiza o título e a mensagem do modal
        if (isSuccess) {
            modalMessage.innerHTML = message;
            modalTitle.innerHTML = 'Cadastro Bem-Sucedido';
            modalMessage.style.color = 'green';
        } else {
            modalMessage.innerHTML = message;
            modalTitle.innerHTML = 'Erro';
            modalMessage.style.color = 'red';
        }
        
        // Mostra o modal
        $('#statusModal').modal('show');
    }

    // Verifica se existe uma mensagem de sucesso ou erro após o carregamento
    <?php if (isset($success)): ?>
        showStatusModal('<?php echo $success; ?>', true);
    <?php elseif (isset($error)): ?>
        showStatusModal('<?php echo $error; ?>', false);
    <?php endif; ?>
</script>

</body>
</html>