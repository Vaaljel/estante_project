<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ESTante- Início</title>
    <link href="https://fonts.googleapis.com/css2?family=Sour+Gummy:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<?php 
    $pagina = 'index';
    include './nav.php' 
?>
    <section class="hero">
        <div class="text-box">
            <h1>O melhor lugar para partilhar conhecimento!</h1>
            <hr class="divider"> 
            <p>
                Encontra, partilha e colabora com os melhores apontamentos para o teu sucesso académico na EST.  
                Acede a resumos, fichas e materiais de estudo feitos por estudantes para estudantes como tu.  
                <br><br>
                Simplifica a tua aprendizagem e melhora as tuas notas com a nossa comunidade! 🚀📖
            </p>
            <button class="register-btn" onclick="window.location.href='registar.html'">Registar</button>
        </div>
        
        <img src="img/imagemWelcome.png incial.1.png" alt="Descrição" class="background-image">
    </section>

    <script src="script.js"></script>

</html>