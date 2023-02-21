<?php
  include_once '../Model/Conexao.php';
  include_once '../Model/Aluno.php';
  try {
    $idnota=$_GET['idnota'];
    excluir_notas_cadastrada_fora($conexao,$idnota);
    
    echo "certo";
  } catch (Exception $e) {
    echo "$e";
  }
  
?>