<?php
session_start();
include '../Model/Conexao.php';
include '../Model/Professor.php';

$id = $_GET['id'];
try {
	desativar_professor($conexao,$id);
	$ano_letivo_vigente= $_SESSION['ano_letivo_vigente'];
	$conexao->query("DELETE FROM ministrada where professor_id=$id and ano='$ano_letivo_vigente' ");
	


	$_SESSION['status']=1;
	header("Location:../View/pesquisar_professor_associar.php");
} catch (Exception $e) {
	$_SESSION['status']=0;
	header("Location:../View/pesquisar_professor_associar.php");
}

?>