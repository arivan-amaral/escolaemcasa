<?php
  session_start();
    if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
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