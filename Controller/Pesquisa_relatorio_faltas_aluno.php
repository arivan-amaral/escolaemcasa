<?php 
include_once '../Model/Conexao.php';
include_once '../Model/Escola.php';
include_once '../Model/Coordenador.php';
include_once 'Conversao.php';
try {
	
$result="";
$data_inicial=$_GET['data_inicial'];
$data_final=$_GET['data_final'];
$escola=$_GET['escola'];

$res=$conexao->query("SELECT aluno.nome AS nome_aluno, COUNT(frequncia.presenca) AS quantidade_faltas
FROM aluno,ecidade_matricula,frequncia
WHERE 
aluno.idaluno = frequncia.aluno_id and 
aluno.idaluno = ecidade_matricula.aluno_id and 
data_frequncia BETWEEN '$data_inicial' AND '$data_final'
AND ecidade_matricula.matricula_ativa = 'S' and turma_escola= $escola
GROUP BY aluno.idaluno
HAVING COUNT(frequncia.presenca) > 0
ORDER BY quantidade_faltas desc"
);
foreach ($res as $key => $value) {
	$nome_aluno=$value['nome_aluno'];
	$quantidade_faltas=$value['quantidade_faltas'];

	$result.="<tr";
	$result.="<td>$nome_aluno</td>";
	$result.="<td>$quantidade_faltas</td>";
	$result.="/<tr";
}
echo "$result";
} catch (Exception $e) {
echo "$e";	
}
 ?>