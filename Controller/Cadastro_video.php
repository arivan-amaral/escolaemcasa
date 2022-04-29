<?php
session_start();
include '../Model/Conexao.php';
include '../Model/Video.php';

try {

	$link = trim($_POST['link']);
	$titulo = $_POST['titulo'];
	$descricao = $_POST['descricao'];
	$hora = $_POST['hora'];
	$origem='';
	$url_get='';

	if (isset($_POST['origem'])) {
		$origem = $_POST['origem'];
		$url_get=$_POST['url_get'];

	}	


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
	$idserie = $_POST['idserie'];
	$disciplina = $_POST['iddisciplina'];
	

	$data_visivel = $_POST['data_visivel']." ".$hora;
	$id_video=0;

	$termos = array('https://youtu.be/', 'http://youtu.be/', 'https://youtube.com/', 'http://youtube.com/','https://www.youtube.com/watch?v=','http://www.youtube.com/watch?v=');


	$link = trim(str_replace($termos, '', $link));

	foreach ($_POST['idturma'] as $key => $value) {
		$idturma=$_POST['idturma'][$key];
		cadastrar_video($conexao,$link, $titulo, $descricao, $id_funcionario,$idturma,$iddisciplina,$data_visivel,$hora,$idescola,$idserie);
	}


	$_SESSION['status']=1;
	header("location:../View/cadastro_video.php?$url_get");

} catch (Exception $e) {
	
	$_SESSION['status']=0;
	$_SESSION['mensagem']='erro';
	header("location:../View/cadastro_video.php?$url_get");
	
	
}

?>