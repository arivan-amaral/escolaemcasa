<?php
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Questionario.php';
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