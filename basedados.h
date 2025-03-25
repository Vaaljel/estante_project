<?php

$database = 'estantedb'
$host = 'localhost';
$dbuser = 'root';
$dbpass = '';



function connect()
{
    $conn = mysqli_connect($database, $dbhost, $dbuser, $dbpass);
    
    if(!conn)
    {
        die("Erro na conexão com a base de dados: " . mysqli_connect_error());
    }
}
?>