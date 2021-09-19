<?php
date_default_timezone_set('America/Bahia');

$servername = "localhost";
$username = "root";
$password = "RJv4K0gx30ki";
// $password = "RJv4K0gx30ki"; novo servidor 35.198.19.151
// $password = "UQ2K2V3cfV6F";
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