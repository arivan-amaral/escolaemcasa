<?php
session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Questionario.php';
include_once '../Model/Aluno.php';
include_once '../Model/Turma.php';


try {
	$funcionario_id=$_SESSION['idfuncionario'];

	$nome = $_POST['nome'];
	$idescola = $_POST['idescola'];
	$data = $_POST['data']." ".$_POST['hora_inicio'];
	$data_final = $_POST['data_final']." ".$_POST['hora_fim'];
	$idserie = $_POST['idserie'];

	$turma_id=0;
	$etapa=0;

	if (mb_strpos($idserie, '/') !== false) {
		$array_serie=explode('/', $idserie);
		$turma_id=$array_serie[0];
		$idserie=$array_serie[1];
		$etapa=$_POST['etapa'];
	}

	$origem_questionario_id = uniqid ( time () );
	$url = $_POST['url_get'];

	cadastrar_simulado($conexao,$idescola,$nome,$data,$data_final,$funcionario_id,$origem_questionario_id,$idserie,$turma_id,$etapa);

	$_SESSION['status']=1;
	header("Location:../View/cadastrar_simulado.php?$url&status=1");
} catch (Exception $e) {
	$_SESSION['status']=0;
	$_SESSION['mensagem']='Erro desconhecido';
	//header("Location:../View/cadastrar_simulado.php?$url&status=0");
	echo $e;
}

?>