<?php
session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once "../Model/Turma.php";

try {
    $_SESSION['mensagem'] = "";
    
   
    $escola = $_GET['escola'];
    $turma = $_GET['turma'];
    $ano = $_GET['ano'];
    $id = $_GET['id'];
    $valor = $_GET['valor'];
    // $turno = $_GET['turno'];
  
 
    $quant = 0;
    $pesquisa = pesquisar_vagas($conexao,$id,$escola,$turma,$ano);
    foreach ($pesquisa as $key => $value) {
        $quant = $value['quantidade_vaga'];
        // $quantidade_vaga_total = $value['quantidade_vaga'];
    }

 

    //    $res_quantidade_vaga_restante= quantidade_aluno_na_turma($conexao,$escola,$turma,$turno,$ano);
    //    $quantidade_vaga_restante=0;
    //    foreach ($res_quantidade_vaga_restante as $key => $value) {
    //       $quantidade_vaga_restante=$value['quantidade'];
    //    }
    // $quantidade_vaga_restante=$quantidade_vaga_total-$quantidade_vaga_restante;


    alterar_vagas($conexao,$id,$escola,$turma,$ano,$valor);
          


    echo $quant; 
} catch (Exception $exc) {
   echo $exc;
}
?>
