<html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Sour+Gummy:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="nav.css">
</head>
<header>
    <div class="logo">
        <img src="../img/logo-nav.png" alt="Logo" class="logo-img">
    </div>
    <nav>
        <ul>
            <li><a href="perfil.php" class="perfil"> <img src="../img/perfil-nav.png" alt="Logo" class="perfil-img"> </a></li>
            <li><a href="index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'feed.php' ? 'active' : ''; ?>">Feed</a></li>
            <li><a href="index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'sobre.php' ? 'active' : ''; ?>">Sobre</a></li>
        </ul>
    </nav>
</header>
</html>