<?php session_start();
require __DIR__.'/vendor/autoload.php';

include_once '../Model/Conexao.php';
include_once '../Model/Questionario.php';
include_once '../Model/Aluno.php';

$aluno = $_GET['aluno'];
$questionario = $_GET['questionario'];
// $disciplina_id = $_GET['disciplina_id'];
// $turma_id = $_GET['turma_id'];


use Dompdf\Dompdf;

use Dompdf\Options;

//INSTANCIA DE OPTIONS

$options = new Options();

$options->setChroot(__DIR__);

$options->setIsRemoteEnabled(true);

//INSTANCIA DE DOMPOF

$dompdf = new Dompdf($options);



try {
$html="";
if ($aluno!="" and $questionario !="") {
		
	 $res_aluno=meus_dados_aluno($conexao,$aluno);
	 $nome_aluno="";
	 foreach ($res_aluno as $key => $value) {
	 	$nome_aluno=$value['nome'];
	 }

	 
$html = "

   <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>
   <tr>

   <td>
          <img src='imagens/logo.png' width='100' height='100'>
        </td>

        <td style='left: 50px; font-size:14px;'>
          <h4> EDUCA LEM</h4>
        </td>
   </tr>
 </table><hr><br>
ALUNO (a): <B>$nome_aluno</B>
<BR>
<BR>
";
	$listar_respostas=listar_questao_simulado($conexao,$questionario);
	$conta=0;


	function converter_utf8($texto){
	  $texto=str_replace('Ã¡', 'á', $texto);
	  $texto= str_replace('Ã§', 'ç', $texto); 
	  $texto= str_replace('Ã£', 'ã', $texto); 
	  $texto= str_replace('Ã©', 'é', $texto);
	  $texto= str_replace('Ã³', 'ó', $texto);
	  $texto= str_replace('Ã', 'í', $texto);
	  $texto= str_replace('í“', 'Ó', $texto);
	  $texto= str_replace('Âº', 'º', $texto);
	  $texto= str_replace('íª', 'ê', $texto);
	      

	  return $texto;
	} 

	
	foreach ($listar_respostas as $key => $value) {
		$idquestao=$value['id'];
		$questao=converter_utf8($value['nome']);
        $questao=str_replace('^;', "'", $questao);
        
		$html.= "
		<p class='text-justify'> <b>$questao  </b></p>
		Resposta:
		         <div class='custom-control custom-radio'>
		         ";
				 $listar_alternativa=listar_resposta_alternativa_aluno_simulado($conexao,$idquestao,$aluno);

		         foreach ($listar_alternativa as $chave => $linha) {
		         	$alternativa_id=$linha['alternativa_id'];
		         	$resposta_discursiva=converter_utf8($linha['resposta_discursiva']);
		         	 $resposta_discursiva= str_replace("^;", "'", $resposta_discursiva);
		         		
		         		if ($resposta_discursiva!="") {
		         			$html.="<label class='text-green' for='customRadio$idquestao$conta' style='font-weight: bold; font-weight: 200; background-color:#D3D3D3' >
			          	    
		         				$resposta_discursiva
		         			
					          	</label><br>";
		         		}
		         		

			          			 $listar_multipla=listar_resposta_multipla_simulado_aluno($conexao,$idquestao,$aluno);
			          			 $marcada="";
			          	         foreach ($listar_multipla as $chave2 => $row) {
			          	         	$nome_alternativa=converter_utf8($row['nome']);
			          	         	$idalternativa=$row['id'];

			          	         	if ($alternativa_id==$idalternativa) {
			          	         		$html.="
			          	         		<span  class='text-success'>
				          					<label for='customRadio$idquestao$idalternativa' style='background-color:#D3D3D3'>
			          	         				$nome_alternativa
				          					
				          					</label>
				          				</span>
			          				
			          					<br>";

			          	         	}else{
			          	         		
				          	         	$html.="
			          					<label class='' for='customRadio$idquestao$idalternativa'>
			          					 $nome_alternativa
			          					</label><br>";
			          				}


			          	         }

					

		         }
		         
		      $html.="
		     </div>

		";

	$conta++;

	}

	
}	

$dompdf->load_html($html);

$dompdf->setPaper ('A4','portrail');

$dompdf->render();

//IMPRIME D CONTELIDO DO ARQUIVO PDF NA TELA 
// header ("Content-type: application/pdf");

// echo $dompdf->output();

$dompdf->stream($nome_aluno.".pdf");



} catch (Exception $e) {
	// echo "Erro: $e";
}

		

?>