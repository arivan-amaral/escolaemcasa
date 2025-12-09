<?php 

try {
    $server = "localhost";
  
    $username = "educ_lem"; //usuario do banco 
    $dbname = "matricula-anos-finais";//nome da base de dados
     $password = "Ari200120022003_";
    
    $conn_migra = new PDO("mysql:host=$server;dbname=$dbname;charset=utf8", $username, $password);
    $conn_migra->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch (PDOException $e) {
    echo "Falha na conexão matricula-anos-finais:";
}



?>