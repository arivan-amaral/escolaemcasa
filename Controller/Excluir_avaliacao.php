<?php
session_start();
include '../Model/Conexao.php';
include '../Model/Aluno.php';

$data_nota=$_GET['data_nota'];
$turma_id  =$_GET['turma_id'];
$disciplina_id  =$_GET['disciplina_id'];
$escola_id=$_GET['escola_id'];
$avaliacao=$_GET['avaliacao'];
$periodo_id=$_GET['periodo_id'];

$array_url=explode('disc=', $_SERVER["REQUEST_URI"]);
 $url_get='disc='.$array_url[1];

try {

	excluir_avaliacao_lancada($conexao,$escola_id,$turma_id,$disciplina_id,$periodo_id,$data_nota,$avaliacao);
	$_SESSION['status']=1;
	header("Location:../View/diario_avaliacao.php?$url_get");
} catch (Exception $e) {
	
	$_SESSION['status']=0;
	header("Location:../View/diario_avaliacao.php?$url_get");
}

?>