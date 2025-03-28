
<html lang="pt">

<head>

    <meta charset="UTF-8">
    <link rel="stylesheet" href="login.css">
    <title>Entrar | ESTante</title>

</head>
<?php
include "./nav.php";

require_once '../basedados/basedados.h';
require_once './auth.php';

if(isLoggedIn()){
    header("Location: teste.php");
    exit;
}

if(isset($_GET["user"])){
    if(login($_GET["user"], $_GET["pass"])){
        header(header: "Location: teste.php");
        exit;
    }
    else {
        echo "shii";
    }
}
else{
    echo "No data";
}
?>
<body>



<div class="logo-container">
</div>

<main class="main"> 
    <div class="perfil-container">
        <div class="perfil-info">
            <div class="estanteLogo">ESTante</div>
            <form method="GET">
                <div class="input-group">
                    <label>Nome do Utilizador</label>
                    <input type="text" name="user" placeholder="nome" required>
                </div>
                <div class="input-group">
                    <label>Secret PassWord</label>
                    <input type="password" name="pass" placeholder="secret" required>
                </div>
                <button class="btn" type="submit">Entrar</button>
                <button class="btn" type="submit">Não tenho conta</button>
            </form>
        </div>
        <br>
        <a href="#">Recuperar conta</a> 
    </div>
</main>


<?php



?>

</html>