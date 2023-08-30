<?php
session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Questionario.php';
$id = $_GET['id'];
try {
	
	$res=excluir_questionario($conexao, $id);
	// excluir_questao_por_id_questionario($conexao, $id);
	//$_SESSION['status']=1;
   // header("Location:../View/cadastrar_questionario.php");


} catch (Exception $e) {
	echo "erro";
	//$_SESSION['status']=0;
    //header("Location:../View/cadastrar_questionario.php");
}

?>