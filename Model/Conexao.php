<?php
try {
date_default_timezone_set('America/Sao_Paulo');
    
    $server = "localhost";
    $username = "root";
     
     $password = "DLsaJ#pBpK4K@K4x";
   
    $conexao = new PDO("mysql:host=$server;dbname=educ_alem;charset=utf8", $username, $password);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Falha na conexão:";
}
?>