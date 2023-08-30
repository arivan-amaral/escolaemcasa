<?php
session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Video.php';
include_once '../Model/Coordenador.php';

try {

	$link = trim($_POST['link']);
	$titulo = $_POST['titulo'];
	$descricao = $_POST['descricao'];
	$hora = $_POST['hora'];
	if (isset($_SESSION['idprofessor'])) {
		$id_funcionario = $_SESSION['idprofessor'];
		
	}else {
		$id_funcionario=$_SESSION['idcoordenador'];
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
	$disciplina = $_POST['iddisciplina'];
	

	$data_visivel = $_POST['data_visivel']." ".$hora;
	$id_video=0;

	$termos = array('https://youtu.be/', 'http://youtu.be/', 'https://youtube.com/', 'http://youtube.com/','https://www.youtube.com/watch?v=','http://www.youtube.com/watch?v=');
	$link =trim(str_replace($termos, '', $link));
	
	$idescola = "";
	$setor = "Secretaria";

	// $res=listar_escola_por_serie_ministrada($conexao,$iddisciplina,$idserie);
	// foreach ($res as $key => $value) {
	// 	$idturma=$value['turma_id'];
		// $idescola=$value['idescola'];
		cadastrar_video_gt($conexao,$link, $titulo, $descricao, $id_funcionario,$iddisciplina,$data_visivel,$hora,$idserie,$setor);
	// }


	
	$_SESSION['status']=1;
	
	if($idserie=="NULL"){
		header("location:../View/cadastro_video.php?status=1&disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina&idescola=$idescola");
	}else{
		header("location:../View/cadastro_video_gt.php?status=1&disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina&idescola=$idescola");

	}
} catch (Exception $e) {
	$_SESSION['mensagem']='Erro';
	
	$_SESSION['status']=0;
	 if($idserie=="NULL"){
		header("location:../View/cadastro_video.php?status=1&disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina&idescola=$idescola");
	}else{
		header("location:../View/cadastro_video_gt.php?status=1&disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina&idescola=$idescola");

	}
	
}

?>