<?php
set_time_limit(0);
include_once 'Model/Conexao.php';
try {
	$inicio=$_GET['inicio'];
	$fim=$_GET['fim'];

	$res=$conexao->query("SELECT * from ecidade_matricula where matricula_turma IS NOT NULL and turma_id IS NOT NULL group by matricula_turma LIMIT $inicio , $fim");

foreach ($res as $key => $value) {
	$matricula_turma=$value['matricula_turma'];
	$turma_id=$value['turma_id'];
	$conexao->exec("UPDATE ecidade_matricula set turma_id_anterior= $turma_id WHERE matricula_turmaant='$matricula_turma' and turma_id_anterior IS NOT NULL ");


}
} catch (Exception $e) {
	echo "$e";
}
