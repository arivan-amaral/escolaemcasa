<?php 
include_once"../Model/Conexao.php";
include_once"../Model/Escola.php";
include_once"conteudos_registrados.php";

$idescola=$_GET['idescola'];
$idturma=$_GET['idturma'];
$idserie=$_GET['idserie'];
$nome_escola="";
$res=buscar_escola_por_id($conexao,$idescola);
foreach ($res as $key => $value) {
    $nome_escola=$value['nome_escola'];
}
$pes=listar_disciplina_da_turma($conexao,$idturma,$idescola);

foreach ($pes as $chave => $linha) {
  $nome_disciplina=($linha['nome_disciplina']);
  $iddisciplina=$linha['iddisciplina'];
  $nome_professor=$linha['nome'];
  $nome_turma=$linha['nome_turma'];
  diario_conteudo($conexao,$idescola,$idturma,$iddisciplina,$idserie,$nome_disciplina,$nome_professor,$nome_turma,$nome_escola); 
  echo" <br>";
}


 ?>