<?php
session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Questionario.php';
    $id=$_GET['id'];
    $status=$_GET['status'];
    
try {
	if ($status==1) {
		$status=0;
	}elseif ($status==0) {
		$status=1;
	}
	$resultado=alterar_status_questionario_simulado($conexao,$id,$status);
	$_SESSION['status']=1;
 	 header("location:../View/cadastrar_simulado.php?status=1#questionario");

} catch (Exception $e) {
		$_SESSION['status']=0;
	 	 header("location:../View/cadastrar_simulado.php?status=0#questionario");	
}

?>