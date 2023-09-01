<?php
session_start();

if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";


try {
	$idaluno = $_GET['idaluno'];
	$idquestionario = $_GET['idquestionario'];
$conexao->exec("DELETE FROM questionario_finalizado WHERE aluno_id=$idaluno and questionario_id =$idquestionario");

echo"certo";	
} catch (Exception $e) {
	echo"erro";
}


?>