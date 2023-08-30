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
include_once '../Model/Chamada.php';

try {
    $result="";
    
    $setor_id = $_GET['setor_id'];
    if ($setor_id != 11) {
        $res_usuarios=buscar_funcionario_setor($conexao,$setor_id);
        foreach ($res_usuarios as $key => $value) {
            $id_usuario = $value['funcionario_id'];
            $res_nome_usuario = nome_funcionario($conexao,$id_usuario);
            foreach ($res_nome_usuario as $key => $value) {
              $nome = $value['nome'];
              $result.= "<option value='$id_usuario'>$nome</option>";
            }
        }
    }else{
        $res_escola = escola_funcionarios($conexao);
        foreach ($res_usuarios as $key => $value) {
            $id_usuario = $value['funcionario_id'];
            $res_nome_usuario = nome_funcionario($conexao,$id_usuario);
            foreach ($res_nome_usuario as $key => $value) {
              $nome = $value['nome'];
              $result.= "<option value='$id_usuario'>$nome</option>";
            }
        }
    }
   
    
    
    echo "$result";
    
} catch (Exception $exc) {
   //echo " VERIFIQUE SUA CONEXÃO COM A INTERNET";
   echo $exc;
}
?>