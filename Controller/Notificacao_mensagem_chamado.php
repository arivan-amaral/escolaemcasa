<?php
session_start();
include_once "../Model/Conexao.php";
include_once '../Model/Setor.php';
include_once '../Model/Chamada.php';

try {
    $result="";
    
     $res = pesquisar_mensagens($conexao,  $_SESSION["idfuncionario"]);
     foreach ($res as $key => $value) {
      $mensagem = $value['mensagem'];
      $id_chamada = $value['id_chamado'];
        $result.="mensagem : $mensagem , protocolo do chamado $id_chamada
         ";
     }
    
    
    echo "$result";
    
} catch (Exception $exc) {
   //echo " VERIFIQUE SUA CONEXÃO COM A INTERNET";
   echo $exc;
}
?>