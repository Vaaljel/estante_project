<html>

<head>
    <title>ESTante | registar.php</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Sour+Gummy:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="registar_all.css">
</head>

<body>
    <?php
    require_once './nav.php';

    require_once '../basedados/basedados.php';
    require_once '../basedados/auth.php';

    if (isLoggedIn()) {
        header("Location: teste.php");
        exit;
    }
    //Verifica se recebeu todos os dados do formulário se não envia a mensagem não preecheu
    if (
        isset($_POST["name"]) && isset($_POST["email"])
        && isset($_POST["password"]) && isset($_POST["confirmar_password"])
    ) {
        //Verifica se o email contem o endereço certo para se registar
        if (!preg_match("/@ipcb\.pt$/", $_POST["email"])) {
            echo "Apenas emails @ipcb.pt são permitidos!";
            header(header: "Location: registar.php");
            exit;
        }
        //Verifica se as passwords coincidem caso não, não avança para o próximo passo
        if ($_POST['password'] != $_POST['confirmar_password']) {
            echo "PassWords não coincidem";
            header(header: "Location: registar.php");
            exit;
        }
        //Chama a função responsavel pelo insert
        if (createUser($_POST["name"], $_POST['email'], $_POST['password'])) {
            header(header: "Location: pagina_espera.php");
            exit;
        } else {
            echo "Não conseguiu inserir dados";
        }
    } else {
        echo "Não preecheu os dados";
    }
    ?>
    <main class="main">
        <div class="perfil-container">
            <div class="perfil-info">
                <div class="logo">ESTante</div>
                <form method="POST">
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
                    <button class="btn" type="submit">Entrar</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>