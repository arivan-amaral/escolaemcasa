<?php
session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Mural.php';

$idmural=$_GET['idmural'];
$pagina=$_GET['pagina'];

try {

$array_url=explode('disc=', $_SERVER["REQUEST_URI"]);
 $url_get='disc='.$array_url[1];
 if ($url_get=='disc=') {
 	$url_get='#mural';

  }


	excluir_mural($conexao,$idmural);
	$_SESSION['status']=1;
	header("Location:../View/$pagina?$url_get");
} catch (Exception $e) {
	$_SESSION['status']=0;
	header("Location:../View/$pagina?$url_get");

}

?>