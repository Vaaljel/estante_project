<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>

    <title>ESTante | Index</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Sour+Gummy:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
</head>

<?php
require_once './nav.php';
require_once '../basedados/basedados.php';
require_once '../basedados/auth.php';
?>

<section class="layout">
    <div class="text-box">
        <h1>O melhor lugar para partilhar conhecimento!</h1>
        <hr class="divisor">
        <p>
            Encontra, partilha e colabora com os melhores apontamentos para o teu sucesso académico na EST.
            Acede a resumos, fichas e materiais de estudo feitos por estudantes para estudantes como tu.

            Simplifica a tua aprendizagem e melhora as tuas notas com a nossa comunidade! 🚀📖
        </p>
        <button class="register-btn" onclick="window.location.href='registar.php'">Registar</button>
        <button class="register-btn" onclick="window.location.href='admin_aprova.php'">Botão apro utilizadores</button>
        <button class="register-btn" onclick="window.location.href='consultar_apontamentos.php'">Botão apro apontamentos</button>
    </div>
    <img src="../img/welcomev2.png" alt="Descrição" class="background-image">
</section>


</html>