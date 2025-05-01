<?php
require_once '../basedados/basedados.php';
require_once '../basedados/auth.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="pt">

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
            if (isLoggedIn()) {
                // Show role-specific links first
                if ($_SESSION['cargo'] == 'administrador') {
                    echo '<li><a href="admin_aprova.php" class="' . (basename($_SERVER['PHP_SELF']) == 'admin_aprova.php' ? 'active' : '') . '">Aprova Registos</a></li>';
                    echo '<li><a href="feed.php" class="' . (basename($_SERVER['PHP_SELF']) == 'feed.php' ? 'active' : '') . '">Feed</a></li>';
                    echo '<li><a href="sobre.php" class="' . (basename($_SERVER['PHP_SELF']) == 'sobre.php' ? 'active' : '') . '">Sobre</a></li>';
                    echo '<li><a href="perfil.php" class="' . (basename($_SERVER['PHP_SELF']) == 'perfil.php' ? 'active' : '') . ' perfil"><img src="../img/perfil-nav.png" alt="Logo" class="perfil-img"></a></li>';

                } elseif ($_SESSION['cargo'] == 'moderador') {
                    echo '<li><a href="aprovacao_apontamentos.php" class="' . (basename($_SERVER['PHP_SELF']) == 'aprovacao_apontamentos.php' ? 'active' : '') . '">Mod Feed</a></li>';
                    echo '<li><a href="feed.php" class="' . (basename($_SERVER['PHP_SELF']) == 'feed.php' ? 'active' : '') . '">Feed</a></li>';
                    echo '<li><a href="sobre.php" class="' . (basename($_SERVER['PHP_SELF']) == 'sobre.php' ? 'active' : '') . '">Sobre</a></li>';
                    echo '<li><a href="perfil.php" class="' . (basename($_SERVER['PHP_SELF']) == 'perfil.php' ? 'active' : '') . ' perfil"><img src="../img/perfil-nav.png" alt="Logo" class="perfil-img"></a></li>';

                } elseif ($_SESSION['cargo'] == 'cliente'){
                        // Last three links for all logged-in users: feed, sobre, perfil
                   echo '<li><a href="feed.php" class="' . (basename($_SERVER['PHP_SELF']) == 'feed.php' ? 'active' : '') . '">Feed</a></li>';
                   echo '<li><a href="sobre.php" class="' . (basename($_SERVER['PHP_SELF']) == 'sobre.php' ? 'active' : '') . '">Sobre</a></li>';
                   echo '<li><a href="perfil.php" class="' . (basename($_SERVER['PHP_SELF']) == 'perfil.php' ? 'active' : '') . ' perfil"><img src="../img/perfil-nav.png" alt="Logo" class="perfil-img"></a></li>';

                }

                
                // Red logout button with icon
                echo '<li><a href="testLogout.php" class="logout-btn"><img src="../img/logout-icon.png" alt="x" class="logout-img"></a></li>';
            } else {
                echo '<li><a href="index.php" class="' . (basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '') . '">Início</a></li>';

                // For non-logged in users: sobre, login, register
                echo '<li><a href="sobre.php" class="' . (basename($_SERVER['PHP_SELF']) == 'sobre.php' ? 'active' : '') . '">Sobre</a></li>';
                echo '<li><a href="login.php" class="' . (basename($_SERVER['PHP_SELF']) == 'login.php' ? 'active' : '') . '">Entrar</a></li>';
                echo '<li><a href="registar.php" class="' . (basename($_SERVER['PHP_SELF']) == 'registar.php' ? 'active' : '') . '">Registar</a></li>';
            }
            ?>
        </ul>
    </nav>
</header>

</html>