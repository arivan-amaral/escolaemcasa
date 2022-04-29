<?php 
session_start();
include '../Model/Conexao.php';
include '../Model/Video.php';

$idaluno=$_GET['idaluno'];

$result="";
sleep(1);

try {
	

	$result_assistidos=listar_videos_assistidos_coordenador($conexao,$idaluno);
	
	$minutos=0;
	$cont=0;
	foreach ($result_assistidos as $key => $value) {
		$idvideo=$value['idvideo'];
		$titulo=($value['titulo']);
		$nome_disciplina=($value['nome_disciplina']);
		$minutos=$value['quantidade'];
		
		if ($minutos>0) {
			$minutos=$minutos/2;
		}

		$result.="
			<tr>
				<td>
					<br>
					Idvideo: <b>$idvideo</b><br>
					Disciplina: <b>$nome_disciplina</b><br>
					Vídeo: <b> $titulo</b><br>
					Minutos Assistidos: <b> $minutos</b><br>
				</td>
			</tr>
		";
		$minutos=0;
		$cont++;
	}

	if ($cont==0) {
		$result="<b style='color: red'> Nada foi encontrado para essa ação...</b>";
	}

	echo "$result";
	
} catch (Exception $e) {
	echo "erro";
}

?>