<?php 
include_once"../Model/Conexao.php";
include_once"rendimento.php";

$idescola=$_GET['idescola'];
$idturma=$_GET['idturma'];
$iddisciplina=$_GET['iddisciplina'];
$idserie=$_GET['idserie'];


rendimento($conexao,$idescola,$idturma,$iddisciplina,$idserie); 


 ?>