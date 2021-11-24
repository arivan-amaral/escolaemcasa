<?php session_start();
include'../Model/Conexao.php';
include'../Model/Escola.php';


try {

$profissional_solicitante=$_SESSION['idfuncionario'];
$aluno_id=$_POST['aluno_id'];
$serie_id=$_POST['serie_id'];
$escola_id=$_POST['escola_id'];
$observacao=$_POST['observacao'];
 
solicitacao_transferencia(
$conexao,
$aluno_id,
$serie_id,
$profissional_solicitante,
$escola_id,
$observacao);
	
		$_SESSION['status']=1;
		header("location:../View/pesquisa_aluno.php?status=1");
	} catch (Exception $e) {
		$_SESSION['status']=0;
		header("location:../View/pesquisa_aluno.php?status=0");
	}

?>