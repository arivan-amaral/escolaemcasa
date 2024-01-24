<?php 
session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Aluno.php';
try {
	$idescola=$_GET['idescola'];
	$idturma=$_GET['idturma'];
	$iddisciplina=$_GET['iddisciplina'];
	$idaluno=$_GET['idaluno'];
 	$ano_letivo=$_SESSION['ano_letivo'];
	cancelar_aprovar_concelho($conexao,$idescola,$idturma,$iddisciplina,$idaluno, $ano_letivo);
	echo "certo";
	 

} catch (Exception $e) {
	echo "$e";
}
?>