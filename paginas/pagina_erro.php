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
    <title>ESTante | Erro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Sour+Gummy:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="erro.css">
</head>

<?php
require_once "./nav.php";
?>

<body>
    <section class="erro-container">
        <div class="erro-imagem">
            <img src="../img/gato_engrenagens.png" alt="Erro" class="img-erro">
        </div>
        <div class="erro-texto">
            <h1>Algo correu mal: Erro 404</h1>
        </div>
    </section>
</body>

</html>