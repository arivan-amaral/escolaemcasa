<?php
try {
date_default_timezone_set('America/Sao_Paulo');
    
    $server = "34.95.136.164";
    
    $username = "coordenador";
    $dbname = "educ_lem_producao";
     $password = "253015Lo@";
    
    $conexao = new PDO("mysql:host=$server;dbname=$dbname;charset=utf8", $username, $password);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Falha na conexão:";
}
?>