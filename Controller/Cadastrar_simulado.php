<?php
session_start();
include '../Model/Conexao.php';
include '../Model/Questionario.php';
include '../Model/Aluno.php';
include '../Model/Turma.php';


try {
	$funcionario_id=$_SESSION['idfuncionario'];

	$nome = $_POST['nome'];
	$data = $_POST['data']." ".$_POST['hora_inicio'];
	$data_final = $_POST['data_final']." ".$_POST['hora_fim'];
	$idserie = $_POST['idserie'];
	$origem_questionario_id = uniqid ( time () );
	$url = $_POST['url_get'];

	cadastrar_simulado($conexao,$nome,$data,$data_final,$funcionario_id,$origem_questionario_id,$idserie);

	$_SESSION['status']=1;
	header("Location:../View/cadastrar_simulado.php?$url&status=1");
} catch (Exception $e) {
	$_SESSION['status']=0;
	$_SESSION['mensagem']='Erro desconhecido';
	header("Location:../View/cadastrar_simulado.php?$url&status=0");
	
}

?>