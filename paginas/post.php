<?php
require_once '../basedados/basedados.php';
require_once '../basedados/auth.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar se o ID do apontamento foi fornecido
if (!isset($_GET['id'])) {
    header("Location: feed.php");
    exit();
}

$id_apo = $_GET['id'];

// Buscar dados do apontamento
$sql_apontamento = "SELECT a.*, u.nome AS nome_utilizador, d.nome AS nome_disciplina 
                    FROM apontamentos a
                    INNER JOIN utilizadores u ON a.id_utilizador = u.id_utilizador
                    INNER JOIN disciplina d ON a.id_disciplina = d.id_disciplina
                    WHERE a.id_apo = ?";

$stmt = $conn->prepare($sql_apontamento);
$stmt->bind_param("i", $id_apo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: feed.php");
    exit();
}

$apontamento = $result->fetch_assoc();

// Buscar comentários do apontamento
$sql_comentarios = "SELECT c.*, u.nome AS nome_utilizador 
                    FROM comentario c
                    INNER JOIN utilizadores u ON c.id_utilizador = u.id_utilizador
                    WHERE c.id_apo = ?
                    ORDER BY c.data_comentario DESC";

$stmt = $conn->prepare($sql_comentarios);
$stmt->bind_param("i", $id_apo);
$stmt->execute();
$comentarios = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <title><?php echo htmlspecialchars($apontamento['titulo']); ?></title>
  <link rel="stylesheet" href="post.css">
  <link href="https://fonts.googleapis.com/css2?family=Sour+Gummy:wght@100..900&display=swap" rel="stylesheet">
</head>

<body>

  <?php
  require_once './nav.php';
  ?>

  <div class="page-container">
    <div class="post-bloco-esquerdo">
      <img src="../<?php echo htmlspecialchars($apontamento['caminho_arquivo']); ?>" alt="Imagem do terminal" class="imagem-terminal">
      <div class="avaliacao">
        <p>Avaliação:</p>
        <div class="estrelas">
          <input type="radio" name="estrela" id="estrela1">
          <label for="estrela1">★</label>
          <input type="radio" name="estrela" id="estrela2">
          <label for="estrela2">★</label>
          <input type="radio" name="estrela" id="estrela3">
          <label for="estrela3">★</label>
        </div>
      </div>
    </div>

    <div class="post-bloco-direito">
      <h2>Descrição</h2>
      <div class="descricao">
        <strong><?php echo htmlspecialchars($apontamento['nome_utilizador']); ?></strong>
        <?php echo htmlspecialchars($apontamento['descricao']); ?>
      </div>

      <div class="botoes-switch">
        <button class="ativo">Sugestões</button>
        <button>Comentários</button>
      </div>

      <?php
      if ($comentarios->num_rows > 0) {
          while ($comentario = $comentarios->fetch_assoc()) {
              echo '<div class="comentario">
                      <strong>' . htmlspecialchars($comentario['nome_utilizador']) . ' ›</strong> 
                      ' . htmlspecialchars($comentario['cometario']) . '
                      <span class="remover">❌</span>
                    </div>';
          }
      } else {
          echo '<div class="comentario">Nenhum comentário ainda.</div>';
      }
      ?>
    </div>
  </div>

</body>

</html>