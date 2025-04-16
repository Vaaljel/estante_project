<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>

<html lang="pt">

<head>
    <title>ESTante | Redirecionar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Sour+Gummy:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="pagina_espera.css">
</head>

<body>
    <?php
    include './nav.php'
    ?>

    <section class="container">
        <img src="../img/gato_exclamacao.png" alt="Espera de Confirmação" class="waiting-image">
        <div class="content">
            <p>
                Um pedido de confirmação foi enviado a um administrador para aprovar o seu registo.
                Por favor, aguarde... Irá ser avisado por e-mail sobre o estado do pedido.
            </p>
            <button class="navbar-btn" onclick="window.location.href='index.php'">Página Principal</button>
        </div>
    </section>

</body>

</html>