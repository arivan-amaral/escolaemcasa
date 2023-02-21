<?php
session_start();
include_once "../Model/Conexao.php";
include_once "../Model/Chamada.php";
try {

    $id_chamada = $_GET['id_chamado'];
    finalizar_chamada($conexao,$id_chamada);
    
} catch (Exception $exc) {

    echo $exc;
}
?>