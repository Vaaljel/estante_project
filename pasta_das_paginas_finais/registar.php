<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="registar_all.css">
    <title>Registar | ESTante</title>
</head>

<body>
    <?php
    include './nav.php';

    require_once '../basedados/basedados.h';
    require_once './auth.php';
    
    if(isLoggedIn()){
        header("Location: teste.php");
        exit;
    }
    
    if(isset($_GET["name"])){
        if($_GET['password'] != $_GET['confirmar_password']){
            echo "PassWords não coincidem";
            exit;
        }
        if(createUser($_GET["name"], $_GET['email'], $_GET['password'])){
            header(header: "Location: pagina_espera.php");
            exit;
        }
        else {
            echo "shii";
        }
    }
    else{
        echo "No data";
    }
    ?>
    <main class="main">
        <div class="perfil-container">
            <div class="perfil-info">
                <div class="logo">ESTante</div>
                <form action="" method="GET">
                    <div class="input-group">
                        <label>Nome de utilizador</label>
                        <input type="text" name="name" placeholder="Manuel Brito">
                    </div>
                    <div class="input-group">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="estante@ipcb.pt">
                    </div>
                    <div class="input-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="******">
                    </div>
                    <div class="input-group">
                        <label>Confirmar Password Secreta</label>
                        <input type="password" name="confirmar_password" placeholder="******">
                    </div>
                    <button class="btn" type="submit">Criar conta</button>
                </form>
            </div>
        </div>
        </div>
</body>

</html>