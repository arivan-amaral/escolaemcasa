<?php
session_start();
include "../Model/Conexao.php";
include "../Model/Chamada.php";
try {

    $chamada = $_GET['chamada'];
    $funcionario=$_GET['funcionario'];
    $data =date('Y-m-d');
    questionar_chamado($conexao,$chamada,$funcionario,$data);
    
} catch (Exception $exc) {

    //echo $exc;
}
?>