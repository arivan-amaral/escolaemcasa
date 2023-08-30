<?php
session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Setor.php';
include_once '../Model/Escola.php';

try {
    $result="";
    
    
    $res_tipos=lista_escola($conexao);
    foreach ($res_tipos as $key => $value) {
    $id = $value['idescola'];
    $tipo_nome = $value['nome_escola'];
    $result.= "<option value='$id'>$tipo_nome</option>";
    }
    
    
    echo "$result";
    
} catch (Exception $exc) {
   //echo " VERIFIQUE SUA CONEXÃO COM A INTERNET";
   echo $exc;
}
?>