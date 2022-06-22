<?php
session_start();
include '../Model/Conexao.php';
include '../Model/Chamada.php';

try {

	$mensagem = $_GET['mensagem'];
	$enviado = $_GET['enviado'];
	$id_chamada = $_GET['id_chamada'];

	if($enviado == 0){


	}else{

		cadastrar_mensagem($conexao,$mensagem,$enviado,$id_chamada);
	}


} catch (Exception $e) {
	echo $e;	
}

?>