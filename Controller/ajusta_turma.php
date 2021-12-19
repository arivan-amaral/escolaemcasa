<?php
include '../Model/Conexao.php';
// ajusta_turma.php
 // set_time_limit(0);
try {

foreach ($_POST['matricula_turma'] as $key => $value) {
    $matricula_turma=$_POST['matricula_turma'][$key];
    $turma_id=$_POST['turma_educalem'][$key];
    if ($turma_id !='') {
        $conexao->exec("UPDATE ecidade_matricula set turma_id=$turma_id where matricula_turma=$matricula_turma");
        // code...
    }
}

    echo "DEU CERTO ";
    
} catch (Exception $e) {
    echo "$e";
}