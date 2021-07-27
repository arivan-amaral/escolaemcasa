<?php
	session_start();
    include("../Model/Conexao.php");
try {
  $mensagem=$_GET['mensagem'];
  $idfuncionario=$_SESSION['idfuncionario'];

  $idturma=$_GET['turma_id'];
  $idescola=$_GET['escola_id'];


  $res=$conexao->exec("INSERT INTO chat(mensagem, funcionario_id, escola_id, turma_id) VALUES ('$mensagem', $idfuncionario, $idescola,$idturma)");
  
 
} catch (Exception $e) {
  echo "$e";
}
?>