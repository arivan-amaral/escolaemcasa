<?php session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Coordenador.php';
include_once 'Conversao.php';
 try {

 	 $idfuncionario=$_POST['idfuncionario'];
    $nome=escape_mimic($_POST['nome']);
 	 $email=$_POST['email'];
 	 $senha=$_POST['senha'];
 	 $whatsapp="".$_POST['whatsapp'];
 	 $cpf = converte_telefone($_POST['cpf']);
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

 	 editar_coordenador($conexao,$nome, $email, $funcao,$whatsapp, $idfuncionario,$cpf);

 	 $_SESSION['status']=1;


 	 
 	 header("location:../View/pesquisar_coordenador_associar.php");

 } catch (Exception $e) {
 	$_SESSION['status']=0;
    $_SESSION['mensagem']="Erro ao editar";
    header("location:../View/pesquisar_coordenador_associar.php");
 }



?>