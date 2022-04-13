<?php
session_start();
include "../Model/Conexao.php";
include '../Model/Setor.php';

try {
    $result="";
    
    $setor_id = $_GET['setor_id'];
    $res_tipos=buscar_tipo_solicitacao($conexao,$setor_id);
    foreach ($res_tipos as $key => $value) {
    $id = $value['id'];
    $tipo_nome = $value['nome'];
    $result.= "<option value='$id'>$tipo_nome</option>";
    }
    
    
    echo "$result";
    
} catch (Exception $exc) {
   //echo " VERIFIQUE SUA CONEXÃO COM A INTERNET";
   echo $exc;
}
?>