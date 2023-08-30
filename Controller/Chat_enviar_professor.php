<?php
	session_start();
    if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
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