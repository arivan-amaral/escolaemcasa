<?php session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Aluno.php';

	try {
		$matricula=$_GET['matricula'];
		$status=$_GET['status'];
		$data=$_GET['data'];
		if ($status == 'MATRICULADO') {
			restaurar_situacao_aluno($conexao, $matricula);
		}else{
			mudar_situacao_aluno($conexao, $matricula, $status, $data);

		}
		
	} catch (Exception $e) {
		echo $e;
	}

?>