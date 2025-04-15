<html>

<head>
    <title>ESTante | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Sour+Gummy:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
</head>
<?php
require_once "./nav.php";
require_once '../basedados/basedados.php';
require_once '../basedados/auth.php';
?>


<body>

    <main class="main">
        <div class="perfil-container">
            <div class="perfil-info">
                <div class="estanteLogo">ESTante</div>
                <form method="POST">
                    <?php

                    require_once '../basedados/basedados.php';
                    require_once '../basedados/auth.php';

                    //Se ele estiver já na condição de login ele redireciona para a página do feed
                    if (isLoggedIn()) {
                        header("Location: welcome_back.php");
                        exit;
                    }

                    //Verifica se consegue entrar
                    if (isset($_POST["endereco"])) {
                        if (login($_POST["endereco"], $_POST["pass"])) {
                            header(header: "Location: welcome_back.php"); //Se sucesso entra no site
                            exit;
                        } else {
                            //header(header: "Location: login.php"); //Erro não conseguiu entrar
                            echo '<div class="input-group">
                                    <label>Falha ao entrar</label>
                                </div>';
                        }
                    } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        header("Location: pagina_erro.php");
                    }

                    //Adicionar mais tarde aviso no html que falhou e caso isto aconteça não mude de página
                    ?>
                    <div class="input-group">
                        <label>Email</label>
                        <input type="email" name="endereco" placeholder="nome" required>
                    </div>
                    <div class="input-group">
                        <label>Password</label>
                        <input type="password" name="pass" placeholder="*****" required>
                    </div>
                    <button class="btn" type="submit">Entrar</button>
                    <button onclick="window.location.href='registar.php'" class="btn">Não tenho conta</button>
                </form>
            </div>
            <br>
            <a href="">Recuperar conta</a>
        </div>
        <div class="imagem-canto-superior">
            <img src="../img/estrelas.png" alt="Decoração" class="imagem-superior">
        </div>
        <div class="imagem-lateral">
            <img src="../img/estrelas.png" alt="Decoração">
        </div>
    </main>
</body>

</html>
