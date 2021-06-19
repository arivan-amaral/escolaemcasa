<?php
session_start();
include '../Model/Conexao.php';
include '../Model/Questionario.php';
$nome = $_GET['nome'];
$questionario_id = $_GET['questionario_id'];
$turma_id= $_GET['turma_id'];
$disciplina_id = $_GET['disciplina_id'];
$id = $_GET['id'];
try {
	
	$res=excluir_questao($conexao,$id);
	$_SESSION['status']=1;
	header("Location:../View/adicionar_questao.php?id=$questionario_id&turm=$turma_id&disc=$disciplina_id&nome=$nome");

} catch (Exception $e) {
	$_SESSION['status']=0;
    header("Location:../View/adicionar_questao.php?id=$questionario_id&turm=$turma_id&disc=$disciplina_id&nome=$nome");
}

?>