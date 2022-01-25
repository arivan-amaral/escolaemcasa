<?php
session_start();
include '../Model/Conexao.php';
include '../Model/Aluno.php';
 
$idaluno = $_GET['idaluno'];
try {
	excluir_questao($conexao, $idaluno);
	echo "Ação Concluída";
} catch (Exception $e) {
	echo "Erro ". $e;
}

?>