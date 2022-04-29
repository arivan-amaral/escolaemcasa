<?php
session_start();
include '../Model/Conexao.php';
include '../Model/Questionario.php';
    $id=$_GET['id'];
    $status=$_GET['status'];
    
try {
	if ($status==1) {
		$status=0;
	}elseif ($status==0) {
		$status=1;
	}
	$resultado=alterar_status_questionario($conexao,$id,$status);
	$_SESSION['status']=1;
 	 header("location:../View/cadastrar_questionario.php?status=1#questionario");

} catch (Exception $e) {
		$_SESSION['status']=0;
	 	 header("location:../View/cadastrar_questionario.php?status=0#questionario");	
}

?>