<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="pagina_espera.css">
    <title>Registar | ESTante</title>
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