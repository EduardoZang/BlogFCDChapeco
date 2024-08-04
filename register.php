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
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    $stmt = $pdo->prepare("INSERT INTO users (username, password, is_admin) VALUES (?, ?, ?)");
    $stmt->execute([$username, $password, $is_admin]);
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
    <form action="register.php" method="POST">
        <label for="username">Usuário:</label>
        <input type="text" name="username" required>
        <label for="password">Senha:</label>
        <input type="password" name="password" required>
        <label for="is_admin">Administrador:</label>
        <input type="checkbox" name="is_admin">
        <button type="submit">Cadastrar</button>
    </form>

    <?php include 'templates/footer.php'; ?>
</body>
</html>
