<?php
date_default_timezone_set('America/Bahia');

$servername = "34.151.231.17";
$username = "root";
$password = "Oaeh6h7H7m6EaB7F";


// $password = "BDWRe85Oam8D";
// $mysql  = "Oaeh6h7H7m6EaB7F";

try {
	//instancia objeto PDO, conectando no MySQL
    $conexao = new PDO("mysql:host=$servername;dbname=educalemteste", $username, $password);
    // apresenta o erro PDO 
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Conexao realizada com sucesso!"; 
}catch(PDOException $e){
    echo "dd Conexao falhou: ".$e;
}


$res= $conexao->query("SELECT * from ecidade_matricula limit 100 ");
foreach ($res as $key => $value) {
	echo $value['aluno_id']." <br> ";
}
?>