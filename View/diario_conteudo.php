<?php 
include_once"../Model/Conexao.php";
include_once"../Model/Escola.php";
include_once"conteudos_registrados.php";


    $data_inicio_trimestre1="2021-05-03";
    $data_fim_trimestre1="2021-07-09";
    

    $data_inicio_trimestre2="2021-07-27";
    $data_fim_trimestre2="2021-10-01";

    $data_inicio_trimestre3="2021-10-04";
    $data_fim_trimestre3="2021-12-21";




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
  diario_conteudo($conexao,$idescola,$idturma,$iddisciplina,$idserie,$nome_disciplina,$nome_professor,$nome_turma,$nome_escola,$data_inicio_trimestre1,$data_fim_trimestre1,"I TRIMESTRE"); 
  echo "<br>";
  diario_conteudo($conexao,$idescola,$idturma,$iddisciplina,$idserie,$nome_disciplina,$nome_professor,$nome_turma,$nome_escola,$data_inicio_trimestre2,$data_fim_trimestre2,"II TRIMESTRE"); 
  echo" <br>";
}




 ?>