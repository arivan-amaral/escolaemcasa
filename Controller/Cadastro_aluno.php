<?php session_start();
include'../Model/Conexao.php';
include'../Model/Aluno.php';
include'../Model/Turma.php';
try {
 	 $nome=$_POST['nome'];
 	 $data_nascimento=$_POST['data_nascimento'];
 	 $escola=$_POST['escola'];
 	 $email=$_POST['email'];
 	 $documento=$_POST['documento'];
 	 $senha=$_POST['senha'];
 	 $whatsapp='55'.$_POST['whatsapp'];
 	 
 	 $whatsapp= str_replace(' ', '', $whatsapp);
 	 $whatsapp= str_replace('(', '', $whatsapp);
 	 $whatsapp= str_replace(')', '', $whatsapp);
 	 $whatsapp= str_replace('-', '', $whatsapp);
 	 
 	 $sexo=$_POST['sexo'];
 	 $turma=$_POST['turma'];

 	$result=cadastro_aluno($conexao,$nome, $email, $documento, $senha, $whatsapp,$sexo,$data_nascimento);
    $aluno_id= $conexao->lastInsertId();
 	associar_aluno($conexao, date("Y"), $turma, $aluno_id,  $escola);
 	$_SESSION['status']=1;


 	 
 	header("location:../View/cadastro_aluno.php?status=1");
 } catch (Exception $e) {
 	 $_SESSION['status']=0;
	 header("location:../View/cadastro_aluno.php?status=0");
 }
?>