<?php 
session_start();
include_once '../Model/Conexao.php';
include_once '../Model/Escola.php';
include_once '../Model/Coordenador.php';
include_once 'Conversao.php';
try {
	
$result="";
$ano_letivo=$_SESSION['ano_letivo'];
 ;
$escola=$_GET['escola_id'];
$turma=$_GET['turma_id'];
 

if ($escola =='todas') {
	$escola=" and busca_ativa.escola_id >0 ";
}else{
	$escola=" and busca_ativa.escola_id = $escola ";

}

if ($turma =='todas') {
    $turma=" and busca_ativa.turma_id >0 ";
}else{
    $turma=" and busca_ativa.turma_id = $escola ";

}
    $result="<table>";
    $result.="<tbody>";
    $result.="<th>DADOS ALUNOS</th>";
    $result.="<th>QUANTIDADE DE FALTAS</th>";
    $result.="<th></th>";
    $result.="</tbody>";

$res=$conexao->query("SELECT aluno.nome as nome_aluno , quantidade_faltas FROM busca_ativa,escola,aluno,turma,funcionario WHERE
busca_ativa.escola_id = escola.idescola and 
busca_ativa.funcionario_id=funcionario.idfuncionario and 
busca_ativa.turma_id = turma.idturma and 
busca_ativa.aluno_id= aluno.idaluno $escola $turma ORDER by busca_ativa.id desc LIMIT 500");



foreach ($res as $key => $value) {
	$nome_aluno=$value['nome_aluno'];
	$quantidade_faltas=$value['quantidade_faltas'];

	$result.="<tr>";
	$result.="<td>$nome_aluno</td>";
	$result.="<td>$quantidade_faltas</td>";
	// $result.="<td> <a  class='btn btn-success' >Registrar chamada</a> </td>";
	$result.="</tr>";
}

    $result.="</tbody>";
    $result.="</table>";

echo "$result";


} catch (Exception $e) {
echo "$e";	
}
 ?>