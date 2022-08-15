<?php
session_start();
include "../Model/Conexao.php";
include "../Model/Chamada.php";
try {

    $id_chamada = $_GET['id_chamado'];
    finalizar_chamada($conexao,$id_chamada);
    echo "certo";
} catch (Exception $exc) {

    echo $exc;
}
?>