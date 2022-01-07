<?php
session_start();
include "../Model/Conexao.php";
include "../Model/Turma.php";

try {
    $_SESSION['mensagem'] = "";
    $validar = 0;
    foreach ( $_POST['escola'] as $key => $value) {
        $escola = $_POST['escola'][$key];
        $serie= $_POST['idserie'][$key]; 
        $turma = $_POST['idturma'][$key];
        $ano = $_POST['ano'][$key];
        $turno = $_POST['turno'][$key];
        $vagas = $_POST['quantidade_vaga'][$key];

        $res = validar_turma_escola($conexao,$escola,$ano,$serie,$turma,$turno);
        foreach ($res as $key => $value) {
            $validar = $value['id'];
        }
            if($validar == 0){

                $_SESSION['status']=1;
                cadastrar_turma_escola($conexao,$escola,$turma,$turno,$ano,$vagas);
            }else{
                $_SESSION['mensagem'] = "Alguns cadastros já estão no sistema, eles não foram enviados para evitar duplicidade!";
                $_SESSION['status']=0;
            }
        }   
    
    header("location:../View/cadastro_turma_escola.php");
        
} catch (Exception $exc) {
    $_SESSION['mensagem'] = 'Erro, verifique os dados e tente novamente!';
    $_SESSION['status'] = 0;
   //header("location:../View/painel.php");
   echo $exc;
}
?>
