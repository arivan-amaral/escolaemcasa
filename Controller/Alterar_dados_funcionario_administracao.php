<?php 
 session_start();

 include '../Model/Conexao.php';
 include '../Model/Professor.php';
 
 try {
$idfuncionario=$_POST['idfuncionario'];

$nome=$_POST['nome'];
$email=$_POST['email'];
$senha=$_POST['senha'];
$whatsapp=$_POST['whatsapp'];



alterar_dados_professor($conexao,$nome, $email, $senha,$whatsapp,$idfuncionario);
 	$_SESSION['status']=1;

header("Location:../View/pesquisar_professor_associar.php?status=0");
} catch (Exception $e) {
	$_SESSION['status']=0;
header("../View/pesquisar_professor_associar.php?status=0");
 }
?>