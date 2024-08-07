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
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

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
$stmt = $pdo->prepare("SELECT * FROM posts ORDER BY created_at DESC");
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Publicações</title>
    <link rel="stylesheet" href="assets/css/manage_posts.css">
</head>
<body>
    <?php include 'templates/header.php'; ?>
    <h1>Gerenciar Publicações</h1>
    <h2>Adicionar Nova Publicação</h2>
    <form action="manage_posts.php" method="POST" enctype="multipart/form-data">
        <label for="title">Título:</label>
        <input type="text" name="title" required>
        <label for="content">Conteúdo:</label>
        <textarea name="content" required></textarea>
        <label for="image">Imagem:</label>
        <input type="file" name="image">
        <label for="image_description">Descrição da Imagem:</label>
        <textarea name="image_description"></textarea>
        <button type="submit" name="add">Adicionar</button>
    </form>

    <h2>Publicações Existentes</h2>
    <?php if ($posts): ?>
        <?php foreach ($posts as $post): ?>
            <div class="post">
                <form action="manage_posts.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                    <label for="title">Título:</label>
                    <input type="text" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
                    <label for="content">Conteúdo:</label>
                    <textarea name="content" required><?php echo htmlspecialchars($post['content']); ?></textarea>
                    <label for="image">Imagem:</label>
                    <input type="file" name="image">
                    <label for="image_description">Descrição da Imagem:</label>
                    <textarea name="image_description"><?php echo htmlspecialchars($post['image_description']); ?></textarea>
                    <button type="submit" name="edit">Editar</button>
                    <button type="submit" name="delete">Excluir</button>
                </form>
                <?php if ($post['image']): ?>
                    <figure>
                        <img src="uploads/<?php echo htmlspecialchars($post['image']); ?>" alt="<?php echo htmlspecialchars($post['image_description']); ?>">
                        <figcaption><?php echo htmlspecialchars($post['image_description']); ?></figcaption>
                    </figure>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Nenhuma publicação encontrada.</p>
    <?php endif; ?>

    <?php include 'templates/footer.php'; ?>
</body>
</html>