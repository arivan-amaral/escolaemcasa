<?php
session_start();
include_once"../Model/Conexao.php";
include"../Controller/Conversao.php";
include"../Model/Coordenador.php";
include"../Model/Aluno.php";
include_once"acompanhamento.php";

$idescola=$_GET['idescola'];
$idturma=$_GET['turm'];
$iddisciplina=$_GET['disc'];
$idserie=$_GET['idserie'];


acompanhamento($conexao,$idescola,$idturma,$iddisciplina,$idserie); 


 ?>