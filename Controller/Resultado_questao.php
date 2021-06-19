<?php session_start();
include_once '../Model/Conexao.php';
include_once '../Model/Questionario.php';


$aluno = $_GET['aluno'];
$questionario = $_GET['questionario'];
$disciplina_id = $_GET['disciplina_id'];
$turma_id = $_GET['turma_id'];
sleep(1); 

try {

if ($aluno!="" and $questionario !="") {
		
	
	$listar_respostas=listar_questao_aluno($conexao,$questionario);
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

		echo "
		<p class='text-justify'> <b> $questao </b></p>
		Resposta:
		         <div class='custom-control custom-radio'>
		         ";
				 $listar_alternativa=listar_resposta_alternativa_aluno($conexao,$idquestao,$aluno);

		         foreach ($listar_alternativa as $chave => $linha) {
		         	$alternativa_id=$linha['alternativa_id'];
		         	$resposta_discursiva=converter_utf8($linha['resposta_discursiva']);
		         		
		         		if ($resposta_discursiva!="") {
		         			echo"<label class='text-green' for='customRadio$idquestao$conta' style='font-weight: bold; font-weight: 200;'> 
		         			$resposta_discursiva
					          	</label><br>";
		         		}
		         		

			          			 $listar_multipla=listar_resposta_multipla_aluno($conexao,$idquestao,$aluno);
			          			 $marcada="";
			          	         foreach ($listar_multipla as $chave2 => $row) {
			          	         	$nome_alternativa=converter_utf8($row['nome']);
			          	         	$idalternativa=$row['id'];

			          	         	if ($alternativa_id==$idalternativa) {
			          	         		echo"
			          	         		<span  class='text-success'>
				          					<label for='customRadio$idquestao$idalternativa' >
				          						 $nome_alternativa
				          					</label>
				          				</span>
			          				
			          					<br>";

			          	         	}else{
			          	         		
				          	         	echo"
			          					<label class='' for='customRadio$idquestao$idalternativa'>
			          					 $nome_alternativa
			          					</label><br>";
			          				}


			          	         }

					

		         }
		         
		      echo"
		     </div>

		";

	$conta++;

	}

	
}	

} catch (Exception $e) {
	echo "Erro: $e";
}

		

?>