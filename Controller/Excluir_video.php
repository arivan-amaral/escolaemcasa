<?php
session_start();
include '../Model/Conexao.php';
include '../Model/Video.php';

try {

	$id = $_GET['id'];
	

	excluir_video($conexao, $id);


	$_SESSION['status']=1;
	header("location:../View/professor.php?status=1");
} catch (Exception $e) {
	$_SESSION['status']=0;
	 header("location:../View/cadastro_video.php?status=0&disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina");
	
}

?>