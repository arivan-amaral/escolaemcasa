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