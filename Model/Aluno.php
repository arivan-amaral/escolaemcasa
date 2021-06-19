<?php
    function pesquisar_imagem_aluno($conexao, $id) {
    	$result=$conexao->query("SELECT * FROM imagem WHERE id_aluno=$id ");
    	return $result ;
	}

	function inserir_imagem_padrao_aluno($conexao,  $id) {
    	$conexao->exec("INSERT INTO imagem (id_aluno) values ($id) ");
	}

	function mudar_status_aluno($conexao, $status, $id) {
    	$result = $conexao->exec("UPDATE aluno SET status = '$status' WHERE idaluno = $id");
    	return $result;
	}

	function alterar_foto_aluno($conexao, $nome, $id) {
    	$result = $conexao->exec("UPDATE imagem SET nome = '$nome' WHERE id_aluno = $id");
    	return $result;
	}

	// *****************************************************************************************

	function cadastro_aluno($conexao,$nome, $email, $documento, $senha, $whatsapp,$sexo,$data_nascimento) {
	    $conexao->exec(" INSERT INTO aluno (nome, email, documento, senha, whatsapp,sexo,data_nascimento) values ('$nome', '$email', '$documento', '$senha', '$whatsapp','$sexo','$data_nascimento')");
	    return $conexao;
	}

	// function listar_video($conexao,$idturma,$iddisciplina,$data) {
	//     $result = $conexao->query("SELECT * FROM video where id_turma=$idturma and id_disciplina=$iddisciplina and data_visivel <='$data' order by data_visivel asc   ");
	//     return $result;
	// }



	function meus_dados_aluno($conexao,$idaluno){
		$res=$conexao->query("SELECT * FROM aluno where idaluno = $idaluno  ORDER by nome ASC");
		return $res;
	}	

	function dados_aluno($conexao,$idaluno){
		$res=$conexao->query("SELECT imagem.nome as 'foto', aluno.nome as 'nome',aluno.idaluno as 'idaluno', aluno.whatsapp, aluno.email,aluno.senha, aluno.whatsapp_responsavel FROM aluno,imagem where  id_aluno=idaluno and idaluno = $idaluno  ORDER by nome ASC");
		return $res;
	}
	
	function verificar_whatsapp($conexao,$idaluno){
		$res=$conexao->query("SELECT * FROM aluno where idaluno = $idaluno  ORDER by nome ASC");
		return $res;
	}


	function atualizar_dados_aluno($conexao,$nome,$email,$senha,$whatsapp, $whatsapp_responsavel, $idaluno){
		
		$res=$conexao->query("UPDATE aluno set email='$email', senha='$senha',whatsapp='$whatsapp', whatsapp_responsavel='$whatsapp_responsavel' where  idaluno = $idaluno");
		return $res;
	}


	function atualizar_whatsapp_aluno_responsavel($conexao,$whatsapp, $whatsapp_responsavel, $idaluno){
		
		$res=$conexao->query("UPDATE aluno set whatsapp='$whatsapp', whatsapp_responsavel='$whatsapp_responsavel' where  idaluno = $idaluno");
		return $res;
	}

	function listar_aluno_da_turma($conexao,$idturma){
		$res=$conexao->query("SELECT aluno.senha,aluno.email,aluno.nome as 'nome_aluno', aluno.idaluno, aluno.status as 'status_aluno', turma.nome_turma FROM aluno, ano_letivo,turma where turma_id=$idturma and aluno_id=idaluno and turma_id=idturma and aluno.status='Ativo' ORDER by nome ASC");
		return $res;
	}

	function listar_aluno_da_turma_coordenador($conexao,$idturma,$idescola){
		$res=$conexao->query("SELECT aluno.senha,aluno.email,aluno.nome as 'nome_aluno', aluno.idaluno, aluno.status as 'status_aluno', turma.nome_turma FROM aluno, ano_letivo,turma where turma_id=$idturma and aluno_id=idaluno and turma_id=idturma and escola_id=$idescola  ORDER by nome ASC");
		return $res;
	}

	function listar_aluno_da_turma_professor($conexao,$idturma,$escola_id){
		$res=$conexao->query("SELECT aluno.senha,aluno.email,aluno.nome as 'nome_aluno', aluno.idaluno, aluno.status as 'status_aluno', turma.nome_turma FROM aluno, ano_letivo,turma where turma_id=$idturma and aluno_id=idaluno and turma_id=idturma and escola_id=$escola_id and status='Ativo' ORDER by nome ASC");
		return $res;
	}

	function listar_disciplina_aluno($conexao,$idaluno){
		$res=$conexao->query("SELECT 
			disciplina.nome_disciplina,
			disciplina.iddisciplina,
			funcionario.nome as 'nome_professor',
			turma.idturma,
			turma.nome_turma
		 FROM turma, ano_letivo, aluno , escola, ministrada,disciplina,funcionario WHERE
		aluno.idaluno=ano_letivo.aluno_id AND
		turma.idturma=ano_letivo.turma_id AND
		escola.idescola=ano_letivo.escola_id AND

		ministrada.turma_id=turma.idturma AND
		ministrada.escola_id=escola.idescola AND
		ministrada.disciplina_id=disciplina.iddisciplina AND
		ministrada.professor_id=funcionario.idfuncionario AND
		aluno.idaluno = $idaluno");
		return $res;
	}
	
?>