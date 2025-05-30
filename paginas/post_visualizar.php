<?php
require_once '../basedados/basedados.php';
require_once '../basedados/auth.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verificar se o ID do apontamento foi fornecido
if (!isset($_GET['id'])) {
    header("Location: feed.php");
    exit();
}

$id_apo = $_GET['id'];

// Handle comment submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['comentario']) && isLoggedIn()) {
        try {
            $comentario = escaparString($_POST['comentario']);
            $id_utilizador = $_SESSION['user_id'];

            // Debug information
            error_log("Attempting to insert comment. User ID: " . $id_utilizador . ", Post ID: " . $id_apo);

            $sql_insert = "INSERT INTO comentario (id_apo, id_utilizador, cometario) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql_insert);

            if (!$stmt) {
                throw new Exception("Prepare failed: " . $conn->error);
            }

            $stmt->bind_param("iis", $id_apo, $id_utilizador, $comentario);

            if (!$stmt->execute()) {
                throw new Exception("Execute failed: " . $stmt->error);
            }

            // Redirect to refresh the page and show the new comment
            header("Location: post.php?id=" . $id_apo);
            exit();
        } catch (Exception $e) {
            error_log("Error in comment submission: " . $e->getMessage());
            echo "Erro ao enviar comentário. Por favor, tente novamente.";
        }
    } elseif (isset($_POST['delete_comment']) && isLoggedIn()) {
        $id_comentario = $_POST['delete_comment'];

        // Verificar se o usuário tem permissão para apagar o comentário
        $sql_check = "SELECT c.id_utilizador, u.cargo 
                     FROM comentario c 
                     INNER JOIN utilizadores u ON c.id_utilizador = u.id_utilizador 
                     WHERE c.id_comentario = ?";

        $stmt = $conn->prepare($sql_check);
        $stmt->bind_param("i", $id_comentario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $comment_data = $result->fetch_assoc();

            // Verificar se o usuário é o dono do comentário ou tem cargo de moderador/administrador
            if (
                $_SESSION['user_id'] == $comment_data['id_utilizador'] ||
                $_SESSION['cargo'] == 'moderador'
            ) {

                // Apagar o comentário
                $sql_delete = "DELETE FROM comentario WHERE id_comentario = ?";
                $stmt = $conn->prepare($sql_delete);
                $stmt->bind_param("i", $id_comentario);

                if ($stmt->execute()) {
                    header("Location: post.php?id=" . $id_apo);
                    exit();
                } else {
                    echo "Erro ao apagar o comentário.";
                }
            } else {
                echo "Você não tem permissão para apagar este comentário.";
            }
        }
    }
}

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



            <div class="comentarios-container">
                <?php if (isLoggedIn()): ?>
                    <form method="POST" action="" class="comentario-form">
                        <div class="form-header">
                            <h3>Adicionar Comentário</h3>
                        </div>
                        <textarea name="comentario" placeholder="Comenta aqui" required></textarea>
                        <button type="submit" class="submit-btn">
                            <span>Enviar Comentário</span>
                            <i class="arrow">→</i>
                        </button>
                    </form>
                <?php else: ?>
                    <div class="login-prompt">
                        <p>Faça login para deixar um comentário</p>
                        <a href="login.php" class="login-btn">Login</a>
                    </div>
                <?php endif; ?>

                <div class="comentarios-lista">
                    <h3>Comentários</h3>
                    <div class="comentarios-content">
                        <?php
                        if ($comentarios->num_rows > 0) {
                            while ($comentario = $comentarios->fetch_assoc()) {
                                $can_delete = false;
                                if (isLoggedIn()) {
                                    $can_delete = ($_SESSION['user_id'] == $comentario['id_utilizador'] ||
                                        $_SESSION['cargo'] == 'moderador' ||
                                        $_SESSION['cargo'] == 'administrador');
                                }

                                echo '<div class="comentario">
                        <div class="comentario-header">
                          <strong>' . htmlspecialchars($comentario['nome_utilizador']) . '</strong>
                          <span class="data">' . date('d/m/Y', strtotime($comentario['data_comentario'])) . '</span>
                        </div>
                        <div class="comentario-conteudo">
                          ' . htmlspecialchars($comentario['cometario']) . '
                        </div>';

                                if ($can_delete) {
                                    echo '<form method="POST" action="" class="delete-form">
                          <input type="hidden" name="delete_comment" value="' . $comentario['id_comentario'] . '">
                          <button type="submit" class="remover" title="Remover comentário">❌</button>
                        </form>';
                                }

                                echo '</div>';
                            }
                        } else {
                            echo '<div class="sem-comentarios">Nenhum comentário ainda. Seja o primeiro a comentar!</div>';
                        }
                        ?>
                        <div class="sugestao-link">
                            <a href="#" id="abrirSugestao">Tens alguma sugestão de melhoria? Submete aqui.</a><br>
                            <button class="submit-btn" onclick="window.location.href='aprovacao_apontamentos.php'">
                                <span>Voltar Atrás</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Popup de Sugestão -->
            <div id="popupSugestao" class="popup-overlay">
                <div class="popup-content">
 x\                   <span class="fechar-popup">&times;</span>
                    <form method="POST" action="" class="sugestao-form">
                        <div class="form-header">
                            <h3>Enviar Sugestão</h3>
                        </div>
                        <textarea name="sugestao" placeholder="Escreve aqui a tua sugestão..." required></textarea>
                        <button type="submit" class="submit-btn">
                            <span>Enviar Sugestão</span>
                            <i class="arrow">→</i>
                        </button>
                    </form>
                </div>
            </div>

            <script>
                // Elementos do popup
                const popup = document.getElementById('popupSugestao');
                const abrirBtn = document.getElementById('abrirSugestao');
                const fecharBtn = document.querySelector('.fechar-popup');

                // Abrir popup
                abrirBtn.onclick = function(e) {
                    e.preventDefault();
                    popup.style.display = "flex";
                }

                // Fechar popup
                fecharBtn.onclick = function() {
                    popup.style.display = "none";
                }

                // Fechar popup ao clicar fora
                window.onclick = function(e) {
                    if (e.target == popup) {
                        popup.style.display = "none";
                    }
                }
            </script>
        </div>
    </div>

</body>

</html>