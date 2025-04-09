<?php
require_once 'basedados.php';


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//melhorar isto
function isLoggedIn(): bool
{
    //checkRole();
    return isset($_SESSION["user_id"]);
}


//Ideia mas talvez usar um define para isto não seria má ideia
function checkRole()
{

    $saveCurrentRole = null;

    if (($_SESSION["cargo"]) == "cliente") {
        ($_SESSION($saveCurrentRole == "cliente"));
    }
    if (($_SESSION["cargo"]) == "moderador") {
        ($_SESSION($saveCurrentRole == "moderador"));
    }
    if (($_SESSION["cargo"]) == "administrador") {
        ($_SESSION($saveCurrentRole == "administrador"));
    } else {
        ($_SESSION($saveCurrentRole == "Null"));
    }
}

function login($nome, $endereco, $pass)
{
    //Escapa o nome de utilizador para evitar SQL injection
    $nome = escaparString($nome);
    $endereco = escaparString($endereco);
    $pass = escaparString($pass);
    $estado = "registado";

    // Busca o utilizador no banco de dados
    $sql = "SELECT* FROM utilizadores WHERE endereco = '$endereco' 
    AND nome = '$nome' 
    AND estado = '$estado'";
    $resultado = executarQuery($sql);

    //Adicionado para debug!!
    //print_r ($resultado); 


    //Verificar se o utilizador foi encontrado
    if ($resultado && $resultado->num_rows == 1) {
        $utilizador = $resultado->fetch_assoc();

        // if(isset($utilizador['secretpass']) && password_verify($pass, $utilizador['secretpass'])){

        // Verifica se a senha está correta
        if (isset($utilizador['secretpass']) && $pass == $utilizador['secretpass']) {
            // Suceso
            $_SESSION['user_id'] = $utilizador['id_utilizador'];
            $_SESSION['cargo'] = $utilizador['cargo'];
            //print_r($utilizador);
            return true;
        }
        if ($estado != "registado") {
            echo '<div class="input-group">
                <label>Endereço Invalido</label>
            </div>';
        }
    }

    // Login falhou
    return false;
}

function logout()
{
    session_unset();
    session_destroy();
    header("location:index.php");
}

//  Cria utilizador (default cliente)


function validaCliente(){
    if($_SESSION['cargo'] != 'cliente'){
        header("Location: erro.php");
    }
}

function validaMod(){
    if($_SESSION['cargo'] != 'moderador'){
        header("Location: erro.php");
    }
}

//Função para verificar as permições(?) & e dar o nível de acesso dependedo do cargo ao site
function validaAdmin()
{
    if ($_SESSION['cargo'] != 'administrador') {
        header("Location: erro.php");
    }
}


function createUser($nome, $endereco, $secretpass)
{
    global $conn;
    //Escapa as string para evitar SQL injection
    $nome = escaparString($nome);
    $endereco = escaparString($endereco);
    $secretpass = escaparString($secretpass);
    //$cargo = escaparString($cargo);
    //$estado = escaparString($estado);

    //XCriptografar a senha antes de armazenar no banco de dados
    //$hash_password = password_hash($secretpass, PASSWORD_DEFAULT);

    //$verificacao_sql = "SELECT * FROM utilizadores WHERE nome = ? AND endereco = ?";

    $sql = "SELECT * FROM utilizadores WHERE nome = ? OR endereco = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nome, $endereco);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("Location: registar.php");
        exit;
    } else {

        // Criar a query SQL para inserir o novo utilizador
        $sql = "INSERT INTO UTILIZADORES (nome, endereco, secretpass )
                VALUES ('$nome', '$endereco', '$secretpass' )";

        //Executa a Query
        $resultado  = executarQuery($sql);
    }

    //Adicionado para debug!!
    //print_r ($resultado); 


    //Verifica se conseguiu fazer o insert
    if ($resultado) {
        return true; //Sucesso
    } else {
        return false; // Caso Erro
    }
}

function getUser()
{
    $result = executarQuery("SELECT * from UTILIZADORES WHERE id_utilizador = " . $_SESSION['user_id']);
    return $result->fetch_assoc();
}
