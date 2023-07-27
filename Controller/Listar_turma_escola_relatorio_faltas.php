<?php session_start();
include_once '../Model/Conexao.php';
include_once '../Model/Coordenador.php';
try {
  


  $idescola=$_GET['idescola'];
 
    $res=listar_turmas_inicial_coordenador($conexao,$idescola,$_SESSION['ano_letivo_vigente']);
 

  $result="";
  $turno="";
     $result.="<option value='Todas'>Todas</option>";

  foreach ($res as $key => $value) {

    $idturma=$value['idturma'];
    $idserie=$value['idserie'];
    $seguimento=$value['seguimento'];

    $nome_serie=$value['nome_serie'];
    $nome_turma=($value['nome_turma']);
    $idescola=($value['idescola']);
    $nome_escola=($value['nome_escola']);
     $result.="<option value='$idturma'>$nome_turma</option>";
}

echo "$result";

} catch (Exception $e) {
  
}
