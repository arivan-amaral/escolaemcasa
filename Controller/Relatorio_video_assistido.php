<?php 
session_start();
include '../Model/Conexao.php';
include '../Model/Video.php';

$idaluno=$_GET['idaluno'];
$idturma=$_GET['idturma'];
$iddisciplina=$_GET['iddisciplina'];
$result="";
sleep(1);

try {
	// function converter_utf8($texto){
	//   $texto=str_replace('Ã¡', 'á', $texto);
	//   $texto= str_replace('Ã§', 'ç', $texto); 
	//   $texto= str_replace('Ã£', 'ã', $texto); 
	//   $texto= str_replace('Ã©', 'é', $texto);
	//   $texto= str_replace('Ã³', 'ó', $texto);
	//   return $texto;
	// }

	$result_assistidos=listar_videos_assistidos($conexao,$idaluno,$iddisciplina,$idturma);
	
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
					Idvideo: $idvideo<br>
					Disciplina: $nome_disciplina<br>
					Vídeo: $titulo<br>
					Minutos Assistidos: $minutos<br>
				</td>
			</tr>
		";
		$minutos=0;
		$cont++;
	}

	// if ($cont==0) {
	// 	$result="<b style='color: red'> Nada foi encontrado para essa ação...</b>";
	// }

	echo "$result";
	
} catch (Exception $e) {
	
}

?>