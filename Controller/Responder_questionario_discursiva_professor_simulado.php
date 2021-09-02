<?php session_start();
include_once '../Model/Conexao.php';
include_once '../Model/Questionario.php';

try {

$texto_alternativa = $_GET['texto_alternativa'];
$origem_questionario_id = $_GET['origem_questionario_id'];
$id = $_GET['id'];

// $aluno_id=$_SESSION['idaluno'];
// $turma_id= $_GET['turma_id'];
// $disciplina_id = $_GET['disciplina_id'];
// $questao_id=$_GET['questao_id'];
 

	$pesquisa_alt=$conexao->query("SELECT * FROM alternativa_simulado WHERE id =$id and origem_questionario_id='$origem_questionario_id' ");
	$resposta=1;
	$conta=0;
	foreach ($pesquisa_alt as $key => $value) {
		if ($value['correta']==0) {
			$resposta=1;
		}else{
			$resposta=0;
		}

		$texto_alternativa=$value['nome'];
		$pesquisa=$conexao->exec("UPDATE alternativa_simulado set correta='$resposta' where nome='$texto_alternativa' and origem_questionario_id='$origem_questionario_id' ");
		$conta++;
	}
	if ($conta>0) {
		echo "certo";
	}else{
		echo "erro";
	}

} catch (Exception $e) {
	echo "erro";
}
		
?>