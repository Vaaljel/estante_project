<!DOCTYPE html>
<html lang="pt">

<head>

    <meta charset="UTF-8">
    <link rel="stylesheet" href="registar.css">
    <title>Entrar | ESTante</title>

</head>

<body>
    <?php
    $pagina = 'login';
    include './nav.php' ?>

    <main class="main">
        <div class="perfil-container">
            <div class="perfil-info">
                <div class="logo">ESTante</div>
                <form action="login.php" method="GET">

                    <div class="input-group">
                        <label>Nome de utilizador</label>
                        <input type="text" name="utilizador" placeholder="Manuel Brito">
                    </div>

                    <div class="input-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="******">
                    </div>
                    <button class="btn" type="submit">Entrar</button>
                    
                </form>

                </div>
            </div>
        </div>
</body>

</html>