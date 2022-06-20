<?php session_start();
include'../Model/Conexao.php';
include'../Model/Aluno.php';

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