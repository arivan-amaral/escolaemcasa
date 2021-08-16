<?php
session_start();
include '../Model/Conexao.php';

include '../Model/Mural.php';
include '../Model/Serie.php';

try {

	
	$titulo = $_POST['titulo'];
	$descricao = $_POST['descricao'];
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