<?php
session_start();

  if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
  include_once '../Model/Aluno.php';
  try {
    $idnota=$_GET['idnota'];
    excluir_notas_cadastrada_fora($conexao,$idnota);
    
    echo "certo";
  } catch (Exception $e) {
    echo "$e";
  }
  
?>