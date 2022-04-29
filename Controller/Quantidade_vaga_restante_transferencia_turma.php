<?php 
session_start();
include_once '../Model/Conexao.php';
include_once '../Model/Turma.php';

try {
 $aceitar_idescola_destino=$_GET['aceitar_idescola_destino'];
 
 $aceitar_ano_letivo=$_GET['aceitar_ano_letivo'];
 $aceitar_turno=$_GET['aceitar_turno'];
 $aceitar_nova_turma=$_GET['aceitar_nova_turma'];


 

     $res_quantidade= quantidade_vaga_turma($conexao,$aceitar_idescola_destino,$aceitar_nova_turma,$aceitar_turno,$aceitar_ano_letivo);
     $quantidade_vaga_total=0;

     foreach ($res_quantidade as $key => $value) {
        $quantidade_vaga_total=$value['quantidade_vaga'];
     }


     $res_quantidade_vaga_restante= quantidade_aluno_na_turma($conexao,$aceitar_idescola_destino,$aceitar_nova_turma,$aceitar_turno,$aceitar_ano_letivo);

     $quantidade_vaga_restante=0;
     foreach ($res_quantidade_vaga_restante as $key => $value) {
        $quantidade_vaga_restante=$value['quantidade'];
     }
    $quantidade_vaga_restante=$quantidade_vaga_total-$quantidade_vaga_restante;

    echo"$quantidade_vaga_restante";
  
} catch (Exception $e) {
  echo "0";
}

?>