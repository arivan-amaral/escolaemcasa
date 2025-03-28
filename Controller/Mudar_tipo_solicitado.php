<?php
session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Setor.php';

try {
    $result="<option></option>";
    
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