<?php
session_start();
include_once '../Model/Conexao.php';
include '../Model/Aluno.php';
try {
 	if (isset($_SESSION['idfuncionario'])) {
		$idaluno = $_GET['idaluno'];
		
		
	$conexao->exec("UPDATE ecidade_matricula SET matricula_situacao='MATRICULADO',matricula_ativa='S',matricula_concluida='N' WHERE aluno_id = $idaluno LIMIT 1");	
	$conexao->exec("DELETE FROM solicitacao_transferencia where aluno_id=$idaluno ");

		echo "Ação concluída";
	}
} catch (Exception $e) {
	echo "Erro ". $e;
}

?>