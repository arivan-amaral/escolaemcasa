<?php
session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Aluno.php';

$idprofessor=$_SESSION['idfuncionario'];
$conteudo_aula_id=$_GET['conteudo_aula_id'];
$local=$_GET['local'];


$array_url=explode('disc=', $_SERVER["REQUEST_URI"]);
 $url_get='disc='.$array_url[1];

try {

	excluir_frequencia_lancada($conexao,$conteudo_aula_id,$idprofessor);

	 $_SESSION['status']=1;
	 header("Location:../View/$local.php?$url_get");
} catch (Exception $e) {
//echo "$e";
	$_SESSION['status']=0;
	header("Location:../View/$local.php?$url_get");
}

?>