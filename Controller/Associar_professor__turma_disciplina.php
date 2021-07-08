<?php
session_start();
    include("../Model/Conexao.php");
    include("../Model/Turma.php");
    

try {
 $escola_id= $_POST['escola'];
 $disciplina_id= $_POST['disciplina'];
 $professor_id= $_POST['professor_id'];

foreach ($_POST['idturma'] as $key => $value) {
  if (isset($_POST['idturma'])) {
    $turma_id=$_POST['idturma'][$key];
    associar_professor($conexao, $turma_id, $disciplina_id, $professor_id, $escola_id);
  }
}


  $_SESSION['status']=1;
   header("location:../View/pesquisar_professor_associar.php");
} catch (Exception $e) {
    $_SESSION['status']=0;
    header("location:../View/pesquisar_professor_associar.php");
}
?>