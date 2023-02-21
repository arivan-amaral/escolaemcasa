<?php
session_start();
include_once "../Model/Conexao.php";
include_once "../Model/Chamada.php";
try {

    $id_chamada = $_GET['id_chamado'];
    $idFuncionario=$_SESSION['idfuncionario'];
    if($idFuncionario != 1179){
    	responder_chamada($conexao,$id_chamada,$idFuncionario);
    	mudar_status($conexao,$id_chamada);
    }
    
    
} catch (Exception $exc) {

    //echo $exc;
}
?>