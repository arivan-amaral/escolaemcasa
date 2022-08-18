<?php
session_start();
include "../Model/Conexao.php";
include "../Model/Chamada.php";
try {

    $chamada = $_GET['chamada'];
    $funcionario=$_GET['funcionario'];
    $mensagem=$_GET['mensagem'];
    $data =date('Y-m-d');
    questionar_chamado($conexao,$chamada,$funcionario,$data,$mensagem);
    
} catch (Exception $exc) {

    //echo $exc;
}
?>