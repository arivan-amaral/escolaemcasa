<?php
session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Turma.php';

$id = $_GET['id'];
try {
	
	$res=excluir_turma_escola($conexao,$id);
		

} catch (Exception $e) {
	$_SESSION['status']=0;
	//header("Location:../View/professor.php");
}

?>