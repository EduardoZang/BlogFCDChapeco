<?php
include 'db.php';

// Busca todas as publicações
$stmt = $pdo->prepare("SELECT * FROM posts ORDER BY created_at DESC");
$stmt->execute();
$posts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Blog de Notícias</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'templates/header.php'; ?>

    <main>
        <h1>Últimas Notícias</h1>
        <?php foreach ($posts as $post): ?>
            <article>
                <h2><?php echo htmlspecialchars($post['title']); ?></h2>
                <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
                <?php if ($post['image']): ?>
                    <figure>
                        <img src="uploads/<?php echo htmlspecialchars($post['image']); ?>" alt="Imagem da publicação">
                        <figcaption><?php echo htmlspecialchars($post['image_description']); ?></figcaption>
                    </figure>
                <?php endif; ?>
                <hr>
            </article>
        <?php endforeach; ?>
    </main>

    <?php include 'templates/footer.php'; ?>
</body>
</html>