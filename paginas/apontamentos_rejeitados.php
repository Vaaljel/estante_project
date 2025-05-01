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
  <style>
    body {
      margin: 0;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      font-family: 'Arial', sans-serif;
      background-color: #111;
      color: #fff;
    }
    
    .background {
      flex: 1;
      position: relative;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
    }
    
    .icon {
      position: absolute;
      width: 80px;
    }
    
    .star-left {
      top: 40px;
      left: 30px;
      width: 140px;
      opacity: 0.7;
    }
    
    .star-right {
      top: 40px;
      right: 30px;
      width: 140px;
      opacity: 0.7;
    }
    
    .cat {
      bottom: 0px;
      left: 50px;
      width: 140px;
      opacity: 0.8;
    }
    
    .modal {
      display: <?php echo $mostrar_modal ? 'flex' : 'none'; ?>;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.8);
      z-index: 1000;
      justify-content: center;
      align-items: center;
    }
    
    .modal-content {
      background-color: #222;
      color: #fff;
      padding: 30px;
      border-radius: 15px;
      width: 400px;
      max-width: 90%;
      box-shadow: 0 0 15px #444;
      position: relative;
    }
    
    .fechar {
      position: absolute;
      top: 15px;
      right: 15px;
      color: #ccc;
      font-size: 24px;
      cursor: pointer;
    }
    
    .modal-content h2 {
      margin-top: 0;
      color: #fff;
      text-align: center;
    }
    
    textarea {
      width: 100%;
      padding: 10px;
      border-radius: 8px;
      border: 1px solid #444;
      background-color: #333;
      color: #fff;
      margin-bottom: 15px;
      resize: vertical;
      min-height: 100px;
    }
    
    .btn {
      padding: 10px 20px;
      background-color: #fff;
      color: #000;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
      width: 100%;
    }
    
    .btn:hover {
      background-color: #eee;
    }
    
    .confirmation {
      background-color: #222;
      padding: 20px;
      border-radius: 10px;
      margin: 20px auto;
      max-width: 500px;
      text-align: center;
    }
    
    .confirmation a {
      color: #fff;
      text-decoration: underline;
    }
    .btn-confirm {
  margin-top: 15px;
  padding: 10px 25px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 10px;
  cursor: pointer;
  font-weight: bold;
  transition: all 0.3s ease;
  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.btn-confirm:hover {
  background-color: #45a049;
  transform: scale(1.03);
  box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}


  </style>
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