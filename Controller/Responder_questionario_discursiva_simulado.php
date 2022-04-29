<?php session_start();
include_once '../Model/Conexao.php';
include_once '../Model/Questionario.php';
include_once 'Conversao.php';


 $resposta_discursiva = escape_mimic($_GET['texto']);
$alternativa_id = $_GET['idalternativa'];
$questao_id=$_GET['questao_id'];;
$aluno_id=$_SESSION['idaluno'];
// $turma_id= $_GET['turma_id'];
// $disciplina_id = $_GET['disciplina_id'];
$turma_id="";
// $disciplina_id = $_GET['disciplina_id'];
$cont=0;  


try {
	$pesquisa=pesquisar_resposta_discursiva_simulado($conexao,  $aluno_id,$questao_id);

	foreach ($pesquisa as $key => $value) {
		$id=$value['id'];
		alterar_resposta_discursiva_simulado($conexao, $resposta_discursiva, $alternativa_id,  $aluno_id,$id,$questao_id);
		
		
		$cont++;
	}
	
	if ($cont==0) {
		$result = cadastrar_resposta_discursiva_simulado($conexao, $resposta_discursiva, $alternativa_id, $aluno_id,$questao_id);
	
	}else {
	
	

		
	}
	echo "certo";
	
} catch (Exception $e) {
	echo "erro: $e";
}
		
?>