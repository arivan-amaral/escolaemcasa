<?php
session_start();
$professor_id=$_SESSION['idfuncionario'];

include '../Model/Conexao.php';
include '../Model/Questionario.php';
include 'Conversao.php';
try {
$idquestao =($_POST['idquestao']);
$nome_descricao =escape_mimic($_POST['nome']);
$pontos =$_POST['pontos'];
$url =$_POST['url_get'];


$array_url=explode('&', $url);
$tirar=$array_url[0];

$url=str_replace($tirar, '',$url);


	$conexao->exec("UPDATE  questao_simulado SET nome='$nome_descricao',pontos=$pontos where id=$idquestao ");

	
	
foreach ($_POST['idalternativa'] as $key => $value) {
	$questao_id=$value;
	$idalternativa=$_POST['idalternativa'][$key];
	$alternativa=escape_mimic($_POST["$idalternativa"]);
	$conexao->exec("UPDATE  alternativa_simulado SET nome='$alternativa' where id=$idalternativa ");
}


	$_SESSION['status']=1;
	header("Location:../View/adicionar_questao_simulado.php?$url");
} catch (Exception $e) {
	$_SESSION['status']=0;
	$_SESSION['mensagem']="ERRO";
	header("Location:../View/adicionar_questao_simulado.php?$url");
}
?>