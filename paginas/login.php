<html>

<head>
    <title>ESTante | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Sour+Gummy:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
</head>

</head>
<?php
include "./nav.php";

require_once '../basedados/basedados.php';
require_once '../basedados/auth.php';

//Se ele estiver já na condição de login ele redireciona para a página do feed
if (isLoggedIn()) {
    header("Location: welcome_back.php");
    exit;
}

//Verifica se consegue entrar
if (isset($_POST["user"])) {
    if (login($_POST["user"], $_POST["pass"])) {
        header(header: "Location: welcome_back.php"); //Se sucesso entra no site
        exit;
    } else {
        echo "Não encontro dados iguais"; //Caso Erro
    }
} else {
    echo "Algo correu mal na conexão"; //Caso Erro
}

//Adicionar mais tarde aviso no html que falhou e caso isto aconteça não mude de página
?>

<body>
    <div class="logo-container">
    </div>

    <main class="main">
        <div class="perfil-container">
            <div class="perfil-info">
                <div class="estanteLogo">ESTante</div>
                <form method="POST">
                    <div class="input-group">
                        <label>Nome do Utilizador</label>
                        <input type="text" name="user" placeholder="nome" required>
                    </div>
                    <div class="input-group">
                        <label>Secret PassWord</label>
                        <input type="password" name="pass" placeholder="*****" required>
                    </div>
                    <button class="btn" type="submit">Entrar</button>
                    <button href="registar.php" class="btn" type="submit">Não tenho conta</button>
                </form>
            </div>
            <br>
            <a href="">Recuperar conta</a>
        </div>
    </main>

</body>

</html>