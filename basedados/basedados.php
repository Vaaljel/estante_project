<?php

//Definição das credenciais de conexão

define('server', 'localhost'); // meu computador
define('user', 'root'); // user
define('password', ''); //CASO ERRO mudar palavra pass

//MAMP = "ROOT"
//XAMP = ""

define('database','estante'); //banco de dados

//Estabelecer conexão com o banco de dados
$conn = new mysqli( server,user,password,database);


//Verificação se ouver um erro na conexão
if($conn->connect_error){
    die("Erro na conexão: " . $conn->connect_error);
}

// fechar conexão
function fecharConexaoBD(){
    global $conn;
    $conn->close();
}

//Executar SQL Query
function executarQuery($sql){
    global $conn;
    $resultado = $conn->query($sql);


    if(!$resultado){
        echo "Erro na execução da query: " . $conn->error;
        return false;
    }
    return $resultado;
}


// Prevenir SQL Injection
function escaparString($valor){
    global $conn;
    return $conn->real_escape_string($valor);
}

?>