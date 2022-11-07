<?php
session_start();
include_once '../Model/Conexao.php';
include '../Model/Coordenador.php';

$id = $_GET['id'];
try {
	
	excluir_coordenador($conexao,$id);
	$_SESSION['status']=1;
	header("Location:../View/pesquisar_coordenador_associar.php");

} catch (Exception $e) {
	$_SESSION['status']=0;
	// echo $e;
	header("Location:../View/pesquisar_coordenador_associar.php");
}

?>