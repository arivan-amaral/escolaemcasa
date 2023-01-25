<?php 
 session_start();
 include_once '../Model/Conexao.php';
 include '../Model/Aluno.php';
 include 'Conversao.php';
 
try {
  $id=$_GET['id'];
  $status=$_GET['status'];
    aceitar_lista_espera($conexao,$id,$status);

 
} catch (Exception $e) {
    echo "errado $e";
}
?>