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
    <title>ESTante | Feed</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Sour+Gummy:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="feed.css">
</head>

<body>
    <?php
    require_once './nav.php';
    ?>

    <div class="main">
        <div class="admin-container">
            <ul class="list-group">
                <?php

                $sql = "SELECT a.*, u.nome AS nome_utilizador, d.nome AS nome_disciplina 
                        FROM apontamentos a
                        INNER JOIN utilizadores u ON a.id_utilizador = u.id_utilizador
                        INNER JOIN disciplina d ON a.id_disciplina = d.id_disciplina
                        WHERE a.estado_apo = 'aprovado'
                        ORDER BY a.data_submissao DESC";

                $result = $conn->query($sql);

                if (!$result) {
                    die("Erro na consulta: " . $conn->error);
                }

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Define a classe CSS baseada no estado
                        $estado_class = $row["estado_apo"];
                        echo '
                    <a href="post.php?id=' . $row["id_apo"] . '" class="post-link">
                    <div class="post">
                    <div class="post-header">
                    <img src="https://via.placeholder.com/30" alt="Marco">
                    › ' . $row["nome_utilizador"] . '
                    </div>
                    <img class="post-image" src="..\\' . $row["caminho_arquivo"] . '" alt="Terminal Linux">
                    
                    <div class="post-stars-action">
                    <div class="post-stars">
                    <span>☆</span>
                    <span>☆</span>
                    <span>☆</span>
                    </div>

                    <div class="post-actions">
                    <span>📑</span>
                    <span>🗨️</span>
                    </div>
                    </div>

                    <div class="post-description">
                    <strong>' . $row["nome_utilizador"] . '›</strong>
                        ' . $row["descricao"] . '
                    </div>
                </div>
                </a>
                        ';
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

        <!-- Botão de submissão de apontamento -->
        <?php if (isLoggedIn()): ?>
            <a href="submeter_post.php" class="submit-button" title="Submeter Apontamento">+</a>
        <?php endif; ?>
    </div>
</body>

</html>