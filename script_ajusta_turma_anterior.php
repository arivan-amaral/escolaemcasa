<?php
set_time_limit(0);
include 'Model/Conexao.php';
try {
	$res=$conexao->query("SELECT * from ecidade_matricula where matricula_turma IS NOT NULL and turma_id IS NOT NULL group by matricula_turma");

foreach ($res as $key => $value) {
	$matricula_turma=$value['matricula_turma'];
	$turma_id=$value['turma_id'];
	$conexao->exec("UPDATE ecidade_matricula set turma_id_anterior= $turma_id WHERE matricula_turmaant='$matricula_turma' ");


}
} catch (Exception $e) {
	echo "$e";
}
