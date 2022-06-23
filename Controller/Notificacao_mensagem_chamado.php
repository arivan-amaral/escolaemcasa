<?php
session_start();
include "../Model/Conexao.php";
include '../Model/Setor.php';
include '../Model/Chamada.php';

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