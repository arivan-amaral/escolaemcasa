<?php
session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Video.php';

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