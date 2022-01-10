<?php session_start();
include'../Model/Conexao.php';
include'../Model/Escola.php';


try {

	$profissional_solicitante=$_SESSION['idfuncionario'];


	$serie_id=$_POST['serie_id'];
	$escola_id=$_POST['escola_id'];
	$observacao=$_POST['observacao'];
	$url_get=$_POST['url_get'];
	$ano_letivo=$_SESSION['ano_letivo'];
	$ano_letivo_vigente=$_SESSION['ano_letivo_vigente'];
	$aluno_reprovado = "";

	if ( empty($_POST['escola_id']) ){
		$_SESSION['status']=0;
		$_SESSION['mensagem']='Selecione todos os campos!';
		header("location:../View/listar_alunos_da_turma.php?$url_get");
		exit();

	}elseif (isset($_POST['idaluno'])) {
		foreach ($_POST['idaluno'] as $key => $value) {
			$aluno_id=$_POST['idaluno'][$key];
			$nome_aluno=$_POST['nome_aluno'][$key];
			$matricula_aluno=$_POST['matricula_aluno'][$key];
			$resultado=$_POST['resultado'][$key];

			// if ($resultado=="Apc" || $resultado=="Apr") {
				solicitacao_transferencia(
					$conexao,
					$aluno_id,
					$serie_id,	
					$profissional_solicitante,
					$escola_id,
					$observacao,$ano_letivo,$ano_letivo_vigente);
				

			// }else{
			// 	$aluno_reprovado.=" | $aluno_id - $nome_aluno";
			// 	// echo "$aluno_reprovado";
			// }
		}

	}

	if (!isset($_POST['idaluno'])) {
		$_SESSION['status']=0;
		$_SESSION['mensagem']='Nenhum aluno selecionado!';
		header("location:../View/listar_alunos_da_turma.php?$url_get");
		exit();
	}
		$_SESSION['status']=1;
		header("location:../View/listar_alunos_da_turma.php?$url_get");	
	
		
	//  if ($aluno_reprovado!="") {
	// 	$_SESSION['status']=2;
	// 	$_SESSION['status']="Não é possível transferir aluno com reprovação".$aluno_reprovado;

	// } 



} catch (Exception $e) {
	$_SESSION['status']=0;
	$_SESSION['mensagem']='Alguma coisa deu errado, tente novamente!';
	header("location:../View/listar_alunos_da_turma.php?$url_get");
 
}

?>