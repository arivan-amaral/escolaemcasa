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

$res=$conexao->query("SELECT a.nome AS nome_aluno, COUNT(f.presenca) AS quantidade_faltas
FROM aluno a
LEFT JOIN frequencia f ON a.idaluno = f.aluno_id
JOIN ecidade_matricula em ON a.idaluno = em.aluno_id
WHERE f.data_frequncia BETWEEN '$data_inicial' AND '$data_final'
AND em.matricula_ativa = 'S'
GROUP BY a.idaluno
HAVING COUNT(f.presenca) > 0
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