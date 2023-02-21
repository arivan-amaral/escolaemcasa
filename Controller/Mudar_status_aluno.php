<?php session_start();
include_once '../Model/Conexao.php';
include_once '../Model/Aluno.php';

$id=$_GET['id'];
$status=$_GET['status'];
	try {
		if ($status==1) {
			$status="Ativo";
		}else{
			$status="Desativado";
		}
		
		mudar_status_aluno($conexao, $status, $id);
		echo "sucesso";
	} catch (Exception $e) {
		echo "erro";
	}

?>