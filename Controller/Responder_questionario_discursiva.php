<?php session_start();
include_once '../Model/Conexao.php';
include_once '../Model/Questionario.php';
include_once 'Conversao.php';


$resposta_discursiva = escape_mimic($_GET['texto']);
$alternativa_id = $_GET['id'];
$aluno_id=$_SESSION['idaluno'];
$turma_id= $_GET['turma_id'];
$disciplina_id = $_GET['disciplina_id'];
$questao_id=$_GET['questao_id'];
$cont=0;  


try {
	$pesquisa=pesquisar_resposta_discursiva($conexao,  $turma_id, $alternativa_id, $disciplina_id, $aluno_id,$questao_id);

	foreach ($pesquisa as $key => $value) {
		$id=$value['id'];
		alterar_resposta_discursiva($conexao, $resposta_discursiva,  $turma_id, $alternativa_id, $disciplina_id, $aluno_id,$id,$questao_id);
		
		$cont++;
	}
	
	if ($cont==0) {
		$result = cadastrar_resposta_discursiva($conexao, $resposta_discursiva,  $turma_id, $alternativa_id, $disciplina_id, $aluno_id,$questao_id);
	
	}else {
	
	

		
	}
	echo "certo";
	
} catch (Exception $e) {
	echo "erro";
}
		
?>