<?php
include_once '../Model/Conexao.php';
include '../Model/Questionario.php';
    $id=$_GET['id'];
    $data=$_GET['data'];
    $data_final=$_GET['data_fim'];

    $data=str_replace('T', ' ',$data);
    $data_final=str_replace('T', ' ',$data_final);
  
    
try {
	$resultado=alterar_data_simulado($conexao,$id,$data,$data_final);
	
	echo "certo";

} catch (Exception $e) {
	echo "erro";
	
}

?>