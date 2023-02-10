<?php session_start();
include_once'../Model/Conexao.php';
include_once'../Model/Escola.php';
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

// <=======RECRIA PÁGIANAS ESTATICAS =======>
	$pagina_estatica=$_POST['url_get'];
	$pagina_estatica =strtr($pagina_estatica, "&", " ");
	$pagina_estatica =strtr($pagina_estatica, "%", " ");
	$pagina_estatica="listar_alunos_da_turma.php ".$pagina_estatica.".php";
	if (file_exists("../View/pagina_estatica/$pagina_estatica")) {
		unlink("../View/pagina_estatica/$pagina_estatica");
	}
	// <=========================================>

	if ( empty($observacao)){
		$_SESSION['status']=0;
		$_SESSION['mensagem']='Selecione todos os campos incluindo uma observação!';
		header("location:../View/listar_alunos_da_turma.php?$url_get");
		exit();

	}elseif (isset($_POST['idaluno'])) {
		$solicitacao_pendente='';
		foreach ($_POST['idaluno'] as $key => $value) {
			$aluno_id=$_POST['idaluno'][$key];
			$nome_aluno=$_POST["nome_aluno$aluno_id"];
			$matricula_aluno=$_POST["matricula_aluno".$aluno_id];
			$resultado=$_POST["resultado".$aluno_id];
			
			$aceita=0; //neutra
			//$aceita=1;// 1 aceita
			//$aceita=2;// 2 recusada

			$solicitacao_tranferencia=verificar_solicitacao_tranferencia($conexao,$aluno_id,$ano_letivo_vigente,$aceita);

			 if (count($solicitacao_tranferencia)==0) {
			 	if ($escola_id==0) {
			 		$aceita=1;// 1 aceita
			 	 
			 			solicitacao_transferencia(
			 				$conexao,
			 				$matricula_aluno,
			 				$aluno_id,
			 				$serie_id,	
			 				$profissional_solicitante,
			 				$escola_id,
			 				$observacao,$ano_letivo,$ano_letivo_vigente,$aceita,$escola_id_origem,$turma_id_origem);

			 		$procedimento="TRANSFERIDO FORA";
			 		$data_saida=date("Y-m-d");
			  		mudar_situacao_transferencia_aluno($conexao,$matricula_aluno,$procedimento,$data_saida);
			 		echo "$procedimento";
			 	}else{
			 		$aceita=0;// 0 neutra(pendente)
					solicitacao_transferencia(
					$conexao,
					$matricula_aluno,
					$aluno_id,
					$serie_id,	
					$profissional_solicitante,
					$escola_id,
					$observacao,$ano_letivo,$ano_letivo_vigente,$aceita,$escola_id_origem,$turma_id_origem);

					$procedimento="TRANSFERIDO REDE";
			 		$data_saida=date("Y-m-d");
			  		mudar_situacao_transferencia_aluno($conexao,$matricula_aluno,$procedimento,$data_saida);

			  		//envia notificação no whatsapp dos secretarios associados que receberão o aluno na nova escola
			  		$res_associados=verificar_vinculo_funcionario_escola($conexao,$escola_id);
			  		foreach ($res_associados as $key => $value) {
					  		$nome_funcionario=$value['nome'];
					  		$telefone=converte_telefone($value['whatsapp']);
					  		// $telefone ="5589999342837";
					  		$newdata= array(
					  		    "number" => "$telefone",
					  		    "options" => array(
					  		        "delay"=> rand(10, 100)
					  		    ),
					  		    "textMessage" => array(
					  		        "text"=> "Olá sr(a) *".$nome_funcionario."* , \n\nESSA MESNSAGEM FOI ENVIADA DE FORMA AUTOMÁTICA PELO SISTEMA ".strtoupper($sessao_whatsapp)." COM A FINALIDADE DE INFORMA SOBRE UMA MOVIMENTAÇÃO OCORRIDA NA SUA ESCOLA DE ATUAÇÃO\n\n\n $observacao ⚠️*para a escola onde você trabalha!*⚠️"
					  		    ),
					  		);
					  		 
					  		
					  		enviar_mensagem_code_chat($sessao_whatsapp,$newdata);
					  		// echo "$observacao";
			  		}
			  		//envia notificação no whatsapp dos secretarios associados que receberão o aluno na nova escola

					  		// echo $sessao_whatsapp;



			 	}

			 // $procedimento="TRANSFERIDO FORA";
			 //  mudar_situacao_transferencia_aluno($conexao,$matricula_aluno,$procedimento);

			 }else{
			 	$solicitacao_pendente.=" | $nome_aluno ";
			 }
		}




	}

	if (!isset($_POST['idaluno'])) {
		$_SESSION['status']=0;
		$_SESSION['mensagem']='Nenhum aluno selecionado!';
		header("location:../View/listar_alunos_da_turma.php?$url_get");
		exit();
	}elseif ($solicitacao_pendente!="") {
		$_SESSION['status']=2;
		$_SESSION['mensagem']="Aluno com solicitação de transferência pendente: ".$solicitacao_realizada;
		header("location:../View/listar_alunos_da_turma.php?$url_get");	
		exit();
	}
	
	else{
	 
	$_SESSION['status']=1;
		header("location:../View/listar_alunos_da_turma.php?$url_get");	
		exit();
	}
		


} catch (Exception $e) {
	// echo "$e";
	// exit();
	$_SESSION['status']=0;
	$_SESSION['mensagem']='Alguma coisa deu errado, tente novamente!';
	header("location:../View/listar_alunos_da_turma.php?$url_get");
 	
}

?>