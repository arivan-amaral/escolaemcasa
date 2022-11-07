<?php
session_start();
include_once '../Model/Conexao.php';
include '../Model/Questionario.php';
$id = $_GET['id'];
try {
	
	$res=excluir_questionario_simulado($conexao, $id);
	// excluir_questao_por_id_questionario($conexao, $id);
	//$_SESSION['status']=1;
   // header("Location:../View/cadastrar_questionario.php");


} catch (Exception $e) {
	echo "erro";
	//$_SESSION['status']=0;
    //header("Location:../View/cadastrar_questionario.php");
}

?>