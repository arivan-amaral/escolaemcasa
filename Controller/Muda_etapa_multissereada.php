<?php
session_start();
include '../Model/Conexao.php';



try {
	$etapa=$_GET['etapa'];
	$idaluno=$_GET['idaluno'];
	if ($etapa!="") {
		// code...
	$conexao->exec("UPDATE ano_letivo set etapa_id=$etapa where aluno_id=$idaluno");
	}
	

	echo "certo";
} catch (Exception $e) {
	echo $e;
}

?>