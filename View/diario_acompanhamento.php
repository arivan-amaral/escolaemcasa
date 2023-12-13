<?php
session_start();
include_once"../Model/Conexao.php";
include"../Controller/Conversao.php";
include"../Model/Coordenador.php";
include"../Model/Aluno.php";
include_once"acompanhamento.php";

$idescola=$_GET['idescola'];
$idturma=$_GET['turm'];
// $iddisciplina=$_GET['disc'];
$iddisciplina=1;
$idserie=$_GET['idserie'];

 $res_seg=$conexao->query("SELECT * FROM turma WHERE idturma=$idturma LIMIT 1");
   $seguimento='';
 $nome_turma="";
 foreach ($res_seg as $key => $value) {
   $nome_turma=$value['nome_turma'];
   $seguimento=$value['seguimento'];
   // code...
 }
try {
    acompanhamento($conexao,$idescola,$idturma,$iddisciplina,$idserie,$_SESSION['ano_letivo'],$seguimento); 
    
} catch (Exception $e) {
    echo "$e";
}


 ?>