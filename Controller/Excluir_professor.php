<?php
session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Professor.php';

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