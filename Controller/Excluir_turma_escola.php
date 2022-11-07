<?php
session_start();
include_once '../Model/Conexao.php';
include '../Model/Turma.php';

$id = $_GET['id'];
try {
	
	$res=excluir_turma_escola($conexao,$id);
		

} catch (Exception $e) {
	$_SESSION['status']=0;
	//header("Location:../View/professor.php");
}

?>