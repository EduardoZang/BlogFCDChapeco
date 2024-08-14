<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Blog de Notícias</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="assets/css/header.css">
</head>
<body>
<header>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <img src="assets/images/logoFCD.png" alt="Logo" class="logo">
            <nav class="navbar navbar-expand-md navbar-light">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Início</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="donations.php">Doações</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="adress.php">Como Chegar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about_us.php">Quem Somos</a>
                        </li>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="manage_posts.php">Gerenciar Publicações</a>
                                </li>
                            <?php endif; ?>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">Sair</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="login.php">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="register.php">Registrar</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </nav>
            <div class="social-icons">
                <a href="https://www.facebook.com/fcdchapeco/?locale=pt_BR" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/explore/locations/841625812615423/fraternidade-crista-de-doentes-e-deficientes-de-chapeco-scfc/" target="_blank"><i class="fab fa-instagram"></i></a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="manage_account.php">
                            <?php if (isset($_SESSION['profile_image']) && $_SESSION['profile_image'] !== 'perfilPadrao.png'): ?>
                                <img src="uploads/<?php echo htmlspecialchars($_SESSION['profile_image']); ?>" alt="Foto de Perfil" class="profile-icon">
                            <?php else: ?>
                                <img src="uploads/perfilPadrao.png" alt="Foto de Perfil Padrão" class="profile-icon">
                            <?php endif; ?>
                        </a>
                    </li>
                <?php else: ?>
                    <a href="login.php"><i class="fas fa-user"></i></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>
<!-- Rest of the page content -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>