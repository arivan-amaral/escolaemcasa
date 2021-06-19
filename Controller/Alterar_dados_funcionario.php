<?php session_start();
include '../Model/Conexao.php';
include '../Model/Professor.php';
 

$idfuncionario=$_SESSION['idfuncionario'];

$nome=$_POST['nome'];
$email=$_POST['email'];
$senha=$_POST['senha'];
$whatsapp=$_POST['whatsapp'];

try {
	alterar_dados_professor($conexao,$nome, $email, $senha,$whatsapp,$idfuncionario);
	$_SESSION['status']=1;
	header("../View/alterar_dados_funcionario.php?status=1");
} catch (Exception $e) {
	$_SESSION['status']=0;
	header("../View/alterar_dados_funcionario.php?status=0");
}
?>