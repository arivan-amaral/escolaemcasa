<?php
session_start();
    if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
    include("../Model/Turma.php");
    

try {

$serie_id = $_GET["serie_id"];
$escola_id = $_GET["escola_id"];
$turno = $_GET["turno"];
$ano_letivo_vigente=$_SESSION['ano_letivo_vigente'];
$turma_id=0;

if (isset($_GET['turma_id'])) {
  $turma_id=$_GET['turma_id'];
}

$result="";

if (isset($_GET["rematricula"])){
    $result=lista_de_turmas_das_escolas_rematricula($conexao,$serie_id,$escola_id,$turno,$ano_letivo_vigente);
    $return="<option></option>";
    foreach ($result as $key => $value) {
      $idturma=$value['idturma'];
      $nome_turma=$value['nome_turma'];
      $return.="<option value='$idturma'> $nome_turma</option>";
    }
   $res_quantidade= quantidade_vaga_turma($conexao,$escola_id,$turma_id,$turno,$ano_letivo_vigente);
   $quantidade_vaga_total=0;
   foreach ($res_quantidade as $key => $value) {
      $quantidade_vaga_total=$value['quantidade_vaga'];
   }


   $res_quantidade_vaga_restante= quantidade_aluno_na_turma($conexao,$escola_id,$turma_id,$turno,$ano_letivo_vigente);
   $quantidade_vaga_restante=0;
   foreach ($res_quantidade_vaga_restante as $key => $value) {
      $quantidade_vaga_restante=$value['quantidade'];
   }
$quantidade_vaga_restante=$quantidade_vaga_total-$quantidade_vaga_restante;

  $return.="|#|$quantidade_vaga_total|#|$quantidade_vaga_restante";

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
     echo"|#|0|#|0";

}
?>

