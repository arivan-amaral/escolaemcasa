<?php
session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Chamada.php';
include_once '../Model/Setor.php';

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