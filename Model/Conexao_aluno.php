<?php
try {
date_default_timezone_set('America/Sao_Paulo');
    
    $server = "localhost";
    
    $username = "educ_lem"; //usuario do banco 
    $dbname = "educ_lem_producao";//nome da base de dados
     $password = "Ari200120022003_";
    
    $conexao = new PDO("mysql:host=$server;dbname=$dbname;charset=utf8", $username, $password);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Falha na conexão:";
}
?>