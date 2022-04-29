<?php
	session_start();
    include("../Model/Conexao.php");
try {
  $mensagem=$_GET['mensagem'];
  $idaluno=$_SESSION['idaluno'];
  $nome_aluno=$_SESSION['nome'];
  $idturma=$_SESSION['turma_id'];
  $idescola=$_SESSION['escola_id'];


  $res=$conexao->exec("INSERT INTO chat(mensagem, aluno_id, escola_id, turma_id) VALUES ('$mensagem', $idaluno, $idescola,$idturma)");
  
 
} catch (Exception $e) {
  
}
?>