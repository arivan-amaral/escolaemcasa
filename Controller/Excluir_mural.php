<?php
session_start();
include '../Model/Conexao.php';
include '../Model/Mural.php';

$idmural=$_GET['idmural'];


$array_url=explode('disc=', $_SERVER["REQUEST_URI"]);
 $url_get='disc='.$array_url[1];

try {

	excluir_mural($conexao,$idmural);
	$_SESSION['status']=1;
	header("Location:../View/cadastrar_mural.php?$url_get");
} catch (Exception $e) {

	$_SESSION['status']=0;
	header("Location:../View/cadastrar_mural.php?$url_get");
}

?>