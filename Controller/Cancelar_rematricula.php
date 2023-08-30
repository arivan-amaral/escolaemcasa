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
		$ano_letivo_vigente = $_SESSION['ano_letivo_vigente'];
	$conexao->exec("DELETE FROM ecidade_matricula where matricula_codigo=$matricula and aluno_id=$idaluno and calendario_ano='$ano_letivo_vigente' ");	
	$conexao->exec("DELETE FROM ano_letivo where aluno_id=$idaluno   ");

		echo "Ação concluída";
	}
} catch (Exception $e) {
	echo "Erro ". $e;
}

?>