<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <title>ESTante | Apontamentos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Sour+Gummy:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="consultar_aprovar_apo.css">
</head>

<body>
    <?php
    require_once './nav.php';
    require_once '../basedados/basedados.php';
    require_once '../basedados/auth.php';
    //validaAdmin();

    // Processamento de possíveis ações nos apontamentos
    if (isset($_POST['aprovar'])) {
        $id = intval($_POST['aprovar']);
        $sql = "UPDATE `apontamentos` SET `estado_apo` = 'aprovado' WHERE `apontamentos`.`id_apo` = " . $id;
        $result = $conn->query($sql);
    }
    if (isset($_POST['rejeitar'])) {
        $id = intval($_POST['rejeitar']);
        $sql = "UPDATE `apontamentos` SET `estado_apo` = 'negado' WHERE `apontamentos`.`id_apo` = " . $id;
        $result = $conn->query($sql);
        header("Location:apontamentos_rejeitados.php"); 
    }
    ?>

    <div class="main">
        <div class="admin-container">
            <h2>Lista de Apontamentos</h2>
            <ul class="list-group">
                <?php

                //Query para apenas consultar os apontamentos (GERAL NÃO FAZ DESTINÇÃO SE ESTÁ PENDENTE OU NÃO ÚTIL SE FOR NECESSARIO CONSULTAR ESTE TIPO DE DADOS)
                /*   $sql = "SELECT a.*, u.nome AS nome_utilizador, d.nome AS nome_disciplina 
                        FROM apontamentos a
                        INNER JOIN utilizadores u ON a.id_utilizador = u.id_utilizador
                        INNER JOIN disciplina d ON a.id_disciplina = d.id_disciplina
                        ORDER BY a.data_submissao DESC";
                        */

                $sql = "SELECT a.*, u.nome AS nome_utilizador, d.nome AS nome_disciplina 
                        FROM apontamentos a
                        INNER JOIN utilizadores u ON a.id_utilizador = u.id_utilizador
                        INNER JOIN disciplina d ON a.id_disciplina = d.id_disciplina
                        WHERE a.estado_apo = 'pendente'
                        ORDER BY a.data_submissao DESC";

                $result = $conn->query($sql);

                if (!$result) {
                    die("Erro na consulta: " . $conn->error);
                }

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Define a classe CSS baseada no estado
                        $estado_class = $row["estado_apo"];

                        echo '<li class="list-group-item">
                            <div class="apontamento-info">
                                <h3>' . $row["titulo"] . '</h3>
                                <p>Disciplina: ' . $row["nome_disciplina"] . '</p>
                                <p>Utilizador: ' . $row["nome_utilizador"] . '</p>
                                <p>Data: ' . $row["data_submissao"] . '</p>
                                <p class="' . $estado_class . '">Estado: ' . $row["estado_apo"] . '</p>
                            </div>
                            <div class="acoes">
                                <form method="post">
                                    <button type="submit" value="' . $row["id_apo"] . '" name="aprovar" class="approve">Aprovar</button>
                                    <button type="submit" value="' . $row["id_apo"] . '" name="rejeitar" class="deny">Rejeitar</button>
                                    <a href="visualizar_apontamento.php?id=' . $row["id_apo"] . '" class="checkpro">Visualizar</a>
                                </form>
                            </div>
                        </li>';
                    }
                } else {
                    echo "<p>Não foram encontrados apontamentos.</p>";
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