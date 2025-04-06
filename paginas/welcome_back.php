<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ESTante | Redirecionar</title>
    <link href="https://fonts.googleapis.com/css2?family=Sour+Gummy:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="welcome_back.css">
</head>

<?php
require_once "./nav.php";
?>

<body>
    <section class="content">
        <div class="image-container">
            <img src="../img/feed.png" alt="Feed Image" class="feed-image">
        </div>
        <div class="text-container">
            <h1>Bem vindo de volta (Nome).</h1> <!-- No futuro detetar o nome com php-->
            <h2>Comece já a navegar!</h2>
            <button href="testLogout.php" class="feed-btn">Feed</button>
        </div>
    </section>
</body>

</html>