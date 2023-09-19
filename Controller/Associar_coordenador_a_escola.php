<?php
session_start();
    if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once"../Model/Coordenador.php";
    

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