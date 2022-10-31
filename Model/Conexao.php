<?php
try {
date_default_timezone_set('America/Sao_Paulo');
    
    $server = "177.153.50.141";
    $username = "root";
     
     $password = "Ari200120022003_";
   
    $conexao = new PDO("mysql:host=$server;dbname=educalem;charset=utf8", $username, $password);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Falha na conexão:";
}
?>