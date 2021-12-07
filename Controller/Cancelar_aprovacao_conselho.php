<?php 
include_once '../Model/Conexao.php';
include_once '../Model/Aluno.php';
try {
	$idescola=$_GET['idescola'];
	$idturma=$_GET['idturma'];
	$iddisciplina=$_GET['iddisciplina'];
	$idaluno=$_GET['idaluno'];
 
	cancelar_aprovar_concelho($conexao,$idescola,$idturma,$iddisciplina,$idaluno);
	echo "certo";
	 

} catch (Exception $e) {
	echo "$e";
}
?>