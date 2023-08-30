<?php
session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once "../Model/Chamada.php";
try {

    $id_chamada = $_GET['id_chamado'];
    finalizar_chamada($conexao,$id_chamada);
    
} catch (Exception $exc) {

    echo $exc;
}
?>