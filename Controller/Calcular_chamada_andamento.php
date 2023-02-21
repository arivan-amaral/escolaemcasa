<?php
session_start();
   include_once "../Model/Conexao.php";
   include_once '../Model/Setor.php';
   include_once '../Model/Chamada.php';
try {
    
   
   $contar_chamados = 0;

   $res = quant_chamada_andamento($conexao);
   foreach ($res as $key => $value) {
   $contar_chamados = $value['id'];
  }
 
 
    echo "$contar_chamados";
    
} catch (Exception $exc) {
   //echo " VERIFIQUE SUA CONEXÃO COM A INTERNET";
   echo $exc;
}
?>