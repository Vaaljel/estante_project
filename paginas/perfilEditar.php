<?php
require_once '../basedados/basedados.php';
require_once '../basedados/auth.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$user = getUser();
$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novo_nome = trim($_POST['nome']);
    $novo_email = trim($_POST['email']);
    $nova_pass = trim($_POST['secretpass']);

    // Validação simples
    if ($novo_nome && $novo_email && $nova_pass) {
        $id = $user['id_utilizador'];
        $stmt = $conn->prepare("UPDATE utilizadores SET nome = ?, endereco = ?, secretpass = ? WHERE id_utilizador = ?");
        $stmt->bind_param("sssi", $novo_nome, $novo_email, $nova_pass, $id);

        if ($stmt->execute()) {
            $success = "Dados atualizados com sucesso!";
            $_SESSION['user']['nome'] = $novo_nome;
            $_SESSION['user']['endereco'] = $novo_email;
            $_SESSION['user']['secretpass'] = $nova_pass;
            $user['nome'] = $novo_nome;
            $user['endereco'] = $novo_email;
            $user['secretpass'] = $nova_pass;
        } else {
            $error = "Erro ao atualizar dados.";
        }
        $stmt->close();
    } else {
        $error = "Preencha todos os campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <title>ESTante | Perfil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Sour+Gummy:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="perfil.css">
</head>

<?php
require_once "./nav.php";
?>

<body>
    <div class="background">
        <img src="..\img\estrelas.png" class="icon star-left" alt="estrela">
        <img src="..\img\gatoArpovadorDois.png" class="icon cat" alt="gato">
        <img src="..\img\estrelas.png" class="icon star-right" alt="estrela">

        <div class="card">
            <div class="header">
                <h2><?= htmlspecialchars($user['nome']) ?></h2>
                <p>Número de aluno: <span><?= htmlspecialchars($user['id_utilizador']) ?></span> | Curso: Engenharia Informática</p>
                <p>Email: <?= htmlspecialchars($user['endereco']) ?></p>
            </div>

            <?php if ($success): ?>
                <div class="success"><?= htmlspecialchars($success) ?></div>
            <?php elseif ($error): ?>
                <div class="error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="post" action="">
                <div>
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($user['nome']) ?>">
                </div><br>
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['endereco']) ?>">
                </div><br>
                <div>
                    <label for="secretpass">Password:</label>
                    <input type="password" id="secretpass" name="secretpass" value="<?= htmlspecialchars($user['secretpass']) ?>"required>
                </div><br>
                <button type="submit">Guardar Dados</button>
            </form>
        </div>
    </div>
</body>

</html>