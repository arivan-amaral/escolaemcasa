<?php 
include_once '../Model/Conexao.php';
include_once '../Model/Aluno.php';
try {
	$idescola=$_GET['idescola'];
	$idturma=$_GET['idturma'];
	$iddisciplina=$_GET['iddisciplina'];
	$idaluno=$_GET['idaluno'];
	
	$res=buscar_aprovar_concelho($conexao,$idescola,$idturma,$iddisciplina,$idaluno);
	$conta=0;
	foreach ($res as $key => $value) {
		$conta++;
	}
	if ($conta==0) {
		aprovar_concelho($conexao,$idescola,$idturma,$iddisciplina,$idaluno);
		echo "certo";
		// code...
	}else{
		echo "registro já existente";
	}

} catch (Exception $e) {
	echo "$e";
}
?>