<?php
session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";



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