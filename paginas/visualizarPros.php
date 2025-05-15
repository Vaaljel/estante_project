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
    <title>ESTante | Feed Moderador</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Sour+Gummy:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="perfil.css"
        </head>
    <?php
    require_once './nav.php';
    ?>

<body>
    <div class="background">
        <img src="..\img\estrelas.png" class="icon star-left" alt="estrela">
        <img src="..\img\gatoArpovadorDois.png" class="icon cat" alt="gato">
        <img src="..\img\estrelas.png" class="icon star-right" alt="estrela">
        <div class="card">
            <!-- <img src="foto.jpg" alt="Foto do Aluno" class="profile-pic"> -->
            <div class="header">
                <?php
                $idUtili = isset($_POST['ver_processo']) ? $_POST['ver_processo'] : '';

                $idUtili = escaparString($idUtili);

                $sql = "SELECT * FROM utilizadores WHERE id_utilizador=$idUtili";
                $result = executarQuery($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '
                        <div class="user-profile">
                            <h2>' . $row['nome'] . '</h2>
                            <p>Número de aluno: <span>' . $row['id_utilizador'] . '</span> | Curso: Engenharia Informática</p>
                            <p>Email: ' . $row['endereco'] . '</p>
                        </div>';
                    }
                }
                ?>
            <a href="admin_aprova.php" class="white">Voltar a lista</a>
            </div>
        </div>
    </div>
</body>

</html>