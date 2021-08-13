<?php 
include_once"../Model/Conexao.php";
include_once"../Model/Escola.php";
include_once"parecere_descritivo_cheche.php";

$idescola=$_GET['idescola'];
$idturma=$_GET['idturma'];
$idserie=$_GET['idserie'];
$nome_escola="";
$res=buscar_escola_por_id($conexao,$idescola);
foreach ($res as $key => $value) {
    $nome_escola=$value['nome_escola'];
}
$nome_disciplina='';

  $res_alunos=listar_aluno_da_turma_coordenador($conexao,$idturma,$idescola);
  foreach ($res_alunos as $key => $value) {
    $idaluno=$value['idaluno'];
    $nome_aluno=$value['nome_aluno'];
    $nome_turma=$value['nome_turma'];
    parecere_descritivo_cheche($conexao,$idescola,$idturma,$idserie,$nome_disciplina,$nome_escola,$nome_aluno,$nome_turma,$idaluno); 
  echo" <br>";
  }



 ?>