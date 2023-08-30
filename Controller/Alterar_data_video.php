<?php
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Video.php';

try {
	$data = $_GET['data'];
	$hora = $_GET['hora'];
	$idvideo = $_GET['idvideo'];
	$data.=" ".$hora.":00";
	$result = alterar_data_hora_video($conexao, $data, $idvideo);
	
} catch (Exception $e) {
	echo "
		Erro..
	";
}
		
?>