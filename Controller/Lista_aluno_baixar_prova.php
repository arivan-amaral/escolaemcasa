<?php
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
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
		$res_finalizado=$conexao->query("SELECT * FROM questionario_finalizado WHERE aluno_id=$idaluno and questionario_id=$questionario");
		$questionario_finalizado=0;
		foreach ($res_finalizado as $key => $value) {
		   $questionario_finalizado++;

		}
$return.="<b>Pontos questão objetiva: $conta_pontos </b><br>";
		if ($questionario_finalizado>0) {
				$return.="

				<span id='$idaluno'>
						<b class='text-primary'>O aluno finalizou o questionário</b><a class='btn btn-primary' onclick='liberar_questionario($idaluno,$questionario);'>LIBERAR QUESTIONÁRIO</a> 
				</span>

				<br>";
		}else{
				$return.="<b class='text-danger'>Questionário não finalizado.</b><br>";
		}


$return.="
	</td>	
	<td>
		<a href='ver_resultado_prova.php?turma_id=$turma_id&disciplina_id=$disciplina_id&questionario=$questionario&aluno=$idaluno' target='_blank'>VER PROVA RESPONDINDA<br></a> <br>

		<a href='baixar_prova_pdf.php?turma_id=$turma_id&disciplina_id=$disciplina_id&questionario=$questionario&aluno=$idaluno' target='_blank'>BAIXAR PROVA RESPONDINDA PDF<br></a>
<BR>
		<a href='baixar_prova_modelo_pdf.php?turma_id=$turma_id&disciplina_id=$disciplina_id&questionario=$questionario&aluno=$idaluno' target='_blank'>BAIXAR PROVA PARA IMPRESSÃO PDF<br></a>
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