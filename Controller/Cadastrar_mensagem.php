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
		cadastrar_mensagem($conexao,$mensagem,$id_funcionario,$id_chamada,$_SESSION['idfuncionario']);	
	}
	
	}else{

		cadastrar_mensagem($conexao,$mensagem,$enviado,$id_chamada,$_SESSION['idfuncionario']);
	}


} catch (Exception $e) {
	echo $e;	
}

?>