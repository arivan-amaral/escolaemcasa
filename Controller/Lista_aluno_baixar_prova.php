<?php
include("../Model/Conexao.php");
include("../Model/Aluno.php");
include("../Model/Trabalho.php");
include("../Model/Questionario.php");

try {
$aluno = $_GET['aluno'];
$questionario = $_GET['questionario'];
$disciplina_id = $_GET['disciplina_id'];
$turma_id = $_GET['turma_id'];
$escola_id = $_GET['escola_id'];


$result=listar_aluno_da_turma_professor($conexao,$turma_id,$escola_id);

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
$return.="Pontos questão objetiva: $conta_pontos";

$return.="
	</td>	
	<td>
		<a href='ver_resultado_prova.php?turma_id=$turma_id&disciplina_id=$disciplina_id&questionario=$questionario&aluno=$idaluno' target='_blank'>VER PROVA<br></a> <br>

		<a href='baixar_prova_pdf.php?turma_id=$turma_id&disciplina_id=$disciplina_id&questionario=$questionario&aluno=$idaluno' target='_blank'>BAIXAR PDF<br></a>
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