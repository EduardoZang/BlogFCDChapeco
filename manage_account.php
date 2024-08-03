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

    $stmt = $pdo->prepare("UPDATE users SET username = ?, password = ? WHERE id = ?");
    $stmt->execute([$username, $password, $user_id]);
    $success = "Informações atualizadas com sucesso";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Conta</title>
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
                    <li><a href="register.php">Registrar</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    
    <h1>Gerenciar Conta</h1>
    <?php if (isset($success)): ?>
        <p><?php echo $success; ?></p>
    <?php endif; ?>
    <form action="manage_account.php" method="POST">
        <label for="username">Usuário:</label>
        <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        <label for="password">Senha (deixe em branco para manter a atual):</label>
        <input type="password" name="password">
        <button type="submit">Atualizar</button>
    </form>
</body>
</html>