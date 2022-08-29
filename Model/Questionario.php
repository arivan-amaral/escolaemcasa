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


function cadastrar_resposta_discursiva_simulado($conexao, $resposta_discursiva, $alternativa_id, $aluno_id,$questao_id){
	$return=$conexao->exec(" INSERT INTO resposta_questao_simulado( resposta_discursiva, alternativa_id,  aluno_id, questao_id) VALUES ('$resposta_discursiva', $alternativa_id, $aluno_id, $questao_id)");
		

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


function alterar_resposta_discursiva_simulado($conexao, $resposta_discursiva, $alternativa_id, $aluno_id,$id,$questao_id){
	$return=$conexao->exec(" UPDATE resposta_questao_simulado set 
		resposta_discursiva='$resposta_discursiva',
	  alternativa_id=$alternativa_id,
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

function pesquisar_resposta_discursiva_simulado($conexao, $aluno_id,$questao_id){
	$return=$conexao->query("SELECT * FROM resposta_questao_simulado WHERE  
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

	function copiar_questionario($conexao,$nome,$data,$professor_id,$turma_id,$disciplina_id,$origem_questionario_id,$idescola,$data_final){
		$conexao->exec("INSERT INTO questionario(nome,data, professor_id,  turma_id, disciplina_id,origem_questionario_id,escola_id,data_fim) 
			VALUES ('$nome','$data',$professor_id,$turma_id,$disciplina_id,'$origem_questionario_id',$idescola,'$data_final')");
	}	


	function cadastrar_simulado($conexao,$idescola,$nome,$data,$data_final,$funcionario_id,$origem_questionario_id,$idserie,$turma_id,$etapa){
		$conexao->exec("INSERT INTO questionario_simulado(escola_id,nome,data,data_fim, funcionario_id,origem_questionario_id,serie_id,turma_id,etapa_id) 
			VALUES ($idescola,'$nome','$data','$data_final',$funcionario_id,'$origem_questionario_id',$idserie,$turma_id,$etapa)");
	}
	
	function cadastrar_questao_simulado($conexao,$nome, $tipo, $pontos,$questionario_id,$origem_questionario_id){
		$return[0]=$conexao->exec(
		"INSERT INTO questao_simulado(nome,tipo, pontos, questionario_id,origem_questionario_id) 
			VALUES ('$nome', '$tipo', $pontos,$questionario_id,'$origem_questionario_id')
		");
		$return[1]=$conexao->lastInsertId();
		return $return;
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


	
	function cadastrar_alternativa_simulado($conexao,$nome, $tipo, $questao_id,$origem_questionario_id){
		$return=$conexao->exec("INSERT INTO alternativa_simulado(nome, tipo, questao_id,origem_questionario_id) VALUES ('$nome', '$tipo', $questao_id,'$origem_questionario_id')");
	}	

	function cadastrar_alternativa($conexao,$nome, $tipo, $questao_id,$origem_questionario_id){
		$return=$conexao->exec("INSERT INTO alternativa(nome, tipo, questao_id,origem_questionario_id) VALUES ('$nome', '$tipo', $questao_id,'$origem_questionario_id')");
	}
	function cadastrar_arquivo($conexao,$novoNome, $questao_id, $extensao,$origem_questionario_id){

		$return=$conexao->exec("INSERT INTO arquivo_questao(arquivo, questao_id,  extensao,origem_questionario_id) VALUES ('$novoNome',$questao_id,'$extensao','$origem_questionario_id')");
		
		return $return;
	}	

	function cadastrar_arquivo_simulado($conexao,$novoNome, $questao_id, $extensao,$origem_questionario_id){

		$return=$conexao->exec("INSERT INTO arquivo_questao_simulado(arquivo, questao_id,  extensao,origem_questionario_id) VALUES ('$novoNome',$questao_id,'$extensao','$origem_questionario_id')");
		
		return $return;
	}

	function alterar_data_questionario($conexao,$id,$data,$data_final){
		$return=$conexao->exec("UPDATE questionario SET
		 data='$data',data_fim='$data_final' WHERE id=$id ");
	
		return $return;
	}
	function alterar_data_simulado($conexao,$id,$data,$data_final){
		$return=$conexao->exec("UPDATE questionario_simulado SET
		 data='$data',data_fim='$data_final' WHERE id=$id ");
	
		return $return;
	}


	function alterar_status_questionario($conexao,$id,$status){
		$return=$conexao->exec("UPDATE questionario SET
		 status=$status WHERE id=$id ");
		return $return;
	}

	function alterar_status_questionario_simulado($conexao,$id,$status){
		$return=$conexao->exec("UPDATE questionario_simulado SET
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







	function listar_simulado($conexao,$idserie,$sql_escola){
		$return=$conexao->query("SELECT * FROM questionario_simulado WHERE serie_id= $idserie   $sql_escola ) ");
		return $return;
	 } 

	// function listar_simulado($conexao,$idserie,$idprofessor){
	// 	$return=$conexao->query("SELECT * FROM questionario_simulado WHERE serie_id= $idserie and funcionario_id=$idprofessor ");
	// 	return $return;
	// } 


	function selecionar_questionario($conexao,$iddisciplina,$idturma){
		$return=$conexao->query("SELECT * FROM questionario WHERE disciplina_id=$iddisciplina and turma_id=$idturma ");
		return $return;
	} 
 

    function selecionar_questionario_data($conexao,$iddisciplina,$idturma,$data,$questionario_id){
		$return=$conexao->query("SELECT * FROM questionario WHERE disciplina_id=$iddisciplina and turma_id=$idturma and data='$data' and id=$questionario_id and status=1");
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


	function listar_questao_simulado($conexao,$questionario_id){
		$return=$conexao->query("SELECT * FROM questao_simulado WHERE questionario_id=$questionario_id");
		return $return;
	}	
	
	function listar_questao($conexao,$questionario_id){
		$return=$conexao->query("SELECT * FROM questao WHERE questionario_id=$questionario_id");
		return $return;
	}		

	function listar_questao_por_id($conexao,$questao_id){
		$return=$conexao->query("SELECT * FROM questao WHERE id=$questao_id");
		return $return;
	}		

	function listar_questao_simulado_por_id($conexao,$questao_id){
		$return=$conexao->query("SELECT * FROM questao_simulado WHERE id=$questao_id");
		return $return;
	}	

	function listar_questao_resultado($conexao,$questionario_id){
		$return=$conexao->query("SELECT * FROM questao WHERE (tipo='multipla' or tipo='multipla_justificada') and questionario_id=$questionario_id");
		return $return;
	}	
	function listar_questao_resultado_simulado($conexao,$questionario_id){
		$return=$conexao->query("SELECT * FROM questao_simulado WHERE (tipo='multipla' or tipo='multipla_justificada') and questionario_id=$questionario_id");
		return $return;
	}

	function listar_questao_aluno($conexao,$questionario_id){
		$return=$conexao->query("SELECT * FROM questao WHERE questionario_id=$questionario_id");
		return $return;
	}



	function listar_alternativa_ver_prova($conexao,$idquestao){
		$return=$conexao->query("SELECT * FROM alternativa WHERE questao_id=$idquestao");
		return $return;
	}

	function listar_resposta_alternativa_aluno($conexao,$idquestao,$aluno_id){
		$return=$conexao->query("SELECT * FROM resposta_questao WHERE questao_id=$idquestao and aluno_id=$aluno_id");
		return $return;
	}

	function listar_resposta_alternativa_aluno_simulado($conexao,$idquestao,$aluno_id){
		$return=$conexao->query("SELECT * FROM resposta_questao_simulado WHERE questao_id=$idquestao and aluno_id=$aluno_id");
		return $return;
	}


	// function listar_resposta_multipla_aluno($conexao,$alternativa_id){
	// 	$return=$conexao->query("SELECT * FROM alternativa WHERE id=$alternativa_id and tipo <> 'discursiva' ");
	// 	return $return;
	// }

	function listar_resposta_multipla_aluno($conexao,$idquestao){
		$return=$conexao->query("SELECT * FROM alternativa WHERE questao_id=$idquestao and tipo != 'discursiva' ");
		return $return;
	}
		function listar_resposta_multipla_simulado_aluno($conexao,$idquestao){
		$return=$conexao->query("SELECT * FROM alternativa_simulado WHERE questao_id=$idquestao and tipo != 'discursiva' ");
		return $return;
	}
	


	function listar_alternativa_simulado($conexao,$idquestao){
		$return=$conexao->query("SELECT * FROM alternativa_simulado WHERE questao_id=$idquestao");
		return $return;
	}


	function listar_alternativa($conexao,$idquestao){
		$return=$conexao->query("SELECT * FROM alternativa WHERE questao_id=$idquestao");
		return $return;
	}




	function listar_alternativa_resposta($conexao,$idquestao){
		$return=$conexao->query("SELECT * FROM alternativa WHERE correta=1 and questao_id=$idquestao");
		return $return;
	}

	function listar_alternativa_resposta_correta_simulado($conexao,$idquestao){
		$return=$conexao->query("SELECT * FROM alternativa_simulado WHERE correta=1 and questao_id=$idquestao");
		return $return;
	}


	function listar_arquivo_simulado($conexao,$idquestao){
		$return=$conexao->query("SELECT * FROM arquivo_questao_simulado WHERE questao_id=$idquestao");
		return $return;
	}

	function listar_arquivo($conexao,$idquestao){
		$return=$conexao->query("SELECT * FROM arquivo_questao WHERE questao_id=$idquestao");
		return $return;
	}

	function listar_questionario_ativo($conexao,$escola_id,$turma_id,$disciplina_id){
		$return=$conexao->query("SELECT * FROM questionario WHERE 
			escola_id=$escola_id and 
			turma_id=$turma_id and
			disciplina_id=$disciplina_id and status=1");
// 	status=1 and

		return $return;
	}	


	function listar_simulado_ativo($conexao,$idserie,$escola_id){
		$return=$conexao->query("SELECT * FROM questionario_simulado WHERE 
			escola_id=$escola_id and
			serie_id=$idserie and status=1");
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

	function listar_questionario_professor($conexao,$escola_id,$turma_id,$disciplina_id){
		$return=$conexao->query("SELECT * FROM questionario WHERE 
			escola_id=$escola_id and 
			turma_id=$turma_id and
			disciplina_id=$disciplina_id");
// 	status=1 and

		return $return;
	}

	// function excluir_questao($conexao, $id) {
	//     $result = $conexao->query("DELETE FROM questao WHERE id=$id");
	//     return $result;
	// }		
	function excluir_questao_simulado($conexao, $id) {
	    $result = $conexao->query("DELETE FROM questao_simulado WHERE id=$id");
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
	function excluir_questionario_simulado($conexao, $id) {
	    $result = $conexao->query("DELETE FROM questionario_simulado WHERE id=$id");
	    return $result;
	}



?>
