<html>

<head>

    <title>ESTante | Perfil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Sour+Gummy:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="registo_aprovacao.css">
</head>

<?php 
require_once "./nav.php";
require_once '../basedados/basedados.php';
require_once '../basedados/auth.php';

$user=getUser();
#print_r($user);
?>

<body>
  <div class="background">
    <img src="..\img\estrelas.png" class="icon star-left" alt="estrela">
    <img src="..\img\gatoArpovadorDois.png" class="icon cat" alt="gato">
    <img src="..\img\estrelas.png" class="icon star-right" alt="estrela">

    <div class="card">
      <!-- <img src="foto.jpg" alt="Foto do Aluno" class="profile-pic"> -->
      <div class="header">
        <h2><?= $user['nome'] ?></h2>
        <p>Número de aluno: <span><?= $user['id_utilizador'] ?></span> | Curso: Engenharia Informática</p>
        <p>Email: <?= $user['endereco'] ?></p>
      </div>
      </div>

      <div class="acoes">
                                <form class="acoes" method="post">
                                    <button type="submit" value="' . $row["id_apo"] . '" name="aprovar" class="approve">Aprovar</button>
                                    <button type="submit" value="' . $row["id_apo"] . '" name="rejeitar" class="deny">Rejeitar</button>
                                </form>
                            </div>

    </div>
  </div>
</body>
</html>