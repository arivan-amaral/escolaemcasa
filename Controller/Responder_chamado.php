<?php
session_start();
include "../Model/Conexao.php";
include "../Model/Chamada.php";
try {
	$data = date('Y-m-d H:i');
    $id_chamada = $_GET['id_chamado'];
    $idFuncionario=$_SESSION['idfuncionario'];
    responder_chamada($conexao,$id_chamada,$idFuncionario,$data);
    
} catch (Exception $exc) {

    //echo $exc;
}
?>