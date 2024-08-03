<header>
    <h1>Blog de Notícias</h1>
    <nav>
        <ul>
            <li><a href="index.php">Início</a></li>
            <li><a href="donations.php">Doações</a></li>
            <li><a href="about_us.php">Quem Somos</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="manage_account.php">Minha Conta</a></li>
                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                    <li><a href="manage_posts.php">Gerenciar Publicações</a></li>
                <?php endif; ?>
                <li><a href="logout.php">Sair</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Registrar</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>