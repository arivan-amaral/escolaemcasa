<?php 
include_once"../Controller/Conversao.php";
include_once"../Model/Conexao.php";
include_once"../Model/Coordenador.php";
include_once"../Model/Aluno.php";

include_once"diarioFrequencia.php";
include_once"diarioFrequenciaPaginaFinal.php";





$idescola=$_GET['idescola'];
$idturma=$_GET['idturma'];
$iddisciplina=$_GET['iddisciplina'];

$inicio=0;
$fim=37;

$conta_aula=1;
$conta_data=1;

$limite_data=37;
$limite_aula=37;

$periodo_id=$_GET['periodo_id'];
$idserie=$_GET['idserie'];

diario_frequencia($conexao,$idescola,$idturma,$iddisciplina,$inicio,$fim,$conta_aula,$conta_data,$limite_data,$limite_aula,$periodo_id,$idserie); 
echo"<BR>";
$inicio=36;
$limite_data=18;
$limite_aula=18;
$fim= 18;
// diario_frequencia_pagina_final($conexao,$idescola,$idturma,$iddisciplina,$inicio,$fim,$conta_aula,$conta_data,$limite_data,$limite_aula,$periodo_id,$idserie)

diario_frequencia_pagina_final($conexao,$idescola,$idturma,$iddisciplina,$inicio,$fim,$conta_aula+$inicio,$conta_data+$inicio,$limite_data+$inicio,$limite_aula+$inicio,$periodo_id,$idserie);


 ?>