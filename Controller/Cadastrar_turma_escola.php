<?php
session_start();
include_once "../Model/Conexao.php";
include_once "../Model/Turma.php";

try {
    $_SESSION['mensagem'] = "";
    $validar = 0;
   
    $escola = $_GET['escola'];
    $serie= $_GET['serie']; 
    $turma = $_GET['turma'];
    $ano = $_GET['ano'];
    $turno = $_GET['turno'];
    $vagas = $_GET['quantidade_vaga'];

    $res = validar_turma_escola($conexao,$escola,$ano,$serie,$turma,$turno);
    foreach ($res as $key => $value) {
       $validar=$value['id'];
    }
    
    if($validar==0){
        cadastrar_turma_escola($conexao,$escola,$turma,$turno,$ano,$vagas);
    }else{
       echo"Alguns cadastros já estão no sistema, eles não foram enviados para evitar duplicidade! ".count($res);
      
    }
          
    
    //header("location:../View/cadastro_turma_escola.php");
    echo "certo"; 
} catch (Exception $exc) {
   
   //header("location:../View/painel.php");
   echo $exc;
}
?>
