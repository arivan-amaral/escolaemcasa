<?php session_start();
 include("../View/mpdf/mpdf60/mpdf.php");
 include_once '../Model/Conexao.php';
 include_once '../Model/Video.php';

 $idaluno=$_GET['idaluno'];
 $idturma=$_GET['idturma'];
 $iddisciplina=$_GET['iddisciplina'];
 $html="<h6>RELATÓRIO DE VISUALIZAÇÕES DE VÍDEOS</h6>";
 

 try {



 	$result_assistidos=listar_videos_assistidos($conexao,$idaluno,$iddisciplina,$idturma);
 	
 	$minutos=0;
 	$cont=0;
 	foreach ($result_assistidos as $key => $value) {
 		$idvideo=$value['idvideo'];
 		$titulo=($value['titulo']);
 		$nome_disciplina=($value['nome_disciplina']);
 		$minutos=$value['quantidade'];
 		// if ($minutos>0) {
 		// 	$minutos=$minutos/2;
 		// }

 		$html.="
 			<tr border='1'>
 				<td border='1'>
 					<br>
 					Idvideo: $idvideo<br>
 					Disciplina: $nome_disciplina<br>
 					<b class='text-primary'>Vídeo: $titulo</b><br>
 					<b> $minutos Minutos Assistidos</b><br>
 				</td>
 			</tr>
 		";
 		$minutos=0;
 		$cont++;
 	}

    if ($cont==0) {
       $html="<b style='color:red'> Nada encontrado.</b>";
    }

echo "$html";
 	
 } catch (Exception $e) {
 	echo "Erro";
 }

 
 
 // $mpdf=new mPDF(); 

 // $mpdf->SetDisplayMode('fullpage');

 // // $css = file_get_contents("css/estilo.css");

 // // $mpdf->WriteHTML($css,1);

 // $mpdf->WriteHTML($html);

 // $mpdf->Output();
 // // $mpdf->Output('teste.pdf');

 

 

 



exit;

?>