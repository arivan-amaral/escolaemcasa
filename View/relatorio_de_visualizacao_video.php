<?php session_start();
 include("mpdf/mpdf60/mpdf.php");
 include_once '../Model/Conexao.php';
 include_once '../Model/Video.php';

 $idaluno=$_GET['idaluno'];
 $idturma=$_GET['idturma'];
 $iddisciplina=$_GET['iddisciplina'];
 $html="<h1>RELATÓRIO DE VISUALIZAÇÕES DE VÍDEOS</h1>";
 

 try {



 	$result_assistidos=listar_videos_assistidos($conexao,$idaluno,$iddisciplina,$idturma);
 	
 	$minutos=0;
 	$cont=0;
 	foreach ($result_assistidos as $key => $value) {
 		$idvideo=$value['idvideo'];
 		$titulo=($value['titulo']);
 		$nome_disciplina=($value['nome_disciplina']);
 		$minutos=$value['quantidade'];
 		if ($quantidade>0) {
 			$minutos=$minutos/2;
 		}

 		$html.="
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


 	
 } catch (Exception $e) {
 	
 }

 
 
 $mpdf=new mPDF(); 

 $mpdf->SetDisplayMode('fullpage');

 // $css = file_get_contents("css/estilo.css");

 // $mpdf->WriteHTML($css,1);

 $mpdf->WriteHTML($html);

 $mpdf->Output();
 // $mpdf->Output('teste.pdf');

 

 

 



exit;

?>