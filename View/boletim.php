<?php 
  include"../Controller/Conversao.php";
  include"../Model/Conexao.php";
  include"../Model/Coordenador.php";
  include"boletim_serie_1ano_id_3.php";
  
$idescola=$_GET['idescola'];
$idturma=$_GET['idturma'];
$idserie=$_GET['idserie'];
$idaluno=67929;

 boletim($conexao,$idescola,$idturma,$idserie,$idaluno);

?>