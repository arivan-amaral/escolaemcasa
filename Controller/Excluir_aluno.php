<?php
session_start();
include '../Model/Conexao.php';
include '../Model/Aluno.php';
try {
 	if (isset($_SESSION['idfuncionario'])) {
		$idaluno = $_GET['idaluno'];
	$conexao->exec("DELETE FROM ano_letivo where aluno_id=$idaluno   ");
		$conexao->exec("DELETE FROM aluno where idaluno=$idaluno ");

		echo "Ação concluída";
	}else{
		echo "erro";
	}

} catch (Exception $e) {
	echo "Erro ". $e;
}

?>