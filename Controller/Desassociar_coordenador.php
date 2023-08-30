<?php
session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Escola.php';
 try {

 	 $id=$_GET['idrelacionamento_funcionario_escola'];


 	 desassociar_coordenador($conexao, $id);
 	 $_SESSION['status']=1;
 	 header("location:../View/pesquisar_coordenador_associar.php?status=1");

 } catch (Exception $e) {
 	 $_SESSION['status']=0;
 	 header("location:../View/pesquisar_coordenador_associar.php?status=0");

 	

 }



?>