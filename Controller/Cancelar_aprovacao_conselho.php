<?php 
session_start();
include_once '../Model/Conexao.php';
include_once '../Model/Aluno.php';
try {
	$idescola=$_GET['idescola'];
	$idturma=$_GET['idturma'];
	$iddisciplina=$_GET['iddisciplina'];
	$idaluno=$_GET['idaluno'];
 	$ano_letivo=$_SESSION['ano_letivo_vigente'];
	cancelar_aprovar_concelho($conexao,$idescola,$idturma,$iddisciplina,$idaluno, $ano_letivo);
	echo "certo";
	 

} catch (Exception $e) {
	echo "$e";
}
?>