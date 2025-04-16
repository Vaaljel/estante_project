<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ESTante | Sobre</title>
    <link href="https://fonts.googleapis.com/css2?family=Sour+Gummy:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="sobre.css">
</head>

<body>

    <?php
    include './nav.php' ?>

    <section class="sobre">
        <div class="titulo-box">
            <h1>Sobre Nós e Projeto</h1>
        </div>
        <div class="paragrafo-box">
            <p>Somos uma equipa de estudantes da Escola Superior de Tecnologia de Castelo Branco,
                que a pedido do cliente Escola Superior de Tecnologia de Castelo Branco, desenvolvem e mantêm um website de partilha de apontamentos para os estudantes.
            </p>
        </div>
    </section>
</body>

</html>