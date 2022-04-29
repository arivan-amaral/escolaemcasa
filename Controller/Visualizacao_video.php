<?php
include_once '../Model/Conexao.php';
include_once '../Model/Video.php';
$conn=$conexao;
$idvideo=$_GET['idvideo'];
$idaluno=$_GET['id_aluno'];
try {
	$res_video=$conexao->query("SELECT * FROM visualizacao_video where video_id=$idvideo and aluno_id=$idaluno");
	$cont=0;
	foreach ($res_video as $key => $value) {
		$res=$conexao->exec("UPDATE visualizacao_video set minuto=minuto+1 where video_id=$idvideo and aluno_id=$idaluno");
		$cont++;
		break;
	}
	if ($cont==0) {
		$result=visualizacao_video($conn,$idvideo,$idaluno);
	}



} catch (Exception $e) {
	
}
		


?>