<?php
session_start();
include '../Model/Conexao.php';
include '../Model/Questionario.php';
include '../Model/Aluno.php';
$professor_id=$_SESSION['idfuncionario'];

$nome = $_POST['nome'];
$data = $_POST['data'];
$turma_id= $_POST['turma_id'];
$disciplina_id = $_POST['disciplina_id'];
$idescola = $_POST['idescola'];
$turma = $_POST['turma'];
$disciplina = $_POST['disciplina'];
$hora_inicio = $_POST['hora_inicio'];
$hora_fim = $_POST['hora_fim'];

$url="turm=$turma_id&disc=$disciplina_id&turma=$turma&disciplina=$disciplina&idescola=$idescola";


try {
	cadastrar_questionario($conexao,$nome,$data,$professor_id,$turma_id,$disciplina_id);
	$idquestionario=$conexao->lastInsertId();

	$res=listar_aluno_da_turma_professor($conexao,$turma_id,$idescola);
	foreach ($res as $key => $value) {
	    $idaluno=$value['idaluno'];
	    cadastrar_horario_individual_questionario($conexao,$hora_inicio,$hora_fim,$idaluno,$idquestionario);
	}
	$_SESSION['status']=1;
	header("Location:../View/cadastrar_questionario.php?$url&status=1");
} catch (Exception $e) {
	$_SESSION['status']=0;
	//header("Location:../View/cadastrar_questionario.php?$url&status=0");
	
}
	 	
?>