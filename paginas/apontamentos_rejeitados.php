<?php
// Página: apontamentos_rejeitados.php
require_once '../basedados/basedados.php';
require_once '../basedados/auth.php';

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// Processar o formulário quando for submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $motivo = htmlspecialchars($_POST['motivo'] ?? '');
  $mostrar_modal = false;
  $mensagem = "Motivo da rejeição registrado: " . $motivo;
} else {
  $mostrar_modal = true;
  $mensagem = '';
}

if (isset($_POST['redirect'])) {
  header("Location: aprovacao_apontamentos.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
  <title>ESTante | Rejeitar Apontamento</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Sour+Gummy:wght@100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="apo_reijatados.css">
</head>

<body>
  <?php require_once "./nav.php"; ?>

  <div class="background">
    <img src="../img/estrelas.png" class="icon star-left" alt="estrela">
    <img src="../img/gatoArpovadorDois.png" class="icon cat" alt="gato">
    <img src="../img/estrelas.png" class="icon star-right" alt="estrela">

    <h1>Apontamentos Rejeitados</h1>

    <!-- Modal -->
    <div class="modal">
      <div class="modal-content">
        <span class="fechar" onclick="this.parentNode.parentNode.style.display='none'">&times;</span>
        <h2>Registrar Motivo da Rejeição</h2>

        <form method="post">
          <label for="motivo">Motivo da Rejeição:</label><br>
          <textarea id="motivo" name="motivo" required></textarea><br>

          <button type="submit" class="btn">Submeter</button>
        </form>
      </div>
    </div>

    <!-- Mensagem de confirmação -->
    <?php if (!empty($mensagem)): ?>
      <div class="confirmation">
        <form method="post" action="">
          <input type="hidden" name="redirect" value="true">
          <button type="submit" class="btn-confirm">✓ Feito</button>
        </form>
      </div>
    <?php endif; ?>
  </div>
</body>

</html>