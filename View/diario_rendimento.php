<?php
session_start();
include_once"../Model/Conexao.php";
include_once"rendimento.php";

$idescola=$_GET['idescola'];
$idturma=$_GET['idturma'];
$iddisciplina=$_GET['iddisciplina'];
$idserie=$_GET['idserie'];
$ano_letivo=$_SESSION['ano_letivo'];

$res_pro=listar_nome_professor_turma_por_disciplina($conexao,$idturma,$iddisciplina,$idescola,$ano_letivo);
$nome_professor='';
foreach ($res_pro as $key => $value) {
    $nome_professor=$value['nome_professor'];
}
rendimento($conexao,$idescola,$idturma,$iddisciplina,$idserie,$nome_professor); 


 ?>