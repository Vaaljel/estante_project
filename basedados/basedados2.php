<?php

//Definição das credenciais de conexão

define('server', 'localhost'); // meu computador
define('user', 'root'); // user
define('password', ''); //password
define('database','estantedb'); //banco de dados

//Estabelecer conexão com o banco de dados
$conexao = new mysqli( server,user,password,database);


//Verificação se ouver um erro na conexão
if($conexao->connect_error){
    die("Erro na conexão: " . $conexao->connect_error);
}

// fechar conexão
function fecharConexaoBD(){
    global $conexao;
    $conexao->close();
}

//Executar SQL Query
function executarQuery($sql){
    global $conexao;
    $resultado = $conexao->query($sql);

    if(!$resultado){
        echo "Erro na execução da query: " . $conexao->error;
        return false;
    }
    return $resultado;
}


// Prevenir SQL Injection
function escaparString($valor){
    global $conexao;
    return $conexao->real_escape_string($valor);
}

?>