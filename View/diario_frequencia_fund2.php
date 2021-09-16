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
$fim=35;

$conta_aula=1;
$conta_data=1;

$limite_data=36;
$limite_aula=36;

$periodo_id=$_GET['periodo_id'];
$idserie=$_GET['idserie'];

$data_inicio_trimestre="";
$data_fim_trimestre="";

if ($periodo_id==1) {
    $data_inicio_trimestre="2021-05-03";
    $data_fim_trimestre="2021-07-09";
    
    // code...
}elseif ($periodo_id==2) {
    $data_inicio_trimestre="2021-07-27";
    $data_fim_trimestre="2021-10-01";
    // code...
}elseif ($periodo_id==3) {
    $data_inicio_trimestre="2021-10-04";
    $data_fim_trimestre="2021-12-21";
    // code...
}


diario_frequencia($conexao,$idescola,$idturma,$iddisciplina,$inicio,$fim,$conta_aula,$conta_data,$limite_data,$limite_aula,$periodo_id,$idserie,$data_inicio_trimestre,$data_fim_trimestre); 
echo"<BR>";
$inicio=35;
// $inicio=0;
$conta_aula=36;

$limite_data=18;
$limite_aula=18;
$fim= 52;
// $fim= 17;
// diario_frequencia_pagina_final($conexao,$idescola,$idturma,$iddisciplina,$inicio,$fim,$conta_aula,$conta_data,$limite_data,$limite_aula,$periodo_id,$idserie)

diario_frequencia_pagina_final($conexao,$idescola,$idturma,$iddisciplina,$inicio,$fim,$conta_aula+$inicio,$conta_data+$inicio,$limite_data+$inicio,$limite_aula+$inicio,$periodo_id,$idserie,$data_inicio_trimestre,$data_fim_trimestre);


 ?>