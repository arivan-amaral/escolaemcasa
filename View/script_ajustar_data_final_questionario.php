<?php 
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
date_default_timezone_set('America/Bahia');

$res=$conexao->query("SELECT * FROM questionario where data_fim IS NULL");
foreach ($res as $key => $value) {
	$id=$value['id'];
	$data=$value['data'];
	$data_fim=date("Y-m-d", strtotime('+7 days', strtotime("$data")));
	$conexao->exec("UPDATE questionario set data_fim='$data_fim' where id=$id");
	echo"$data => $data_fim";
}
 ?>