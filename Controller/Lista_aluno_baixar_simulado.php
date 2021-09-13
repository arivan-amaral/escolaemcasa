<?php
include("../Model/Conexao.php");
include("../Model/Aluno.php");
include("../Model/Trabalho.php");
include("../Model/Questionario.php");

try {
$aluno = $_GET['aluno'];
$questionario = $_GET['questionario'];

$escola_id = $_GET['escola_id'];
$idserie = $_GET['serie_id'];


$result=listar_aluno_do_simulado_professor($conexao,$escola_id,$idserie);
$return="

<table class='table table-bordered'>

  <thead>
    <tr>
      <th>Aluno</th>
      <th>Opção</th>
    </tr>
  </thead>

  <tbody>
";
foreach ($result as $key => $value) {
$idaluno=$value['idaluno'];
$idturma=$value['idturma'];
$nome=$value['nome_aluno'];

$return.="
<tr>
	<td>
		<b>$nome<br></b> <br>";


		$listar_questao=listar_questao_resultado($conexao,$questionario);
		$conta=1;
		$conta_pontos=0;
		foreach ($listar_questao as $key2 => $value2) {
		  	$idquestao=$value2['id'];
			$pontos=$value2['pontos'];
			$listar_alternativa=listar_alternativa_resposta($conexao,$idquestao);
			foreach ($listar_alternativa as $chave => $linha) {
			    $idalternativa=$linha['id'];
			    $correta=$linha['correta'];
				$res_alt=$conexao->query("SELECT * FROM resposta_questao where resposta_discursiva='' and aluno_id=$idaluno and questao_id=$idquestao and alternativa_id=$idalternativa");
				foreach ($res_alt as $key => $value) {
					$conta_pontos+=$pontos;
				}
			
			}
		} 
		$res_finalizado=$conexao->query("SELECT * FROM questionario_simulado_finalizado WHERE aluno_id=$idaluno and questionario_id=$questionario");
		$questionario_finalizado=0;
		foreach ($res_finalizado as $key => $value) {
		   $questionario_finalizado++;

		}
$return.="<b>Pontos questão objetiva: $conta_pontos </b><br>";
		if ($questionario_finalizado>0) {
				$return.="

				<span id='$idaluno'>
						<b class='text-primary'>O aluno finalizou o questionário</b>
						<!-- a class='btn btn-primary' onclick='liberar_questionario($idaluno,$questionario);'>LIBERAR QUESTIONÁRIO</a --> 
				</span>

				<br>";
		}else{
				$return.="<b class='text-danger'>Questionário não finalizado.</b><br>";
		}


$return.="
	</td>	
	<td>
		<a href='ver_resultado_simulado.php?turma_id=$idturma&questionario=$questionario&aluno=$idaluno' target='_blank'>VER RESPOSTA DO SIMULADO</a>
		 <br>
		 <br>

		<a href='baixar_simulado_modelo_pdf.php?turma_id=$idturma&questionario=$questionario&aluno=$idaluno' target='_blank'>BAIXAR SIMULADO PARA IMPRESSÃO</a>
		<br>
		<br>

		<a href='baixar_simulado_pdf.php?turma_id=$idturma&questionario=$questionario&aluno=$idaluno' target='_blank'>BAIXAR SIMULADO RESPONDIDO PDF</a>
		<br>
		<br>
	</td>

</tr>

";

}
$return.=" <tbody>
</table>
";
echo $return;

} catch (Exception $e) {
echo "Erro desconhecido";
}
?>