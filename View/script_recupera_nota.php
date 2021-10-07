<?php 
	include '../Model/Conexao.php';
	include '../Controller/Conversao.php';

	$res=$conexao->query("SELECT *  FROM nota_backup WHERE escola_id = 27 AND turma_id = 7032 AND disciplina_id = 1 AND periodo_id = 2 ");
	
		$conta=1;
	foreach ($res as $key => $value) {
		
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

		$conexao->exec("INSERT INTO nota(nota, avaliacao, parecer_disciplina_id, parecer_descritivo, sigla, escola_id, turma_id, disciplina_id, aluno_id, periodo_id, data_nota) 
			VALUES (

			$nota,
			'$avaliacao',
			$parecer_disciplina_id,
			'$parecer_descritivo',
			'$sigla',
			$escola_id,
			$turma_id,
			$disciplina_id,
			$aluno_id,
			$periodo_id,
			'$data_nota'
		)");


		$conta++;
	}

?>