<?php 

    
function alterar_pergunta_discursiva($conexao, $texto_questao, $id){
	$return=$conexao->exec(" UPDATE questao set nome='$texto_questao' WHERE	id=$id ");
	return $return;
}


function adicionar_relatorio_questionario($conexao,$nota, $descricao, $arquivo, $disciplina_id, $turma_id, $aluno_id, $professor_id,$data_visivel){

	$result=$conexao->exec("INSERT INTO relatorio_questionario( nota, descricao, arquivo, disciplina_id, turma_id, aluno_id,professor_id,data_visivel) 
		VALUES ('$nota', '$descricao', '$arquivo', $disciplina_id, $turma_id, $aluno_id, $professor_id,'$data_visivel')");
		
		return $result;
}


function cancelar_questionario($conexao,$id){
	$result=$conexao->exec("DELETE FROM relatorio_questionario WHERE id = $id");
	return $result;
}


function cadastrar_resposta_discursiva($conexao, $resposta_discursiva,  $turma_id, $alternativa_id, $disciplina_id, $aluno_id,$questao_id){
	$return=$conexao->exec(" INSERT INTO resposta_questao( resposta_discursiva, turma_id, alternativa_id, disciplina_id, aluno_id, questao_id) VALUES ('$resposta_discursiva', $turma_id, $alternativa_id, $disciplina_id, $aluno_id, $questao_id)");
		
		return $return;
	}




function alterar_resposta_discursiva($conexao, $resposta_discursiva,  $turma_id, $alternativa_id, $disciplina_id, $aluno_id,$id,$questao_id){
	$return=$conexao->exec(" UPDATE resposta_questao set 
		resposta_discursiva='$resposta_discursiva',
	 turma_id=$turma_id,
	  alternativa_id=$alternativa_id, 
	  disciplina_id=$disciplina_id,
	   aluno_id='$aluno_id',
	   questao_id=$questao_id
	   WHERE
	   	id=$id
	   ");

		return $return;
}


function listar_relatorio_questionario_aluno($conexao, $id_aluno){
	$data_atual=date("Y-m-d");
	
	$result=$conexao->query("SELECT relatorio_questionario.id as 'idrelatorio_questionario', 
		relatorio_questionario.data as 'data', 
		relatorio_questionario.arquivo, aluno.nome as 'nome_aluno',
		 turma.nome_turma, disciplina.nome_disciplina
	 FROM relatorio_questionario,turma,disciplina,aluno,funcionario WHERE 
	 relatorio_questionario.turma_id=idturma AND
	 
	 relatorio_questionario.disciplina_id=iddisciplina AND

	 relatorio_questionario.aluno_id=idaluno AND
	 relatorio_questionario.professor_id=idfuncionario AND
	 aluno.status='Ativo' and

	relatorio_questionario.aluno_id=$id_aluno AND data_visivel <= '$data_atual' ");

	return $result;
}

function listar_relatorio_questionario($conexao, $professor_id, $turma_id, $disciplina_id ){
	$result=$conexao->query("SELECT relatorio_questionario.data_visivel ,relatorio_questionario.id as 'idrelatorio_questionario', 
		relatorio_questionario.data as 'data', 
		relatorio_questionario.arquivo, aluno.nome as 'nome_aluno',
		 turma.nome_turma, disciplina.nome_disciplina
	 FROM relatorio_questionario,turma,disciplina,aluno,funcionario WHERE 
	 relatorio_questionario.turma_id=idturma AND
	 
	 relatorio_questionario.disciplina_id=iddisciplina AND

	 relatorio_questionario.aluno_id=idaluno AND
	 relatorio_questionario.professor_id=idfuncionario AND

	relatorio_questionario.turma_id=$turma_id and
	   relatorio_questionario.disciplina_id=$disciplina_id and  
	   aluno.status='Ativo' and
	   relatorio_questionario.professor_id=$professor_id  ");
	return $result;
}


function pesquisar_resposta_discursiva($conexao, $turma_id, $alternativa_id, $disciplina_id, $aluno_id,$questao_id){
	$return=$conexao->query("SELECT * FROM resposta_questao WHERE 
	 turma_id=$turma_id and
	   disciplina_id=$disciplina_id and  
	   aluno_id=$aluno_id  and questao_id=$questao_id ");
		return $return;
	}




function verificar_horario_questionario_aluno($conexao,$idaluno,$hora_atual,$questionario_id){
		$return=$conexao->query("SELECT * FROM horario_individual_questionario WHERE horario_individual_questionario.aluno_id=$idaluno AND
		 '$hora_atual' >= horario_individual_questionario.hora_inicio  AND '$hora_atual' <= horario_individual_questionario.hora_fim and questionario_id=$questionario_id ");
		return $return;
	}



	function cadastrar_questionario($conexao,$nome,$data,$professor_id,$turma_id,$disciplina_id){
		$conexao->exec("INSERT INTO questionario(nome,data, professor_id,  turma_id, disciplina_id) 
			VALUES ('$nome','$data',$professor_id,$turma_id,$disciplina_id)");
	}

	function copiar_questionario($conexao,$nome,$data,$professor_id,$turma_id,$disciplina_id,$origem_questionario_id,$idescola){
		$conexao->exec("INSERT INTO questionario(nome,data, professor_id,  turma_id, disciplina_id,origem_questionario_id,escola_id) 
			VALUES ('$nome','$data',$professor_id,$turma_id,$disciplina_id,'$origem_questionario_id',$idescola)");
	}
	
	function cadastrar_questao($conexao,$nome, $tipo, $pontos,$questionario_id,$origem_questionario_id){
		$return[0]=$conexao->exec(
		"INSERT INTO questao(nome,tipo, pontos, questionario_id,origem_questionario_id) 
			VALUES ('$nome', '$tipo', $pontos,$questionario_id,'$origem_questionario_id')
		");
		$return[1]=$conexao->lastInsertId();
		return $return;
	}	

	function copiar_questao($conexao,$nome, $tipo, $pontos,$resposta_correta,$questionario_id){
		$return[0]=$conexao->exec(
		"INSERT INTO questao(nome,tipo, pontos, questionario_id,resposta_correta) 
			VALUES ('$nome', '$tipo', $pontos,$questionario_id,'$resposta_correta')
		");
		$return[1]=$conexao->lastInsertId();
		return $return;
	}


	
	function cadastrar_alternativa($conexao,$nome, $tipo, $questao_id,$origem_questionario_id){
		$return=$conexao->exec("INSERT INTO alternativa(nome, tipo, questao_id,origem_questionario_id) VALUES ('$nome', '$tipo', $questao_id,'$origem_questionario_id')");
	}
	function cadastrar_arquivo($conexao,$novoNome, $questao_id, $extensao,$origem_questionario_id){

		$return=$conexao->exec("INSERT INTO arquivo_questao(arquivo, questao_id,  extensao,origem_questionario_id) VALUES ('$novoNome',$questao_id,'$extensao','$origem_questionario_id')");
		
		return $return;
	}

	function alterar_data_questionario($conexao,$id,$data){
		$return=$conexao->exec("UPDATE questionario SET
		 data='$data' WHERE id=$id ");
	
		return $return;
	}


	function alterar_status_questionario($conexao,$id,$status){
		$return=$conexao->exec("UPDATE questionario SET
		 status=$status WHERE id=$id ");
		return $return;
	}


	function alterar_horario_individual_questionario($conexao,$hora_inicio,$hora_fim,$aluno_id,$idquestionario){
		$return=$conexao->exec("UPDATE horario_individual_questionario SET
		 hora_inicio='$hora_inicio',
		 hora_fim='$hora_fim'
		  WHERE 
		  aluno_id=$aluno_id and questionario_id=$idquestionario
		");
		
		return $return;
	}


	function alterar_horario_individual_questionario_turma($conexao,$hora_inicio,$hora_fim,$idquestionario){
		$conexao->exec("UPDATE horario_individual_questionario SET
		 hora_inicio='$hora_inicio',
		 hora_fim='$hora_fim'
		  WHERE 
		  questionario_id=$idquestionario
		");
		
		
	}

	function cadastrar_horario_individual_questionario($conexao,$hora_inicio,$hora_fim,$aluno_id,$idquestionario){
		$conexao->exec("
			INSERT INTO horario_individual_questionario(aluno_id, hora_inicio, hora_fim,questionario_id) VALUES ($aluno_id, '$hora_inicio', '$hora_fim',$idquestionario)
		");
		
	}

	
	function verificar_horario_questionario_por_turma($conexao,$idaluno,$idquestionario){
		$return=$conexao->query("SELECT * FROM horario_individual_questionario WHERE aluno_id=$idaluno and questionario_id=$idquestionario ");
		return $return;
	}
	
	// function verificar_horario_questionario_por_turma($conexao,$idquestionario){
	// 	$return=$conexao->query("SELECT * FROM horario_individual_questionario WHERE questionario_id=$idquestionario ");
	// 	return $return;
	// }

	function pesquisar_horario_agendado_questionario($conexao,$idaluno,$idquestionario){
		$return=$conexao->query("SELECT * FROM horario_individual_questionario WHERE aluno_id=$idaluno and questionario_id=$idquestionario  ");
		return $return;
	}







	function selecionar_questionario($conexao,$iddisciplina,$idturma){
		$return=$conexao->query("SELECT * FROM questionario WHERE disciplina_id=$iddisciplina and turma_id=$idturma ");
		return $return;
	} 
 

    function selecionar_questionario_data($conexao,$iddisciplina,$idturma,$data){
		$return=$conexao->query("SELECT * FROM questionario WHERE disciplina_id=$iddisciplina and turma_id=$idturma and data='$data' and status=1");
		return $return;
	}
	
	function listar_questionario_mesma_origem($conexao,$origem_questionario_id){
		$return=$conexao->query("SELECT *
		 FROM questionario,turma,disciplina WHERE
		 turma_id=idturma and
		 disciplina_id=iddisciplina and 
		  origem_questionario_id='$origem_questionario_id'");
		return $return;
	}


	function listar_questao($conexao,$questionario_id){
		$return=$conexao->query("SELECT * FROM questao WHERE questionario_id=$questionario_id");
		return $return;
	}

	function listar_questao_aluno($conexao,$questionario_id){
		$return=$conexao->query("SELECT * FROM questao WHERE questionario_id=$questionario_id");
		return $return;
	}



	function listar_resposta_alternativa_aluno($conexao,$idquestao,$aluno_id){
		$return=$conexao->query("SELECT * FROM resposta_questao WHERE questao_id=$idquestao and aluno_id=$aluno_id");
		return $return;
	}


	// function listar_resposta_multipla_aluno($conexao,$alternativa_id){
	// 	$return=$conexao->query("SELECT * FROM alternativa WHERE id=$alternativa_id and tipo <> 'discursiva' ");
	// 	return $return;
	// }

	function listar_resposta_multipla_aluno($conexao,$idquestao){
		$return=$conexao->query("SELECT * FROM alternativa WHERE questao_id=$idquestao and tipo <> 'discursiva' ");
		return $return;
	}
	


	function listar_alternativa($conexao,$idquestao){
		$return=$conexao->query("SELECT * FROM alternativa WHERE questao_id=$idquestao");
		return $return;
	}


	function listar_arquivo($conexao,$idquestao){
		$return=$conexao->query("SELECT * FROM arquivo_questao WHERE questao_id=$idquestao");
		return $return;
	}

	function listar_questionario_ativo($conexao,$id_funcionario,$turma_id,$disciplina_id){
		$return=$conexao->query("SELECT * FROM questionario WHERE 
			professor_id=$id_funcionario and 
			turma_id=$turma_id and
			disciplina_id=$disciplina_id and status=1");
// 	status=1 and

		return $return;
	}

	function listar_questionario($conexao,$id_funcionario,$turma_id,$disciplina_id){
		$return=$conexao->query("SELECT * FROM questionario WHERE 
			professor_id=$id_funcionario and 
			turma_id=$turma_id and
			disciplina_id=$disciplina_id");
// 	status=1 and

		return $return;
	}

	function excluir_questao($conexao, $id) {
	    $result = $conexao->query("DELETE FROM questao WHERE id=$id");
	    return $result;
	}	

	function excluir_questao_por_id_questionario($conexao, $id) {
	    $result = $conexao->query("DELETE FROM questao WHERE id=$id");
	    return $result;
	}
	function excluir_questionario($conexao, $id) {
	    $result = $conexao->query("DELETE FROM questionario WHERE id=$id");
	    return $result;
	}



?>
