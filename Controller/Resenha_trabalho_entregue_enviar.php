<?php
  session_start();
    include("../Model/Conexao.php");
try {

  $trabalho_entregue_id=$_GET['trabalho_entregue_id'];
  $resposta=$_GET['resposta'];
  $aluno_id=$_GET['aluno_id'];

  if ($_GET['funcionario_id'] !="") {
    $funcionario_id=$_GET['funcionario_id'];
     $conexao->exec("INSERT INTO resenha_trabalho_entregue(trabalho_entregue_id, resposta, funcionario_id, aluno_id) VALUES ($trabalho_entregue_id, '$resposta', $funcionario_id, $aluno_id)");
  }else{
     $conexao->exec("INSERT INTO resenha_trabalho_entregue(trabalho_entregue_id, resposta, aluno_id) VALUES ($trabalho_entregue_id, '$resposta', $aluno_id)");

  }


 
  
 
} catch (Exception $e) {
  echo "$e";
}
?>