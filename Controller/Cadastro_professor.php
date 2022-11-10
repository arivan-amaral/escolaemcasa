<?php session_start();
include'../Model/Conexao.php';
include'../Model/Professor.php';
 try {

 	 $nome=$_POST['nome'];
 	 $email=$_POST['email'];
 	 $senha=$_POST['senha'];
 	 $whatsapp="55".$_POST['whatsapp'];

 	 $whatsapp= str_replace(' ', '', $whatsapp);
 	 $whatsapp= str_replace('(', '', $whatsapp);
 	 $whatsapp= str_replace(')', '', $whatsapp);
 	 $whatsapp= str_replace('-', '', $whatsapp);
 	 $cpf=converte_telefone($_POST['cpf']);
 	 // echo "$nome <br>";
 	 // echo "$email <br>";
 	 // echo "$senha <br>";
 	 // echo "$whatsapp <br>";
	$funcao='';

if ($_POST['sexo']=="Masculino") {
	$funcao='Professor';
}else {
	$funcao='Professora';
	
}
 	 cadastro_professor($conexao,$nome, $email, $funcao,$whatsapp, $senha,$cpf);

 	 $_SESSION['status']=1;


 	 
 	 
 	 header("location:../View/cadastro_professor.php?status=1");

 } catch (Exception $e) {
 	 $_SESSION['status']=0;
 	  header("location:../View/cadastro_professor.php?status=0");
 }



?>