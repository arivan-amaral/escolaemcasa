<?php
session_start();
include '../Model/Conexao.php';

include '../Model/Mural.php';
include '../Model/Serie.php';

try {

	
	$titulo = $_POST['titulo'];
	$descricao = $_POST['descricao'];
	$setor = 'Secretaria';


	if (isset($_SESSION['idprofessor'])) {
		$usuario_id = $_SESSION['idprofessor'];
		
	}else {
		$usuario_id=$_SESSION['idcoordenador'];
	}


	$idserie = $_POST['idserie'];

	if ($idserie=='todas') {
		$res_escola= escola_associada($conexao,$idcoordenador);
		foreach ($res_escola as $key => $value) {
		    // $id=$value['idescola'];
		    // $nome_escola=($value['nome_escola']);
		// $res=lista_todas_series($conexao);
		// foreach ($res as $key => $value) {
			$serie_id=$value['id'];
			cadastrar_mural_geral($conexao,$titulo, $descricao, $serie_id, $usuario_id,$setor);
		}
	}else{
			cadastrar_mural_geral($conexao,$titulo, $descricao, $idserie, $usuario_id,$setor);
		
	}


	$_SESSION['status']=1;
	header("location:../View/cadastro_mural_geral.php?status=1");

	} catch (Exception $e) {
		
		$_SESSION['status']=0;
		header("location:../View/cadastro_mural_geral.php?status=1");
	}
	

?>