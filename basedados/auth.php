<?php
    require_once 'basedados.php';
    
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    function isLoggedIn(): bool{
        return isset($_SESSION["id_utilizador"]);
    }

    function login($nome, $pass){
        //Escapa o nome de utilizador para evitar SQL injection
        $nome = escaparString($nome);

        // Busca o utilizador no banco de dados
        $sql = "SELECT* FROM utilizadores WHERE nome = '$nome'";
        $resultado = executarQuery($sql);
        
        //Adicionado para debug!!
        //print_r ($resultado); 


        //Verificar se o utilizador foi encontrado
        if($resultado && $resultado->num_rows == 1){
            $utilizador = $resultado->fetch_assoc();

           // if(isset($utilizador['secretpass']) && password_verify($pass, $utilizador['secretpass'])){

            // Verifica se a senha está correta
            if(isset($utilizador['secretpass']) && $pass == $utilizador['secretpass']){
                // Suceso
                $_SESSION['user_id'] = $utilizador['ID'];
                $_SESSION['cargo'] = $utilizador['cargo'];

                return true;
            }

        }

        // Login falhou
        return false;
    }

    //  Cria utilizador (default cliente)


//Função para verificar as permições(?) & e dar o nível de acesso dependedo do cargo ao site
function validaAdmin(){
    if($_SESSION['cargo'] != 'administrador'){
        header(header:"Location: erro.php");
    }
}

function createUser($nome, $endereco, $secretpass){
    //Escapa as string para evitar SQL injection
    $nome = escaparString($nome);
    $endereco = escaparString($endereco);
    $secretpass = escaparString($secretpass);
    //$cargo = escaparString($cargo);
    //$estado = escaparString($estado);
    
    //XCriptografar a senha antes de armazenar no banco de dados
    //$hash_password = password_hash($secretpass, PASSWORD_DEFAULT);


    //Adicionar HASHING

    // Criar a quaery SQL para inserir o novo utilizador
    $sql = "INSERT INTO UTILIZADORES (nome, endereco, secretpass )
            VALUES ('$nome', '$endereco', '$secretpass' )";

    //Executa a Query
    $resultado  = executarQuery($sql);

    //Adicionado para debug!!
    //print_r ($resultado); 


    //Verifica se conseguiu fazer o insert
    if($resultado){
        return true; //Sucesso
    } else {
        return false; // Caso Erro
    }
}

function getUser(){
    $result = executarQuery("SELECT * UTILIZADORES WHERE ID = " . $_SESSION['user_id']);
    return $result->fetch_assoc();
}
?>
