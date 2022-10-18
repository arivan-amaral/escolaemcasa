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
    $valor = $_GET['valor'];
    //$vagas = $_GET['quantidade_vaga'];

    alterar_vagas($conexao,$id,$escola,$turma,$ano,$valor);
          
    $quant = 0;
    $pesquisa = pesquisar_vagas($conexao,$id,$escola,$turma,$ano);
    foreach ($pesquisa as $key => $value) {
        $quant = $value['quantidade_vaga'];
    }


    echo $quant; 
} catch (Exception $exc) {
   echo $exc;
}
?>
