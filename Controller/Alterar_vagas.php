<?php
session_start();
include "../Model/Conexao.php";
include "../Model/Turma.php";

try {
    $_SESSION['mensagem'] = "";
    
   
    $escola = $_GET['escola'];
    $turma = $_GET['turma'];
    $ano = $_GET['ano'];
    $id = $_GET['id'];
    //$vagas = $_GET['quantidade_vaga'];
    $quant = 0;
    $pesquisa = pesquisar_vagas($conexao,$id,$escola,$turma,$ano);
    foreach ($pesquisa as $key => $value) {
        $quant = $value['quantidade_vaga'];
    }
    $aumentar = $quant+1; 
    alterar_vagas($conexao,$id,$escola,$turma,$ano,$aumentar);
          
    
    //header("location:../View/cadastro_turma_escola.php");
    echo $aumentar; 
} catch (Exception $exc) {
   
   //header("location:../View/painel.php");
   echo $exc;
}
?>
