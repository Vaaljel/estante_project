<html>

<head>
    <title>ESTante | registar.php</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Sour+Gummy:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="registar_all.css">
</head>
<?php
require_once './nav.php';
?>

<body>
    <main class="main">
        <div class="perfil-container">
            <div class="perfil-info">
                <div class="estanteLogo">ESTante</div>
                <form method="POST">
                    <?php

                    require_once '../basedados/basedados.php';
                    require_once '../basedados/auth.php';

                    //Test
                    if (isLoggedIn()) {
                        header("Location: teste.php");
                        exit;
                    }

                    //Verifica se recebeu todos os dados do formulário se não envia a mensagem não preecheu
                    if (
                        isset($_POST["name"]) && isset($_POST["email"]) &&
                        isset($_POST["password"]) && isset($_POST["confirmar_password"])
                    ) {

                        //Verifica se o email contem o endereço certo para se registar
                        if (
                            !preg_match("/@ipcb\.pt$/", $_POST["email"]) &&
                            !preg_match("/@ipcbcampus\.pt$/", $_POST["email"])
                        ) {
                            //Erro (Neste caso só endereços @ipcb.pt ou @ipcbcampus.pt)
                            header("Location: registar.php");
                            echo '<div class="input-group">
                                <label>Endereço Invalido</label>
                            </div>';
                            exit;
                        }

                        //Verifica se as passwords coincidem caso não, não avança para o próximo passo
                        if ($_POST['password'] != $_POST['confirmar_password']) {
                            //passwords não coincidem
                            header("Location: registar.php?error=password_mismatch");
                            echo '<div class="input-group">
                                    <label>Falha ao entrar</label>
                                </div>';
                            exit;
                        } else if (empty($_POST['password']) || empty($_POST['confirmar_password'])) {
                            header("Location: registar.php?error=empty_password");
                            echo '<div class="input-group">
                                <label>Passwords não coincidem</label>
                            </div>';
                            exit;
                        }

                        //Chama a função responsavel pelo insert
                        if (createUser($_POST["name"], $_POST['email'], $_POST['password'])) {
                            header("Location: pagina_espera.php");
                            exit;
                        } else {
                            header("location: registar.php?error=problema=a=criar=conta");
                            echo '<div class="input-group">
                                <label>Endereço Erro Problema</label>
                            </div>';
                            exit;
                        }
                    } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        header("Location: registar.php?error=não=preencheu=todos=os=dados");
                    }
                    ?>
                    <div class="input-group">
                        <label>Nome de utilizador</label>
                        <input type="text" name="name" placeholder="nome">
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
                        <label>Confirmar Password</label>
                        <input type="password" name="confirmar_password" placeholder="******">
                    </div>
                    <button class="btn" type="submit">Registar</button>
                </form>
            </div>
        </div>
    </main>
</body>

</html>