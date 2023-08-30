<?php session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Aluno.php';

$id=$_GET['id'];
$status=$_GET['status'];
	try {
		if ($status==1) {
			$status="Ativo";
		}else{
			$status="Desativado";
		}
		
		mudar_status_aluno($conexao, $status, $id);
		echo "sucesso";
	} catch (Exception $e) {
		echo "erro";
	}

?>