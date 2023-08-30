<?php session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Setor.php';
 try {

 	$nome=$_POST['nome'];


 	cadastrar_setor($conexao,$nome);

 	$_SESSION['status']=1;


 	 
 	 
 	 header("location:../View/cadastro_setor.php?status=1");

 } catch (Exception $e) {
 	 //$_SESSION['status']=0;
 	  //header("location:../View/cadastro_professor.php?status=0");
 	echo $e;
 }



?>