<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="registar_all.css">
    <title>Registar | ESTante</title>
</head>

<body>
    <?php
    include './nav.php'
    ?>
    <main class="main">
        <div class="perfil-container">
            <div class="perfil-info">
                <div class="logo">ESTante</div>
                <form action="esperaConfirmacao.html" method="GET">
                    <div class="input-group">
                        <label>Nome de utilizador</label>
                        <input type="text" name="utilizador" placeholder="Manuel Brito">
                    </div>
                    <div class="input-group">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="estante@ipcb.pt">
                    </div>
                    <button class="btn" type="submit">Criar conta</button>
                </form>
            </div>
        </div>
        </div>
</body>

</html>