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

	$link = $_POST['link'];
	$descricao = $_POST['descricao'];
	$hora = $_POST['hora'];
	$hora_fim = $_POST['hora_fim'];
	$url_get=$_POST['url_get'];

	

	if (isset($_SESSION['idprofessor'])) {
		$id_funcionario = $_SESSION['idprofessor']; 
		
	}else {
		$id_funcionario="NULL";
	}

	if (isset($_POST['idturma'])) {
		$idturma = $_POST['idturma'];
		$turma = $_POST['idturma'];
	}else{
		$idturma ="NULL";
		$turma = "NULL";
	}

	if (isset($_POST['idserie'])) {
		$idserie = $_POST['idserie'];
		
	}else{
		$idserie = "NULL";
		
	}

	$iddisciplina = $_POST['iddisciplina'];	
	$idescola = $_POST['idescola'];

	$disciplina = $_POST['iddisciplina'];

	$data_visivel = $_POST['data_visivel']." ".$hora;
	$data_visivel_fim = $_POST['data_visivel_fim']." ".$hora_fim;

	$conexao->query("
INSERT INTO video_chamada(titulo, link, escola_id, turma_id, disciplina_id, professor_id,hora_inicio, hora_fim)
 VALUES ('$descricao', '$link', $idescola, $idturma, $iddisciplina, $id_funcionario,'$data_visivel', '$data_visivel_fim')
		");

	$_SESSION['status']=1;
	header("location:../View/cadastrar_link_video_chamada.php?$url_get");
} catch (Exception $e) {
	$_SESSION['status']=0;
	$_SESSION['mensagem']='Alguma coisa deu errado';
	header("location:../View/cadastrar_link_video_chamada.php?$url_get");
	

	
	
}

?>