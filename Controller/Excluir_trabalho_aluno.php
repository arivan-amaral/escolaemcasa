<?php
session_start();
include '../Model/Conexao.php';
include '../Model/Trabalho.php';
 $array_url=explode('p?', $_SERVER["REQUEST_URI"]);
 $url_get=$array_url[1];
 $id = $_GET['id'];
try {
	$res_tra=pesquisar_trabalho_entregue_aluno($conexao,$id);
	foreach ($res_tra as $key => $value) {
		if ($value['caminho']!="") {
			unlink('../View/trabalho_entregue/'.$value['caminho']);	
		}
	}

	$res=excluir_trabalho_aluno($conexao,$id);
	$_SESSION['status']=1;
	header("Location:../View/trabalho_individual.php?$url_get");

} catch (Exception $e) {
	$_SESSION['status']=0;
	$_SESSION['mensagem']='Alguma coisa deu errado';
	header("Location:../View/trabalho_individual.php?$url_get");
}

?>