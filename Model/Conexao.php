<?php
try {
date_default_timezone_set('America/Sao_Paulo');
    
    $server = "35.247.201.56";
    $username = "root";
     
     $password = "BDWRe85Oam8D";
 
    $conexao = new PDO("mysql:host=$server;dbname=educalem", $username, $password);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Falha na conexão:";
}
?>