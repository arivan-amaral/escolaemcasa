<?php
session_start();
include_once '../Model/Conexao.php';

include_once '../Model/Mural.php';
include_once '../Model/Serie.php';
include_once 'Conversao.php';

try {

	
	$titulo =($_POST['titulo']);
	$titulo =escape_mimic($titulo);
	$descricao =  ($_POST['descricao']);
	$descricao =  escape_mimic($descricao);
	$setor = 'Escola';
    $url_get=$_POST['url_get'];



	if (isset($_SESSION['idprofessor'])) {
		$usuario_id = $_SESSION['idprofessor'];
		
	}else {
		$usuario_id=$_SESSION['idcoordenador'];
	}


	$idserie = $_POST['idserie'];
	$idturma = $_POST['idturma'];
	$idescola = $_POST['idescola'];

	cadastrar_mural($conexao,$titulo, $descricao, $idescola,$idturma,$idserie, $usuario_id,$setor);


	$_SESSION['status']=1;
	header("location:../View/cadastrar_mural.php?$url_get");

	} catch (Exception $e) {		
		$_SESSION['status']=0;
		header("location:../View/cadastrar_mural.php?$url_get");
	}
	

?>