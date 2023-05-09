<?php session_start();
include_once '../Model/Conexao.php';
include_once '../Model/Coordenador.php';
include_once '../Model/Turma.php';
try {
  


  $idescola=$_GET['idescola'];
  $ano_letivo_vigente=$_SESSION['ano_letivo'];
 
    $res=lista_de_turmas_da_escola_relatorio($conexao,$idescola,$ano_letivo_vigente);

  $result="";
  $turno="";
    

  foreach ($res as $key => $value) {

     $idturma=$value['idturma'];
    // $idserie=$value['idserie'];
    // $seguimento=$value['seguimento'];

    // $nome_serie=$value['nome_serie'];
    $nome_turma=($value['nome_turma']);
    // $idescola=($value['idescola']);
    $nome_escola=($value['nome_escola']);
     $result.="<option value='$idturma'>$nome_turma</option>";
}

echo "$result";

} catch (Exception $e) {
  
}
