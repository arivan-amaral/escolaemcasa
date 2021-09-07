<?php
include("../Model/Conexao.php");


try {
	$idaluno = $_GET['idaluno'];
	$idquestionario = $_GET['idquestionario'];
$conexao->exec("DELETE FROM questionario_finalizado WHERE aluno_id=$idaluno and questionario_id =$idquestionario");

echo"certo";	
} catch (Exception $e) {
	echo"erro";
}


?>