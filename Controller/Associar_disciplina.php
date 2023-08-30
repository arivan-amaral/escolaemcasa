<?php
	session_start();
    if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
    include("../Model/Turma.php");
    

try {
   	$turma_id=$_POST['turma'];
    $ano=$_SESSION['ano_letivo'];
   	$disciplina_id=$_POST['disciplina'];
   	$escola_id=$_POST['escola'];
   	$professor_id=$_SESSION['idprofessor'];
    associar_professor($conexao, $turma_id, $disciplina_id, $professor_id, $escola_id,$ano);

    $_SESSION['status']=1;
    header("location: ../View/minhas_turmas.php?status=1");
} catch (Exception $e) {
    $_SESSION['status']=0;
    header("location: ../View/minhas_turmas.php?status=0");
}
?>