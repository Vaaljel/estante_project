<?php
require_once '../basedados/basedados.php';
require_once '../basedados/auth.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <title>ESTante | Submeter Apontamento</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Sour+Gummy:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="submeter_post.css">
</head>

<body>
    <?php
    require_once './nav.php';

    // Verificar se o utilizador está autenticado
    if (!isLoggedIn()) {
        header("Location: login.php");
        exit();
    }

    // Inicializar variáveis
    $titulo = "";
    $descricao = "";
    $id_disciplina = "";
    $error = "";
    $success = "";

    // Processar o formulário quando enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validar e escapar dados
        $titulo = escaparString($_POST["titulo"]);
        $descricao = escaparString($_POST["descricao"]);
        $id_disciplina = intval($_POST["id_disciplina"]);

        // Verificar se todos os campos obrigatórios estão preenchidos
        if (empty($titulo) || empty($id_disciplina)) {
            $error = "Por favor, preencha todos os campos obrigatórios.";
        } else {
            // Verificar se um arquivo foi enviado
            if (isset($_FILES["arquivo"]) && $_FILES["arquivo"]["error"] == 0) {
                $arquivo = $_FILES["arquivo"];
                $nome_arquivo = $arquivo["name"];
                $tipo_arquivo = $arquivo["type"];
                $tamanho_arquivo = $arquivo["size"];
                $temp_arquivo = $arquivo["tmp_name"];

                // Verificar o tamanho do arquivo (máximo 5MB)
                if ($tamanho_arquivo > 5 * 1024 * 1024) {
                    $error = "O arquivo é muito grande. O tamanho máximo permitido é 5MB.";
                } else {
                    // Verificar o tipo de arquivo (apenas imagens e PDFs)
                    $tipos_permitidos = ["image/jpeg", "image/png", "image/gif", "application/pdf"];
                    if (!in_array($tipo_arquivo, $tipos_permitidos)) {
                        $error = "Tipo de arquivo não permitido. Apenas imagens (JPEG, PNG, GIF) e PDFs são aceitos.";
                    } else {
                        // Criar diretório de uploads se não existir
                        $diretorio_upload = "../uploads/";
                        if (!file_exists($diretorio_upload)) {
                            mkdir($diretorio_upload, 0777, true);
                        }

                        // Gerar nome único para o arquivo
                        $extensao = pathinfo($nome_arquivo, PATHINFO_EXTENSION);
                        $novo_nome = uniqid() . "." . $extensao;
                        $caminho_arquivo = $diretorio_upload . $novo_nome;

                        // Mover o arquivo para o diretório de uploads
                        if (move_uploaded_file($temp_arquivo, $caminho_arquivo)) {
                            // Inserir o apontamento no banco de dados
                            $id_utilizador = $_SESSION["user_id"];
                            $caminho_relativo = "uploads/" . $novo_nome;

                            $sql = "INSERT INTO apontamentos (id_utilizador, id_disciplina, titulo, caminho_arquivo, descricao, estado_apo) 
                                    VALUES ($id_utilizador, $id_disciplina, '$titulo', '$caminho_relativo', '$descricao', 'pendente')";

                            $resultado = executarQuery($sql);

                            if ($resultado) {
                                $success = "Apontamento submetido com sucesso! Aguarde a aprovação do moderador.";
                                // Limpar o formulário
                                $titulo = "";
                                $descricao = "";
                                $id_disciplina = "";
                            } else {
                                $error = "Erro ao submeter o apontamento. Por favor, tente novamente.";
                            }
                        } else {
                            $error = "Erro ao fazer upload do arquivo. Por favor, tente novamente.";
                        }
                    }
                }
            } else {
                $error = "Por favor, selecione um arquivo para upload.";
            }
        }
    }
    ?>

    <div class="main">
        <div class="submit-container">
            <h2>Submeter Apontamento</h2>

            <?php if (!empty($error)): ?>
                <div class="error-message"><?php echo $error; ?></div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="success-message"><?php echo $success; ?></div>
            <?php endif; ?>

            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="titulo">Título *</label>
                    <input type="text" id="titulo" name="titulo" value="<?php echo $titulo; ?>" required>
                </div>

                <div class="form-group">
                    <label for="id_disciplina">Disciplina *</label>
                    <select id="id_disciplina" name="id_disciplina" required>
                        <option value="">Selecione uma disciplina</option>
                        <?php
                        // Buscar disciplinas do banco de dados
                        $sql_disciplinas = "SELECT id_disciplina, nome FROM disciplina ORDER BY nome";
                        $result_disciplinas = executarQuery($sql_disciplinas);

                        if ($result_disciplinas && $result_disciplinas->num_rows > 0) {
                            while ($row = $result_disciplinas->fetch_assoc()) {
                                $selected = ($id_disciplina == $row["id_disciplina"]) ? "selected" : "";
                                echo "<option value='" . $row["id_disciplina"] . "' $selected>" . $row["nome"] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <textarea id="descricao" name="descricao"><?php echo $descricao; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="arquivo">Arquivo *</label>
                    <div class="file-upload">
                        <input type="file" id="arquivo" name="arquivo" required>
                        <div class="file-upload-btn">Selecionar arquivo</div>
                    </div>
                    <div class="file-name" id="file-name"></div>
                </div>

                <button type="submit" class="submit-btn">Submeter Apontamento</button>
            </form>
        </div>

        <!-- Imagens decorativas -->
        <div class="imagem-canto-superior">
            <img src="../img/estrelas.png" alt="Decoração" class="imagem-superior">
        </div>
        <div class="imagem-lateral">
            <img src="../img/estrelas.png" alt="Decoração">
        </div>
    </div>

    <script>
        // Exibir o nome do arquivo selecionado
        document.getElementById('arquivo').addEventListener('change', function() {
            const fileName = this.files[0] ? this.files[0].name : 'Nenhum arquivo selecionado';
            document.getElementById('file-name').textContent = fileName;
        });
    </script>
</body>

</html>