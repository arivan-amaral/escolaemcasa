<?php session_start();
include_once '../Model/Conexao.php';
include_once '../Model/Coordenador.php';
include_once '../Model/Turma.php';
try {
  


  $idescola=$_GET['idescola'];
  $ano_letivo_vigente=$_SESSION['ano_letivo'];
 
    $res=lista_de_turmas_da_escola_relatorio($conexao,$idescola,$ano_letivo_vigente);

  $result="

      <div class='col-sm-3 '>";
  $turno="";
    

  foreach ($res as $key => $value) {

     $idturma=$value['idturma'];
    // $idserie=$value['idserie'];
    // $seguimento=$value['seguimento'];

    // $nome_serie=$value['nome_serie'];
    $nome_turma=($value['nome_turma']);
    // $idescola=($value['idescola']);
    $nome_escola=($value['nome_escola']);
     $result.="
      <input class='form-check-input idturma' type='checkbox' value='$idturma' id='idturma'>
          <label class='form-check-label' for='flexCheckDefault'>
            $nome_turma
          </label>
           ";
}

echo "$result </div>";

} catch (Exception $e) {
  
}
