<?php
session_start();
   include "../Model/Conexao.php";
   include '../Model/Setor.php';
   include '../Model/Chamada.php';
try {
    
   
   $contar_chamados = 0;
   $idEscola = 0 ;
   $res_verificar_funcionario = buscar_setor_funcionario($conexao,$_SESSION['idfuncionario']);
   foreach ($res_verificar_funcionario as $key => $value) {
    $setor_id = $value['setor_id'];
    $res_quantidade_pendente = quantidade_chamada_pendente($conexao,$setor_id);
    foreach ($res_quantidade_pendente as $key => $value) {
      $contar_chamados += $value['chamada'];
    }
  }
  $res_verificar_escola = buscar_id_escola($conexao,$_SESSION['idfuncionario']);
  foreach ($res_verificar_escola as $key => $value) {
    $idEscola = $value['escola_id'];
  }
  if ($idEscola != 0) {
    $res_escola =  quantidade_chamada_pendente_escola($conexao,11,$idEscola);
    foreach ($res_escola as $key => $value) {
      $contar_chamados += $value['chamada'];
    }
  }

    echo "$contar_chamados";
    
} catch (Exception $exc) {
   //echo " VERIFIQUE SUA CONEXÃO COM A INTERNET";
   echo $exc;
}
?>