<?php
date_default_timezone_set('America/Bahia');

$servername = "localhost";
$username = "login_educalem";
$password = "]-AlkptD7Pwq[Y9i";
// $password = "RJv4K0gx30ki"; novo servidor 35.198.19.151
// $password = "UQ2K2V3cfV6F";
try {
	//instancia objeto PDO, conectando no MySQL
    $conexao_select= new PDO("mysql:host=$servername;dbname=educalem", $username, $password);
    // apresenta o erro PDO 
    $conexao_select->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Conexao realizada com sucesso!"; 
}catch(PDOException $e){
    //echo "Conexao falhou: " . $e->getMessage();
}
?>