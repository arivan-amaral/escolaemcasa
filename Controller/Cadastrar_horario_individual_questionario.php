<?php
include '../Model/Conexao.php';
include '../Model/Questionario.php';
    $aluno_id=$_GET['idaluno'];

    $idquestionario=$_GET['idquestionario'];

    $hora_inicio=$_GET['hora_inicio'];
    $hora_fim=$_GET['hora_fim'];


try {
    
    $resultado_marcado=verificar_horario_questionario_por_turma($conexao,$aluno_id,$idquestionario);
    $cont=0;
    foreach ($resultado_marcado as $key => $value) {
    	$cont++;
    }

    if ($cont==0) {
		cadastrar_horario_individual_questionario($conexao,$hora_inicio,$hora_fim,$aluno_id,$idquestionario);
    }else{
        alterar_horario_individual_questionario($conexao,$hora_inicio,$hora_fim,$aluno_id,$idquestionario);
    }
	echo "certo";
} catch (Exception $e) {
    echo "erro";
	
}

?>