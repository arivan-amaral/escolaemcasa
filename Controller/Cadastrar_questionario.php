<?php
session_start();
include_once '../Model/Conexao.php';
include '../Model/Questionario.php';
include '../Model/Aluno.php';
include '../Model/Turma.php';


try {
	$professor_id=$_SESSION['idfuncionario'];

	$nome = $_POST['nome'];
	$data = $_POST['data'];
	$data_final = $_POST['data_final'];
// $escola_turma_disciplina = $_POST['escola_turma_disciplina_idserie'];


	$origem_questionario_id = uniqid ( time () );

// $turma_id= $_POST['turma_id'];
// $disciplina_id = $_POST['disciplina_id'];
// $idescola = $_POST['idescola'];
// $turma = $_POST['turma'];
// $disciplina = $_POST['disciplina'];
	$hora_inicio = $_POST['hora_inicio'];
	$hora_fim = $_POST['hora_fim'];
	$url = $_POST['url_get'];

//$url="turm=$turma_id&disc=$disciplina_id&turma=$turma&disciplina=$disciplina&idescola=$idescola";


	foreach ($_POST['escola_turma_disciplina'] as $key => $value) {
		$escola_turma_disciplina=$_POST['escola_turma_disciplina'][$key];

		$array_url=explode('+', $escola_turma_disciplina);
		$idescola=$array_url[0];
		$turma_id=$array_url[1];
		$iddisciplina=$array_url[2];
		$idserie=$array_url[3];

		copiar_questionario($conexao,$nome,$data,$professor_id,$turma_id,$iddisciplina,$origem_questionario_id,$idescola,$data_final);

		// $conexao->exec("INSERT INTO questionario_simulado(nome,data, professor_id,  turma_id, disciplina_id,origem_questionario_id,escola_id,data_fim) 
		// 	VALUES ('$nome','$data',$professor_id,$turma_id,$disciplina_id,'$origem_questionario_id',$idescola,'$data_final')");
		$idquestionario=$conexao->lastInsertId();

		$res=listar_aluno_da_turma_professor($conexao,$turma_id,$idescola);
		foreach ($res as $key => $value) {
			$idaluno=$value['idaluno'];
			cadastrar_horario_individual_questionario($conexao,$hora_inicio,$hora_fim,$idaluno,$idquestionario);
		}

	}

	$_SESSION['status']=1;
	header("Location:../View/cadastrar_questionario.php?$url&status=1");
} catch (Exception $e) {
	$_SESSION['status']=0;
	$_SESSION['mensagem']='Erro desconhecido';
	header("Location:../View/cadastrar_questionario.php?$url&status=0");
	
}

?>