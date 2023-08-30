<?php
session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Coordenador.php';

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