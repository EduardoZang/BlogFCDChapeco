<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Blog de Notícias</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <h1>Blog de Notícias</h1>
        <nav>
            <ul>
                <li><a href="index.php">Início</a></li>
                <li><a href="donations.php">Doações</a></li>
                <li><a href="about_us.php">Quem Somos</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="manage_account.php">Minha Conta</a></li>
                    <li><a href="manage_posts.php">Gerenciar Publicações</a></li>
                    <li><a href="logout.php">Sair</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>