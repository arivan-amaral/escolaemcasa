<?php 
	include '../Model/Conexao.php';
	include '../Controller/Conversao.php';
    include("../Model/Aluno.php");

try {
	

	$res=$conexao->query("SELECT * FROM nota_backup WHERE nota != 0 AND avaliacao LIKE 'av3' AND escola_id = 162 AND turma_id = 6267 AND disciplina_id = 2 AND periodo_id = 1 and  sigla!='' GROUP BY parecer_disciplina_id, nota ");
	
		$conta=1;
	foreach ($res as $key => $value) {
		$aluno_id=$value['aluno_id'];
		$parecer_disciplina_id=$value['parecer_disciplina_id'];
		$nota=$value['nota'];
		$sigla=$value['sigla'];
		$parecer_descritivo=$value['parecer_descritivo'];

		      $avaliacao=$value['avaliacao'];
		      $parecer_disciplina_id=$value['parecer_disciplina_id'];
		      $parecer_descritivo=$value['parecer_descritivo'];

		      $escola_id=$value['escola_id'];
		      $turma_id=$value['turma_id'];
		      $disciplina_id=$value['disciplina_id'];
		      $aluno_id=$value['aluno_id'];
		      $periodo_id=$value['periodo_id'];
		      $data_nota=$value['data_nota'];

		// $verifica_duplicidade=verifica_sigla_nota_diario($conexao,,$idturma,$iddisciplina,$aluno_id,$periodo,'av3',$parecer_disciplina_id);
		$verifica_duplicidade=verifica_sigla_nota_diario($conexao,162,6267,2,$aluno_id,1,'av3',$parecer_disciplina_id);
		$conta_qnt_siglas=0;
		$parecer_disciplina_id=0;

		foreach ($verifica_duplicidade as $key => $value) {
		      $idnota_bd=$value['idnota'];
		      $nota_bd=$value['nota'];
		      $avaliacao_bd=$value['avaliacao'];
		      $parecer_disciplina_id_bd=$value['parecer_disciplina_id'];
		      $parecer_descritivo_bd=$value['parecer_descritivo'];
		      $sigla_bd=$value['sigla'];
		      $escola_id_bd=$value['escola_id'];
		      $turma_id_bd=$value['turma_id'];
		      $disciplina_id_bd=$value['disciplina_id'];
		      $aluno_id_bd=$value['aluno_id'];
		      $periodo_id_bd=$value['periodo_id'];
		      $data_nota_bd=$value['data_nota'];

		      $conexao->exec("
		           UPDATE nota SET
		           nota=$nota,
		           sigla='$sigla',
		           parecer_descritivo='$parecer_descritivo'
		           WHERE 
		           idnota =$idnota_bd
		           ");
		      echo "$idnota - $avaliacao - $nota <br>";
		      $conta_qnt_siglas++;

		}
		


		// if ($conta_qnt_siglas>=0) {
		if ($conta_qnt_siglas==0) {
		    cadastro_nota($conexao,$nota, 
		    $parecer_disciplina_id, $parecer_descritivo, $sigla,$escola_id, $turma_id, $disciplina_id, $aluno_id, $periodo_id, $data_nota,$avaliacao);
		   		      echo "$idnota_bd - $avaliacao - $nota <br>";

		}
		
		// $nota=$value['nota'];
		// $avaliacao=$value['avaliacao'];
		// $parecer_disciplina_id=$value['parecer_disciplina_id'];
		// $parecer_descritivo=$value['parecer_descritivo'];
		// $sigla=$value['sigla'];
		// $escola_id=$value['escola_id'];
		// $turma_id=$value['turma_id'];
		// $disciplina_id=$value['disciplina_id'];
		// $aluno_id=$value['aluno_id'];
		// $periodo_id=$value['periodo_id'];
		// $data_nota=$value['data_nota'];

		// $conexao->exec("INSERT INTO nota(nota, avaliacao, parecer_disciplina_id, parecer_descritivo, sigla, escola_id, turma_id, disciplina_id, aluno_id, periodo_id, data_nota) 
		// 	VALUES (

		// 	$nota,
		// 	'$avaliacao',
		// 	$parecer_disciplina_id,
		// 	'$parecer_descritivo',
		// 	'$sigla',
		// 	$escola_id,
		// 	$turma_id,
		// 	$disciplina_id,
		// 	$aluno_id,
		// 	$periodo_id,
		// 	'$data_nota'
		// )");


		$conta++;
	}
} catch (Exception $e) {
	echo $e;
}

?>