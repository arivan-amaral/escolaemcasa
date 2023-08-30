<?php session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once 'Conversao.php';
include_once '../Model/Questionario.php';

try {


$texto_alternativa = escape_mimic($_GET['texto_alternativa']);
$origem_questionario_id = escape_mimic($_GET['origem_questionario_id']);
$questao_alternativa = escape_mimic($_GET['questao_alternativa']);
$id = $_GET['id'];

// $aluno_id=$_SESSION['idaluno'];
// $turma_id= $_GET['turma_id'];
// $disciplina_id = $_GET['disciplina_id'];
// $questao_id=$_GET['questao_id'];
 

	$pesquisa_alt=$conexao->query("SELECT alternativa_simulado.correta, alternativa_simulado.id as 'idalternativa' , alternativa_simulado.nome  FROM questao_simulado,alternativa_simulado WHERE 
		questao_simulado.nome like '%$questao_alternativa%' and 
		questao_id=questao_simulado.id and 
		alternativa_simulado.id =$id and
		 alternativa_simulado.origem_questionario_id='$origem_questionario_id' ");
	$resposta=1;
	$conta=0;
	foreach ($pesquisa_alt as $key => $value) {
		if ($value['correta']==0) {
			$resposta=1;
		}else{
			$resposta=0;
		}

		$idalternativa=$value['idalternativa'];
		$texto_alternativa=$value['nome'];
		$pesquisa=$conexao->exec("UPDATE alternativa_simulado set correta='$resposta' where id=$idalternativa ");
		$conta++;
	}
	if ($conta>0) {
		echo "certo";
	}else{
		echo "erro";
	}

} catch (Exception $e) {
	echo "erro: $e";
}
		
?>