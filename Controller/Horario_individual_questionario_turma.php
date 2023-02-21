<?php
session_start();
include_once '../Model/Conexao.php';
include_once '../Model/Questionario.php';
include_once '../Model/Aluno.php';

    $idquestionario=$_POST['idquestionario'];
    $escola_id=$_POST['escola_id'];

    $idturma=$_POST['idturma'];
    $hora_inicio=$_POST['hora_inicio'];
    $hora_fim=$_POST['hora_fim'];

    $nome_questionario=$_POST['nome_questionario'];
    $disciplina_id=$_POST['disciplina_id'];
    
// echo "$idquestionario<br>";
// echo "$idturma<br>";
// echo "$hora_inicio<br>";
// echo "$hora_fim<br>";



try {
  

    $res=listar_aluno_da_turma_professor($conexao,$idturma,$escola_id);
    foreach ($res as $key => $value) {
            $idaluno=$value['idaluno'];

            $resultado=verificar_horario_questionario_por_turma($conexao,$idaluno,$idquestionario);
            $cont=0;
            foreach ($resultado as $key => $value) {
                $cont++;
                alterar_horario_individual_questionario_turma($conexao,$hora_inicio,$hora_fim,$idquestionario);

            }

            if ($cont==0) {
                cadastrar_horario_individual_questionario($conexao,$hora_inicio,$hora_fim,$idaluno,$idquestionario);
            }

   
    }
    
$url="nome=$nome_questionario&id=$idquestionario&turma_id=$idturma&disciplina_id=$disciplina_id&idescola=$escola_id";

    $_SESSION['status']=1;
    header("location:../View/adicionar_horario_individual_questionario.php?$url");
} catch (Exception $e) {
    $_SESSION['status']=0;
    header("location:../View/adicionar_horario_individual_questionario.php?$url");
    // echo "$e";
}

?>