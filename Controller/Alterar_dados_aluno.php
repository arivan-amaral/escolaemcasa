<?php session_start();
include'../Model/Conexao.php';
include'../Model/Aluno.php';

function converte_telefone($whatsapp){

	$whatsapp= str_replace(' ', '', $whatsapp);
	$whatsapp= str_replace('(', '', $whatsapp);
	$whatsapp= str_replace(')', '', $whatsapp);
	$whatsapp= str_replace('-', '', $whatsapp);
	return $whatsapp;
}

$nome=$_POST['nome'];
$email=$_POST['email'];
$senha=$_POST['senha'];
$whatsapp="".converte_telefone($_POST['whatsapp']);
$whatsapp_responsavel="".converte_telefone($_POST['whatsapp_responsavel']);
$idaluno=$_SESSION['idaluno'];


	try {
		if ($idaluno!="") {
			atualizar_dados_aluno($conexao,$nome,$email,$senha,$whatsapp, $whatsapp_responsavel, $idaluno);
		}
		$_SESSION['status']=1;
		header("location:../View/aluno.php?status=1");
		 
	} catch (Exception $e) {
		$_SESSION['status']=0;
		header("location:../View/alterar_dados_aluno.php?status=0");
	}

?>