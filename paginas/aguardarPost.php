<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Moderação de Post's</title>
  <link href="https://fonts.googleapis.com/css2?family=Sour+Gummy:wght@100..900&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="aguardarPost.css"/>
</head>

<?php
require_once './nav.php';
require_once '../basedados/basedados.php';
require_once '../basedados/auth.php';
?>

<body>
  <div class="container">
    <div class="alerta">
      <p class="mensagem">
        O seu post foi enviado para um dos nossos moderadores para ser analisada para prosseguir para a publicação.
      </p>
      <a href="feed.php" class="botao">Feed</a>
    </div>
    <img src="../img/gato_exclamacao.png" alt="Gato moderador" class="gato-img">
  </div>
</body>
</html>