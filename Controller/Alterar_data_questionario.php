<?php
include '../Model/Conexao.php';
include '../Model/Questionario.php';
    $id=$_GET['id'];
    $data=$_GET['data'];
    $data_final=$_GET['data_fim'];
    
try {
	$resultado=alterar_data_questionario($conexao,$id,$data,$data_final);
	
	echo "certo";

} catch (Exception $e) {
	echo "erro";
	
}

?>