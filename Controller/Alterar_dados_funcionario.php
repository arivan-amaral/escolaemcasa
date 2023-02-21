<?php 
 session_start();

 include_once '../Model/Conexao.php';
 include_once '../Model/Professor.php';
 
 try {
$idfuncionario=$_SESSION['idfuncionario'];

$nome=$_POST['nome'];
$email=$_POST['email'];
$senha=$_POST['senha'];
$whatsapp=$_POST['whatsapp'];



alterar_dados_professor($conexao,$nome, $email, $senha,$whatsapp,$idfuncionario);
 	$_SESSION['status']=1;

header("Location:../View/alterar_dados_funcionario.php?status=0");
} catch (Exception $e) {
	$_SESSION['status']=0;
header("../View/alterar_dados_funcionario.php?status=0");
 }
?>