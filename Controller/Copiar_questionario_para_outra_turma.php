<?php
session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Questionario.php';
include_once '../Model/Aluno.php';
$professor_id=$_SESSION['idfuncionario'];

$idquestionario = $_POST['idquestionario'];
$idquestionario_aux= $_POST['idquestionario'];
$idescola= $_POST['idescola'];
$hora_inicio= $_POST['hora_inicio'];
$hora_fim= $_POST['hora_fim'];
$url= $_POST['url_get'];





try {

foreach ($_POST['idturma'] as $key => $value) {
	$idturma= $_POST['idturma'][$key];

	$res_questionario=$conexao->query("SELECT * from questionario WHERE id=$idquestionario");
	
	foreach ($res_questionario as $key_questionario => $value_questionario) {
		$nome=$value_questionario['nome'];
		$data=$value_questionario['data'];
		$disciplina_id=$value_questionario['disciplina_id'];
		$turma_id=$value_questionario['turma_id'];

			$res_questionario_copiado=$conexao->query("SELECT * from questionario WHERE turma_id=$turma_id and  origem_questionario_id=$idquestionario");
			
			$conta=0;
			foreach ($res_questionario_copiado as $key_F => $value_F) {
				$idquestionario=$value_F['id'];
				$conta++;
			}

			if ($conta==0) {
				copiar_questionario($conexao,$nome,$data,$professor_id,$idturma,$disciplina_id,$idquestionario_aux);
				$idquestionario=$conexao->lastInsertId();
				$res=listar_aluno_da_turma_professor($conexao,$idturma,$idescola);
				foreach ($res as $key => $value) {
				    $idaluno=$value['idaluno'];
				    cadastrar_horario_individual_questionario($conexao,$hora_inicio,$hora_fim,$idaluno,$idquestionario);
				}
			}

	$res_questao=$conexao->query("SELECT * from questao WHERE questionario_id=$idquestionario");

		foreach ($res_questao as $key_questao => $value_questao) {
			$nome=$value_questao['nome'];
			$tipo=$value_questao['tipo'];
			$pontos=$value_questao['pontos'];
			$resposta_correta=$value_questao['resposta_correta'];


			$res_questionario_questao=$conexao->query("SELECT * from questao WHERE nome='$nome' and  questionario_id=$idquestionario");
			
			$conta_q=0;
			foreach ($res_questionario_questao as $key_F => $value_F) {
				$conta_q++;
			}
			if ($conta_q==0) {
				copiar_questao($conexao,$nome, $tipo, $pontos,$resposta_correta,$idquestionario);
			}

		}

	
	}


}


	$_SESSION['status']=1;
	header("Location:../View/cadastrar_questionario.php?$url");
} catch (Exception $e) {
	$_SESSION['status']=0;
	$_SESSION['mensagem']='Erro';
	echo "$e";
	//header("Location:../View/cadastrar_questionario.php?$url");
	
}
	 	
?>