<?php
session_start();
   if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
$idfuncionario=$_SESSION['idfuncionario'];
include_once "../Model/Conexao_".$usuariobd.".php";
   include_once '../Model/Setor.php';
   include_once '../Model/Chamada.php';
try {
    
   $mensagem=$_GET['mensagem'];
   $id=$_GET['id'];
   $conexao->exec("UPDATE registro_ligacao_busca_ativa set resposta_sme='$mensagem', funcionario_id_resposta=$idfuncionario where  id=$id ");


   echo "certo";

    
} catch (Exception $exc) {
   //echo " VERIFIQUE SUA CONEXÃO COM A INTERNET";
   echo $exc;
}
?>