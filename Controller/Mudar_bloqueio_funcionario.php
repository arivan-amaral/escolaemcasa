<?php session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Escola.php';


try {
if (isset($_SESSION['idfuncionario'])) {

	$status = $_GET['status'];
	$funcionario_id = $_GET['idfuncionario'];
	$idcalendario = $_GET['idcalendario'];
	$funcionario_responsavel = $_SESSION['idfuncionario'];


		if ($status==1) {
			ativa_bloqueio_funcionario($conexao,$idcalendario,$funcionario_id,$funcionario_responsavel);
			echo "<b class='text-danger'>BLOQUEADO</b>";

		}elseif($status==0){
			desativa_bloqueio_funcionario($conexao,$idcalendario,$funcionario_id,$funcionario_responsavel,$status);
			echo "<b class='text-success'>LIBERADO</b>";

		}

 
}else{
	echo "<b class='text-danger'>Sem permissão, faça seu login</b>";
}

} catch (Exception $e) {
	echo "<b class='text-danger'>Erro</b>";
}

		

?>