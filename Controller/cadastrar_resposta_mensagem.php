<?php
session_start();
include '../Model/Conexao.php';
include '../Model/Chamada.php';
include '../Model/Setor.php';

try {

	$mensagem = $_GET['mensagem'];
	$id_funcionario = $_GET['id_funcionario'];
	$id_mensagem = $_GET['id_mensagem'];

	cadastrar_resposta_mensagem($conexao,$mensagem,$id_funcionario,$id_mensagem);
	atualizar_mensagem($conexao,$id_mensagem);

} catch (Exception $e) {
	echo $e;	
}

?>