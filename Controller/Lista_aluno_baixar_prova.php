<?php
include("../Model/Conexao.php");
include("../Model/Aluno.php");
include("../Model/Trabalho.php");

try {
$aluno = $_GET['aluno'];
$questionario = $_GET['questionario'];
$disciplina_id = $_GET['disciplina_id'];
$turma_id = $_GET['turma_id'];
$escola_id = $_GET['escola_id'];


$result=listar_aluno_da_turma_professor($conexao,$turma_id,$escola_id);

$return="";
foreach ($result as $key => $value) {
$id=$value['idaluno'];
$nome=$value['nome_aluno'];

$return.="<a href='baixar_prova_pdf.php?turma_id=$turma_id&disciplina_id=$disciplina_id&questionario=$questionario&aluno=$id'>
$nome<br></a> <br>";

}

echo $return;

} catch (Exception $e) {
echo "Erro desconhecido";
}
?>