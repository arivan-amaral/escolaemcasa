<?php
include_once '../Model/Conexao.php';
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