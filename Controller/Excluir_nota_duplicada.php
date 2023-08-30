<?php
session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Questionario.php';
// $nome = $_GET['nome'];
// $questionario_id = $_GET['questionario_id'];
// $origem_questionario_id = $_GET['origem_questionario_id'];
// $turma_id= $_GET['turma_id'];
// $disciplina_id = $_GET['disciplina_id'];
try {
$id = $_GET['id'];
	
	$res=$conexao->query("SELECT * from nota_parecer WHERE idnota=$id");
	foreach ($res as $key => $value) {

		$idnota=$value['idnota'];
		$nota=$value['nota'];
		$avaliacao=$value['avaliacao'];
		$parecer_disciplina_id=$value['parecer_disciplina_id'];
		$parecer_descritivo=$value['parecer_descritivo'];
		$sigla=$value['sigla'];
		$escola_id=$value['escola_id'];
		$turma_id=$value['turma_id'];
		$disciplina_id=$value['disciplina_id'];
		$aluno_id=$value['aluno_id'];
		$periodo_id=$value['periodo_id'];
		$data_nota=$value['data_nota'];

		$conexao->exec("INSERT INTO nota_duplicada_excluida(idnota, nota, avaliacao, parecer_disciplina_id, parecer_descritivo, sigla, escola_id, turma_id, disciplina_id, aluno_id, periodo_id, data_nota) VALUES ($idnota, $nota, '$avaliacao', $parecer_disciplina_id, '$parecer_descritivo', '$sigla', $escola_id, $turma_id, $disciplina_id, $aluno_id, $periodo_id, '$data_nota')");
		
		
	}

			$conexao->exec("DELETE FROM nota_parecer where idnota=$id");


	//header("Location:../View/cadastrar_questionario.php");
	echo"certo";
} catch (Exception $e) {
	echo "erro: ".$e;
	//$_SESSION['status']=0;
    //header("Location:../View/cadastrar_questionario.php");
}

?>