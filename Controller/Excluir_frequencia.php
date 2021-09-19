<?php
session_start();
include '../Model/Conexao.php';
include '../Model/Aluno.php';

$conteudo_aula_id=$_GET['conteudo_aula_id'];
$local=$_GET['local'];


$array_url=explode('disc=', $_SERVER["REQUEST_URI"]);
 $url_get='disc='.$array_url[1];

try {

	excluir_frequencia_lancada($conexao,$conteudo_aula_id);
	$_SESSION['status']=1;
	header("Location:../View/$local.php?$url_get");
} catch (Exception $e) {

	$_SESSION['status']=0;
	header("Location:../View/$local.php?$url_get");
}

?>