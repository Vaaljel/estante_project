<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<html>

<head>
    <title>ESTante | Aprovacao</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Sour+Gummy:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin_aprova.css">
</head>

<body>
<?php
    require_once './nav.php';
    require_once '../basedados/basedados.php';
    require_once '../basedados/auth.php';
    //validaAdmin();
    
    // Processamento da aprovação ou rejeição
    if (isset($_POST['aprovar'])) {
        $id = intval($_POST['aprovar']);
        $sql = "UPDATE `utilizadores` SET `estado` = 'registado' WHERE `utilizadores`.`id_utilizador` = " . $id;
        $result = $conn->query($sql);
    }
    if (isset($_POST['rejeitar'])) {
        $id = intval($_POST['rejeitar']);

        $sql = "UPDATE `utilizadores` SET `estado` = 'negado' WHERE `utilizadores`.`id_utilizador` = " . $id;
        $result = $conn->query($sql);

        $sql = "DELETE FROM utilizadores WHERE estado = 'negado' AND id_utilizador = $id";
        $result = $conn->query($sql);

    }
    ?>
    
    <div class="main">
        <div class="admin-container">
            <h2>Aprovação de Registos</h2>
            <ul class="list-group">
                <?php
                $sql = "SELECT * FROM `utilizadores` WHERE estado='pendente'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<li class="list-group-item">
                            <div class="user-info">
                                ' . $row["nome"] . ' - ' . $row["endereco"] . '
                            </div>
                            <div class="aprovar-registro">
                                <form method="post">
                                    <button type="submit" value="' . $row["id_utilizador"] . '" name="aprovar" class="approve">Aprovar</button>
                                    <button type="submit" value="' . $row["id_utilizador"] . '" name="rejeitar" class="deny">Rejeitar</button>
                                    <a href="" class="checkpro">Ver Processo</a>
                                </form>
                            </div>
                        </li>';
                    }
                } else {
                    echo "<p>Não há registos pendentes para aprovação</p>";
                }
                ?>
            </ul>
        </div>
        
        <!-- Imagens decorativas -->
        <div class="imagem-canto-superior">
            <img src="../img/estrelas.png" alt="Decoração" class="imagem-superior">
        </div>
        <div class="imagem-lateral">
        <img src="../img/estrelas.png" alt="Decoração">
        </div>
    </div>
</body>


</html>