<?php
session_start();
    include("../Model/Conexao.php");
    include("../Model/Turma.php");
    

try {

$serie_id = $_GET["serie_id"];
$escola_id = $_GET["escola_id"];
$turno = $_GET["turno"];
$ano_letivo_vigente=$_SESSION['ano_letivo_vigente'];
$result="";

if (isset($_GET["rematricula"])){
    $result=lista_de_turmas_das_escolas($conexao,$serie_id,$escola_id,$turno,$ano_letivo_vigente);
    $return="<option></option>";
    foreach ($result as $key => $value) {
      $idturma=$value['idturma'];
      $nome_turma=$value['nome_turma'];
      $return.="<option value='$idturma'> $nome_turma</option>";
    }

}else{
  $result=lista_de_turmas_das_escolas($conexao,$serie_id,$escola_id,$turno,$ano_letivo_vigente);
  $return="
      <label for='exampleInputEmail1' class='text-danger'>Turma pretendida</label>
      <select class='form-control'  name='rematricula_turma' id='rematricula_turma'> 
        <option></option>";
  foreach ($result as $key => $value) {
    $idturma=$value['idturma'];
    $nome_turma=$value['nome_turma'];
    $return.="<option value='$idturma'> $nome_turma</option>";
  }

  $return.="</select>";
}
 

echo $return;
  
} catch (Exception $e) {
   // echo "Erro ao listar  $e";
}
?>

