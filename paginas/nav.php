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
        <?php
         require_once '../basedados/basedados.php';
         require_once '../basedados/auth.php';
            if(isLoggedIn()){
                echo  '<li><a href="perfil.php" class="perfil"> <img src="../img/perfil-nav.png" alt="Logo" class="perfil-img"> </a></li>';
            }
             ?>
            <li><a href="index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">Início</a></li>
            <li><a href="sobre.php" class="<?php echo basename(path: $_SERVER['PHP_SELF']) == 'sobre.php' ? 'active' : ''; ?>">Sobre</a></li>
            <li><a href="login.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'login.php' ? 'active' : ''; ?>">Entrar</a></li>
            <li><a href="registar.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'registar.php' ? 'active' : ''; ?>">Registar</a></li>
        </ul>
    </nav>
</header>
</html>