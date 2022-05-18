<?php
session_start();
include "../Model/Conexao.php";
include '../Model/Setor.php';
include '../Model/Escola.php';

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