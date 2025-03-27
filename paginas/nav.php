<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">
</head> 

<header>
        <div class="logo">
            <img src="img/logo-nav.png" height='40'>
        </div> 
        <nav>
            <ul>
                <li><a class=" <?= ($pagina == 'index') ? 'active' : '' ?>" aria-current="page" href="index.php" class="active">Início</a></li>
                <li><a class=" <?= ($pagina == 'sobre') ? 'active' : '' ?>" href="sobre.php">Sobre</a></li>
                <li><a class=" <?= ($pagina == 'entrar') ? 'active' : '' ?>" href="login.php">Entrar</a></li>
                <li><a class=" <?= ($pagina == 'registar') ? 'active' : '' ?>" href="registar.php">Registar</a></li>
            </ul>
        </nav>

        
    </header>