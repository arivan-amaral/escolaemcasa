<?php
session_start();
include "../Model/Conexao.php";
include "../Model/Chamada.php";
try {

    $id_chamada = $_GET['id_chamado'];
    $idFuncionario=$_SESSION['idfuncionario'];
    responder_chamada($conexao,$id_chamada,$idFuncionario);
    
} catch (Exception $exc) {

    //echo $exc;
}
?>