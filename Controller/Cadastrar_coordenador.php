<?php session_start();
include'../Model/Conexao.php';
include'../Model/Coordenador.php';
 try {

 	 $nome=$_POST['nome'];
 	 $email=$_POST['email'];
 	 $senha=$_POST['senha'];
 	 $whatsapp="55".$_POST['whatsapp'];
 	 $cpf =converte_telefone($_POST['cpf']);

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

 	 cadastro_coordenador($conexao,$nome, $email, $funcao,$whatsapp, $senha,$cpf);
 	 $coordenador_id= $conexao->lastInsertId();
	 $ano= $_SESSION['ano_letivo'];
	
if (isset($_POST['escola_id'])) {
	// code...
	foreach ($_POST['escola_id'] as $key => $value) {
	   $escola_id= $_POST['escola_id'][$key];
	   associar_coordenador_a_escola($conexao,  $coordenador_id,$escola_id,$ano);
	}
 	 $_SESSION['status']=1;
}


 	 
 	 header("location:../View/cadastro_coordenador.php?status=1");

 } catch (Exception $e) {
 	$_SESSION['status']=0;
    $_SESSION['mensagem']="Erro ao cadastrar, esse e-mail ou usuário já exite!";

 	  header("location:../View/cadastro_coordenador.php?status=0");
 }



?>