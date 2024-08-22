<?php
session_start();
include 'db.php';

// Verifica se o usuário está logado e é um administrador
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header('Location: login.php');
    exit();
}

// Adiciona nova publicação
if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_FILES['image']['name'];
    $image_description = $_POST['image_description'];
    
    // Upload da imagem
    if ($image) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    }

    $stmt = $pdo->prepare("INSERT INTO posts (title, content, image, image_description) VALUES (?, ?, ?, ?)");
    $stmt->execute([$title, $content, $image, $image_description]);
}

// Edita publicação existente
if (isset($_POST['edit'])) {
    $post_id = $_POST['post_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_FILES['image']['name'];
    $image_description = $_POST['image_description'];
    
    // Upload da nova imagem, se existir
    if ($image) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

        $stmt = $pdo->prepare("UPDATE posts SET title = ?, content = ?, image = ?, image_description = ? WHERE id = ?");
        $stmt->execute([$title, $content, $image, $image_description, $post_id]);
    } else {
        $stmt = $pdo->prepare("UPDATE posts SET title = ?, content = ?, image_description = ? WHERE id = ?");
        $stmt->execute([$title, $content, $image_description, $post_id]);
    }
}

// Exclui publicação
if (isset($_POST['delete'])) {
    $post_id = $_POST['post_id'];
    $stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->execute([$post_id]);
}

// Busca todas as publicações
$stmt = $pdo->prepare("SELECT id, title, content, image, image_description, DATE_FORMAT(created_at, '%d/%m/%Y %H:%i') as created_at FROM posts ORDER BY created_at DESC");
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>FCD - Gerenciar Publicações</title>
    <link rel="stylesheet" href="assets/css/manage_posts.css">
    <link rel="icon" href="assets/images/logoFCD.jpeg" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <?php include 'templates/header.php'; ?>
    <h1>Gerenciar Publicações</h1>
    <h2>Adicionar Nova Publicação</h2>
    <form action="manage_posts.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
        <label for="title">Título:</label>
        <input type="text" name="title" required>
        <label for="content">Conteúdo:</label>
        <textarea name="content" required></textarea>
        <label for="image">Imagem:</label>
        <input type="file" name="image" id="image" onchange="previewImage(event)">
        <div id="imagePreviewContainer">
            <img id="imagePreview" class="standard-image" style="display:none;" />
        </div>
        <label for="image_description">Descrição da Imagem:</label>
        <textarea name="image_description" id="image_description" readonly></textarea>
        <button type="submit" name="add">Adicionar</button>
    </form>

    <?php if ($posts): ?>
        <h2>Publicações Existentes</h2>
        <div class="posts-container">
            <?php foreach ($posts as $post): ?>
                <div class="post">
                    <form action="manage_posts.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                        <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                        <label for="title">Título:</label>
                        <input type="text" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
                        <label for="content">Conteúdo:</label>
                        <textarea name="content" required><?php echo htmlspecialchars($post['content']); ?></textarea>
                        <label for="image">Imagem:</label>
                        <input type="file" name="image" onchange="previewExistingImage(event, <?php echo $post['id']; ?>)">
                        <div id="imagePreviewContainer_<?php echo $post['id']; ?>">
                            <?php if ($post['image']): ?>
                                <img id="imagePreview_<?php echo $post['id']; ?>" class="standard-image" src="uploads/<?php echo htmlspecialchars($post['image']); ?>" alt="<?php echo htmlspecialchars($post['image_description']); ?>" />
                            <?php endif; ?>
                        </div>
                        <label for="image_description">Descrição da Imagem:</label>
                        <textarea name="image_description" id="image_description_<?php echo $post['id']; ?>" <?php echo $post['image'] ? '' : 'readonly'; ?>><?php echo htmlspecialchars($post['image_description']); ?></textarea>
                        <label for="created_at">Data e Hora da Publicação:</label>
                        <input type="text" name="created_at" value="<?php echo htmlspecialchars($post['created_at']); ?>" readonly>
                        <button type="submit" name="edit">Editar</button>
                        <button type="submit" name="delete" onclick="return confirm('Tem certeza que deseja excluir esta publicação?')">Excluir</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <?php include 'templates/footer.php'; ?>
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('imagePreview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
            document.getElementById('image_description').removeAttribute('readonly');
        }

        function previewExistingImage(event, id) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('imagePreview_' + id);
                if (output) {
                    output.src = reader.result;
                } else {
                    var container = document.getElementById('imagePreviewContainer_' + id);
                    var img = document.createElement('img');
                    img.id = 'imagePreview_' + id;
                    img.className = 'standard-image';
                    img.src = reader.result;
                    container.appendChild(img);
                }
            };
            reader.readAsDataURL(event.target.files[0]);
            document.getElementById('image_description_' + id).removeAttribute('readonly');
        }

        function validateForm(event) {
            var form = event.target;
            var isDeleteAction = form.querySelector('button[name="delete"]:focus');

            if (!isDeleteAction) {
                var title = form.querySelector('input[name="title"]').value.trim();
                var content = form.querySelector('textarea[name="content"]').value.trim();

                if (title === "" || content === "") {
                    alert("Título e conteúdo são obrigatórios.");
                    return false;
                }
            }
            return true;
        }

        document.addEventListener('DOMContentLoaded', function() {
            var forms = document.querySelectorAll('form');
            forms.forEach(function(form) {
                form.addEventListener('submit', validateForm);
            });
        });
    </script>
</body>
</html>