<?php
session_start();
include "../Model/Conexao.php";
include "../Model/Turma.php";

try {
  
    foreach ( $_POST['escola'] as $key => $value) {
        $escola = $_POST['escola'][$key];
        $serie= $_POST['idserie'][$key]; 
        $turma = $_POST['idturma'][$key];
        $ano = $_POST['ano'][$key];
        $turno = $_POST['turno'][$key];
        $vagas = $_POST['quantidade_vaga'][$key];

        cadastrar_turma_escola($conexao,$escola,$turma,$turno,$ano,$vagas);
        }   
          
    header("location:../View/cadastro_turma_escola.php");
        
} catch (Exception $exc) {
    $_SESSION['mensagem'] = 'beneficiario ja cadastrado no sistema!!!';
    $_SESSION['status'] = 0;
   //header("location:../View/painel.php");
   echo $exc;
}
?>
