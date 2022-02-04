<?php
session_start();
    include("../Model/Conexao.php");
    include("../Model/Coordenador.php");
    

try {
 $coordenador_id= $_POST['coordenador_id'];
 $ano= $_SESSION['ano_letivo'];
 limpar_associacao($conexao,$coordenador_id);

foreach ($_POST['escola_id'] as $key => $value) {
   $escola_id= $_POST['escola_id'][$key];
   associar_coordenador_a_escola($conexao,  $coordenador_id,$escola_id,$ano);
}

  $_SESSION['status']=1;
   header("location:../View/pesquisar_coordenador_associar.php");
} catch (Exception $e) {
    $_SESSION['status']=0;
    header("location:../View/pesquisar_coordenador_associar.php");
}
?>