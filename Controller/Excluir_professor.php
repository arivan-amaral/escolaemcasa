<?php
session_start();
include '../Model/Conexao.php';
include '../Model/Professor.php';

$id = $_GET['id'];
try {
	
	desativar_professor($conexao,$id);
	$conexao->query("DELETE FROM ministrada where professor_id=$id ");


	$_SESSION['status']=1;
	header("Location:../View/pesquisar_professor_associar.php");
} catch (Exception $e) {
	$_SESSION['status']=0;
	header("Location:../View/pesquisar_professor_associar.php");
}

?>