<?php
session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Chamada.php';

try {

	$funcionario_id = $_POST['id_funcionario'];
	$descricao = $_POST['resposta'];
	$data_previsao = $_POST['data_previsao'];

	$data = date('Y-m-d H:i');
	$id_chamada = $_POST['id_chamado'];
	//$url_get = $_POST['url_get'];

	responder_chamada($conexao,$id_chamada,$funcionario_id);
	responder_chat_sem_arquivo($conexao,$id_chamada,$funcionario_id,$descricao,$data);
	atualizar_chamado_data_prevista($conexao,$id_chamada,$data_previsao);
	mudar_status($conexao,$id_chamada);
	$_SESSION['status']=1;
	header("Location:../View/chamada.php");
	
	
	
		 
	


} catch (Exception $e) {
	//$_SESSION['status']=0;
		//header("Location:../View/cadastro_trabalho.php?$url_get");
	echo $e;
	
}






	?>