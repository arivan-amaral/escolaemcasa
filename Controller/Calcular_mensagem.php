<?php
session_start();
   include "../Model/Conexao.php";
   include '../Model/Setor.php';
   include '../Model/Chamada.php';
try {
    
   
   $contar_chamados = 0;

   $res = pesquisar_mensagens_quant_menu($conexao,$_SESSION['idfuncionario']);
   foreach ($res as $key => $value) {
    $contar_chamados = $value['mensagens'];
  }
 
 
    echo "$contar_chamados";
    
} catch (Exception $exc) {
   //echo " VERIFIQUE SUA CONEXÃO COM A INTERNET";
   echo $exc;
}
?>