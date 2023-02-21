<?php
session_start();
include_once '../Model/Conexao.php';
include_once '../Model/Turma.php';
 try {

 	 $id=$_GET['id'];

   $result = $conexao->exec("DELETE FROM video_chamada where id=$id");

 	 //$_SESSION['status']=1;

 	 //header("location:../View/pesquisar_professor_associar.php?status=1");

 } catch (Exception $e) {
 	 //$_SESSION['status']=0;
    echo "VERIFIQUE SUA CONEXÃO COM A INTERNET!";
 	 //header("location:../View/pesquisar_professor_associar.php?status=0");

 	

 }



?>