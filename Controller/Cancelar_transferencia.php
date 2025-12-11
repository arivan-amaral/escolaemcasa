<?php
session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Aluno.php';
try {
 	if (isset($_SESSION['idfuncionario'])) {
		$idaluno = $_GET['idaluno'];
		$matricula = $_GET['matricula'];
		
		
	$conexao->exec("UPDATE ecidade_matricula SET data_saida='', matricula_situacao='MATRICULADO',matricula_ativa='S',matricula_concluida='N' WHERE matricula_codigo = $matricula and aluno_id = $idaluno LIMIT 1");	
	$conexao->exec("DELETE FROM solicitacao_transferencia where aluno_id=$idaluno  and aceita=0 order by id desc LIMIT 1");

		echo "Ação concluída";
	}
} catch (Exception $e) {
	echo "Erro ". $e;
}

?>