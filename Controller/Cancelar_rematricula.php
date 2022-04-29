<?php
session_start();
include '../Model/Conexao.php';
include '../Model/Aluno.php';
try {
 	if (isset($_SESSION['idfuncionario'])) {
		$idaluno = $_GET['idaluno'];
		$matricula = $_GET['matricula'];
		$ano_letivo_vigente = $_SESSION['ano_letivo_vigente'];
	$conexao->exec("DELETE FROM ecidade_matricula where matricula_codigo=$matricula and aluno_id=$idaluno and calendario_ano='$ano_letivo_vigente' ");	
	$conexao->exec("DELETE FROM ano_letivo where aluno_id=$idaluno   ");

		echo "Ação concluída";
	}
} catch (Exception $e) {
	echo "Erro ". $e;
}

?>