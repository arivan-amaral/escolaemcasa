<?php
session_start();
include_once '../Model/Conexao.php';
include '../Model/Questionario.php';
// $nome = $_GET['nome'];
// $questionario_id = $_GET['questionario_id'];
// $origem_questionario_id = $_GET['origem_questionario_id'];
// $turma_id= $_GET['turma_id'];
// $disciplina_id = $_GET['disciplina_id'];
$id = $_GET['idescola'];
$idquestionario = $_GET['idquestionario'];
try {
	
	$conexao->exec("UPDATE questionario_simulado set escola_id=$id where id=$idquestionario");
	echo "certo";

} catch (Exception $e) {
	echo "erro";
	//$_SESSION['status']=0;
    //header("Location:../View/cadastrar_questionario.php");
}

?>