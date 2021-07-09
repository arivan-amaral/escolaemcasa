<?php
date_default_timezone_set('America/Bahia');

$servername = "localhost";
$username = "root";
//$password = "200120022003";
 $password = "UQ2K2V3cfV6F";
try {
	//instancia objeto PDO, conectando no MySQL
    $conexao = new PDO("mysql:host=$servername;dbname=educalem", $username, $password);
    // apresenta o erro PDO 
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Conexao realizada com sucesso!"; 
}catch(PDOException $e){
    echo "Conexao falhou: " . $e->getMessage();
}
?>