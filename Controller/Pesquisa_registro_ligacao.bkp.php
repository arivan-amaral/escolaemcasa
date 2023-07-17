<?php 
session_start();
include_once '../Model/Conexao.php';
include_once '../Model/Escola.php';
include_once '../Model/Coordenador.php';
include_once 'Conversao.php';
try {
	
$result="";
$ano_letivo=$_SESSION['ano_letivo'];

$data_inicial=$_GET['data_inicial'];
$data_final=$_GET['data_final'];
$escola=$_GET['escola'];
$faltas=$_GET['quantidade_falta'];

if ($escola =='todas') {
	$escola=" and turma_escola >0 ";
}else{
	$escola=" and turma_escola = $escola ";

}
$res=$conexao->query("SELECT aluno.nome AS nome_aluno, COUNT(frequencia.presenca) AS quantidade_faltas
FROM aluno
JOIN ecidade_matricula ON aluno.idaluno = ecidade_matricula.aluno_id
LEFT JOIN (
    SELECT DATE_ADD('$data_inicial', INTERVAL (t4.i*10000 + t3.i*1000 + t2.i*100 + t1.i*10 + t0.i) DAY) AS data
    FROM
        (SELECT 0 AS i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) AS t0,
        (SELECT 0 AS i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) AS t1,
        (SELECT 0 AS i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) AS t2,
        (SELECT 0 AS i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) AS t3,
        (SELECT 0 AS i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) AS t4
    WHERE DATE_ADD('$data_inicial', INTERVAL (t4.i*10000 + t3.i*1000 + t2.i*100 + t1.i*10 + t0.i) DAY) <= '$data_final'
) AS dates ON dates.data = frequencia.data_frequencia
WHERE 
    aluno.idaluno = frequencia.aluno_id AND 
    aluno.idaluno = ecidade_matricula.aluno_id AND 
    ecidade_matricula.matricula_ativa = 'S' AND 
    ano_frequencia = '$ano_letivo' $escola AND
    (frequencia.presenca IS NULL OR frequencia.presenca != 1)
GROUP BY aluno.idaluno, frequencia.disciplina_id
HAVING COUNT(frequencia.presenca) >= $faltas
ORDER BY quantidade_faltas DESC;
"
);
foreach ($res as $key => $value) {
	$nome_aluno=$value['nome_aluno'];
	$quantidade_faltas=$value['quantidade_faltas'];

	$result.="<tr>";
	$result.="<td>$nome_aluno</td>";
	$result.="<td> <a  class='btn btn-success' >Registrar chamada</a> </td>";
	$result.="<td>$quantidade_faltas</td>";
	$result.="</tr>";
}
echo "$result";


} catch (Exception $e) {
echo "$e";	
}
 ?>