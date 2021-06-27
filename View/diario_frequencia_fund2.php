<?php 
include_once"../Model/Conexao.php";
include_once"diarioFrequencia.php";

$idescola=$_GET['idescola'];
$idturma=$_GET['idturma'];
$iddisciplina=$_GET['iddisciplina'];
$inicio=0;
$fim=17;
$conta_aula=1;
$conta_data=1;
$limite_data=18;
$limite_aula=18;
$periodo_id=1;
diario_frequencia($conexao,$idescola,$idturma,$iddisciplina,$inicio,$fim,$conta_aula,$conta_data,$limite_data,$limite_aula,$periodo_id); 
echo"<BR>";
diario_frequencia($conexao,$idescola,$idturma,$iddisciplina,17,$fim,$conta_aula+17,$conta_data+17,$limite_data+17,$limite_aula+17,$periodo_id);


 ?>