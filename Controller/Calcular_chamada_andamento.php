<?php
session_start();
   if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
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