<?php
session_start();
include '../Model/Conexao.php';
include '../Model/Trabalho.php';

$id = $_GET['id'];
try {
	
	$res=excluir_trabalho($conexao,$id);
	$_SESSION['status']=1;
	header("Location:../View/professor.php");

} catch (Exception $e) {
	$_SESSION['status']=0;
	header("Location:../View/professor.php");
}

?>