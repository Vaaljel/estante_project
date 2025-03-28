<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro - ESTante</title>
    <link rel="stylesheet" href="erro.css">
   
</head>
    <?php
    include "./nav.php";
    ?>
<body>

    <section class="erro-container">
        <div class="erro-imagem">
            <img src="./img/gato_engrenagens.png" alt="Erro" class="img-erro">
        </div>
        <div class="erro-texto">
            <h1>Algo correu mal: Erro 404</h1>
        </div>
    </section>
</body>
</html>



<?php
require_once '../base_dados/basedados.sql';
require_once 'auth.php';

if(isLoggedIn()){
    header("Location: index.php");
    exit;
}

if(isset($_POST["user"])){
    if(login($_POST["user"], $_POST["pass"])){
        header(header: "Location: index.php");
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

require_once '../basedados/basedados2.php'; 
require_once 'auth.php';




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    
    if (login($username, $password)) {
        header("Location: teste.php");
        exit;
    } else {
        echo "Invalid username or password.";
    }
}
if (!isLoggedIn()) {
    header("Location: erro.php"); 
    exit;
}
?>