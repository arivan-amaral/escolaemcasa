<?php session_start();
include_once'../Model/Conexao.php';
include_once'../Model/Aluno.php';
include_once'../Model/Coordenador.php';
include_once'Api_code_chat.php';
include_once'Conversao.php';


try {

if (isset($_SESSION['whatsapp'])) {
	$sessao_whatsapp=$_SESSION['whatsapp'];
}else{
	$sessao_whatsapp="educalem";

}
	$profissional_solicitante=$_SESSION['idfuncionario'];


	$serie_id=$_POST['serie_id'];
	$turma_id_origem=$_POST['turma_id_origem'];
	$escola_id=$_POST['escola_id'];
	$escola_id_origem=$_POST['escola_id_origem'];
	$observacao=$_POST['observacao'];
	$url_get=$_POST['url_get'];


	$ano_letivo=$_SESSION['ano_letivo'];
	$ano_letivo_vigente=$_SESSION['ano_letivo_vigente'];
	$aluno_reprovado = "";


if (isset($_POST['idaluno'])) {
		$solicitacao_pendente='';
		foreach ($_POST['idaluno'] as $key => $value) {
			$aluno_id=$_POST['idaluno'][$key];
			$nome_aluno=$_POST["nome_aluno$aluno_id"];
			$matricula_aluno=$_POST["matricula_aluno".$aluno_id];
			$resultado=$_POST["resultado".$aluno_id];
			alterar_status_carteirinha_transporte($conexao,$aluno_id, 1);

		
		}



	}


	if (!isset($_POST['idaluno'])) {
		$_SESSION['status']=0;
		$_SESSION['mensagem']='Nenhum aluno selecionado!';
		header("location:../View/listar_alunos_da_turma.php?$url_get");
		exit();
	
	}else{


		

		$_SESSION['status']=1;
		header("location:../View/listar_alunos_da_turma.php?$url_get");	
		exit();
	}
		


} catch (Exception $e) {
	 echo "$e";
	// exit();
	$_SESSION['status']=0;
	$_SESSION['mensagem']='Alguma coisa deu errado, tente novamente!';
	header("location:../View/listar_alunos_da_turma.php?$url_get");
 	
}

?>