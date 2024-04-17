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
    
   $mensagem=$_GET['mensagem'];
   $id=$_GET['id'];

    
} catch (Exception $exc) {
   //echo " VERIFIQUE SUA CONEXÃO COM A INTERNET";
   echo $exc;
}
?>