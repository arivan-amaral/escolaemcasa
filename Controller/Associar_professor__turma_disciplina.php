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
 $escola_id= $_POST['escola'];
 $disciplina_id= $_POST['disciplina'];
 $professor_id= $_POST['professor_id'];
 $ano_letivo_vigente= $_SESSION['ano_letivo'];
 

 $disciplina_ja_associada='';

foreach ($_POST['idturma'] as $key => $value) {
  if (isset($_POST['idturma'])) {
    $turma_id=$_POST['idturma'][$key];
    $conta_ministrada=0;

   if ($_POST['mesma_disciplpina'] !="sim") {

      $res_ministrada=$conexao->query("SELECT * FROM ministrada WHERE escola_id = $escola_id and turma_id=$turma_id and disciplina_id=$disciplina_id and ano=$ano_letivo_vigente");
      
        // code...
      foreach ($res_ministrada as $key => $value) {
        $conta_ministrada++;
      }
    }

    if ($conta_ministrada==0) {
      associar_professor($conexao, $turma_id, $disciplina_id, $professor_id, $escola_id,$ano_letivo_vigente);
    }else{
      $disciplina_ja_associada="Disciplina já esta associada a um professor: código disciplina($disciplina_id )".$conta_ministrada;
    }

  }
}

if ($disciplina_ja_associada=='') {

  $_SESSION['status']=1;
   header("location:../View/pesquisar_professor_associar.php");
  exit();
}else{

  $_SESSION['status']=2;
  $_SESSION['mensagem']=$disciplina_ja_associada;
   header("location:../View/pesquisar_professor_associar.php");
  exit();

}


} catch (Exception $e) {
    $_SESSION['status']=0;
    header("location:../View/pesquisar_professor_associar.php");
}
?>