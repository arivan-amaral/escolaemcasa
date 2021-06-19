<?php
include '../Model/Conexao.php';
include '../Model/Questionario.php';
    $id=$_GET['id'];
    $data=$_GET['data'];
    
try {
	$resultado=alterar_data_questionario($conexao,$id,$data);
} catch (Exception $e) {
	
}

?>