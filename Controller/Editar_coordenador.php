<?php session_start();
include'../Model/Conexao.php';
include'../Model/Coordenador.php';
 try {

 	 $idfuncionario=$_POST['idfuncionario'];
    $nome=$_POST['nome'];
 	 $email=$_POST['email'];
 	 $senha=$_POST['senha'];
 	 $whatsapp="".$_POST['whatsapp'];

 	 $whatsapp= str_replace(' ', '', $whatsapp);
 	 $whatsapp= str_replace('(', '', $whatsapp);
 	 $whatsapp= str_replace(')', '', $whatsapp);
 	 $whatsapp= str_replace('-', '', $whatsapp);

 	 $sexo="Masculino";
 	 $funcao="";

 	 if ($sexo=='Masculino') {
 	 	$funcao=$_POST['funcao'];
 	 }else{
 	 	$funcao=$_POST['funcao'];

 	 }

 	 // echo "$nome <br>";
 	 // echo "$email <br>";
 	 // echo "$senha <br>";
 	 // echo "$whatsapp <br>";

 	 editar_coordenador($conexao,$nome, $email, $funcao,$whatsapp, $idfuncionario);

 	 $_SESSION['status']=1;


 	 
 	 header("location:../View/pesquisar_coordenador_associar.php");

 } catch (Exception $e) {
 	$_SESSION['status']=0;
    $_SESSION['mensagem']="Erro ao editar";
    header("location:../View/pesquisar_coordenador_associar.php");
 }



?>