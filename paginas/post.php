<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Publicar Apontamento</title>
  <link rel="stylesheet" href="post.css">
  <link href="https://fonts.googleapis.com/css2?family=Sour+Gummy:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>
<?php
require_once './nav.php';
require_once '../basedados/basedados.php';
require_once '../basedados/auth.php';
?>
 

  <div class="page-container">
    <div class="post-bloco-esquerdo">
      <img src="img/.png" alt="Imagem do terminal" class="imagem-terminal">
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
        <strong><Marco ></strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit...
      </div>

      <div class="botoes-switch">
        <button class="ativo">Sugestões</button>
        <button>Comentários</button>
      </div>

      <div class="comentario">
        <strong>Marco ›</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit...
        <span class="remover">❌</span>
      </div>
      <div class="comentario">
        <strong>Marco ›</strong> Outro comentário  
        <span class="remover">❌</span>
      </div>
      <div class="comentario">
        <strong>Marco ›</strong> Outro comentário  
        <span class="remover">❌</span>
      </div>
      <div class="comentario">
        <strong>Marco ›</strong> Outro comentário  
        <span class="remover">❌</span>
      </div>
      <div class="comentario">
        <strong>Marco ›</strong> Outro comentário  
        <span class="remover">❌</span>
      </div>
      <div class="comentario">
        <strong>Marco ›</strong> Outro comentário 
        <span class="remover">❌</span>
      </div>
    </div>
  </div>

</body>
</html>