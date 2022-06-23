<?php
session_start();
include '../Model/Conexao.php';
include '../Model/Chamada.php';
include '../Model/Setor.php';

try {

	$mensagem = $_GET['mensagem'];
	$enviado = $_GET['enviado'];
	$id_chamada = $_GET['id_chamada'];

	if($enviado == 0){
	$id_setor =0;
	$res_setor = pesquisar_chamado($conexao,$id_chamada);
	foreach ($res_setor as $key => $value) {
		$id_setor = $value['setor_id'];
	}
	$res_funcionario = buscar_funcionario_setor($conexao,$id_setor);
	foreach ($res_funcionario as $key => $value) {
		$id_funcionario = $value['funcionario_id'];
		cadastrar_mensagem($conexao,$mensagem,$id_funcionario,$id_chamada);	
	}
	
	}else{

		cadastrar_mensagem($conexao,$mensagem,$enviado,$id_chamada);
	}


} catch (Exception $e) {
	echo $e;	
}

?>