<?php 

	function pesquisar_imagem_coordenador($conexao, $id) {
    	$result=$conexao->query("SELECT * FROM imagem WHERE id_funcionario=$id ");
    	return $result ;
	}

	function pesquisar_coordenador($conexao, $pesquisa) {
    	$result=$conexao->query("SELECT * FROM funcionario WHERE (descricao_funcao like 'Coordenador' or descricao_funcao like 'Coordenadora' or descricao_funcao like 'Secretário') and  nome like '%$pesquisa%' order by nivel_acesso_id desc , nome asc ");
    	return $result ;
	}	

	function escola_associada($conexao,$idfuncionario){
    	$result=$conexao->query("SELECT * FROM funcionario,relacionamento_funcionario_escola,escola WHERE relacionamento_funcionario_escola.escola_id =escola.idescola and relacionamento_funcionario_escola.funcionario_id = funcionario.idfuncionario  AND  
			idfuncionario=$idfuncionario ");
    	return $result ;
	}	

	function excluir_coordenador($conexao,$id){
    	$conexao->exec("DELETE FROM relacionamento_funcionario_escola where funcionario_id=$id");
    	$conexao->exec("DELETE FROM funcionario where idfuncionario=$id");
    	
	}	

	function verificacao_de_associacao($conexao,$idfuncionario,$escola_id){
    	$result=$conexao->query("SELECT * FROM funcionario,relacionamento_funcionario_escola,escola WHERE relacionamento_funcionario_escola.escola_id =escola.idescola and relacionamento_funcionario_escola.funcionario_id = funcionario.idfuncionario  AND  
			idfuncionario=$idfuncionario and escola_id=$escola_id ");
    	return $result ;
	}	

	function limpar_associacao($conexao,$idfuncionario){
    	$result=$conexao->query("DELETE FROM relacionamento_funcionario_escola where 
			funcionario_id=$idfuncionario");
    	return $result ;
	}


	function inserir_imagem_padrao_coordenador($conexao,  $coordenador_id, $escola_id) {
    	$conexao->exec("INSERT INTO imagem (id_funcionario) values ($id) ");
	}
	function associar_coordenador_a_escola($conexao,  $funcionario_id,$escola_id) {
    	$conexao->exec("INSERT INTO relacionamento_funcionario_escola (funcionario_id,escola_id) values ($funcionario_id,$escola_id) ");
	}

// *************************************************************************************************

	function cadastro_coordenador($conexao,$nome, $email, $descricao_funcao,$whatsapp, $senha){
		$conexao->exec("INSERT INTO funcionario( nome, email, descricao_funcao,whatsapp, senha) 
			VALUES ('$nome', '$email', '$descricao_funcao','$whatsapp', '$senha') ");
		
	}
	function dados_coordenador($conexao,$idcoordenador){
		$res=$conexao->query("SELECT imagem.nome as 'foto', funcionario.nome as 'nome' FROM funcionario,imagem where  id_funcionario=idfuncionario and idfuncionario = $idcoordenador");
		return $res;
	}
	
	function listar_disciplina_coordenador($conexao,$idcoordenador){
	    $res=$conexao->query("SELECT * FROM turma,  escola, ministrada,disciplina,funcionario WHERE
                          ministrada.turma_id=turma.idturma AND
                          ministrada.escola_id=escola.idescola AND
                          ministrada.disciplina_id=disciplina.iddisciplina AND
                          ministrada.coordenador_id=funcionario.idfuncionario AND
                          funcionario.idfuncionario = $idcoordenador  ORDER by nome_disciplina desc ");

		return $res;
	}	

	function listar_disciplina_da_turma($conexao,$idturma,$idescola){
	    $res=$conexao->query("SELECT turma.nome_turma, disciplina.iddisciplina,disciplina.nome_disciplina, funcionario.nome FROM turma, ministrada,disciplina, funcionario WHERE 
	    	funcionario.idfuncionario= ministrada.professor_id AND
	    	disciplina.iddisciplina=ministrada.disciplina_id AND ministrada.turma_id=turma.idturma AND turma.idturma = $idturma and escola_id=$idescola ORDER by nome_disciplina ASC");

		return $res;
	}


	function listar_escola_por_serie_ministrada($conexao,$iddisciplina,$idserie){
	    $res=$conexao->query("SELECT * FROM
serie,escola,turma,ministrada,disciplina
WHERE 
ministrada.escola_id = escola.idescola AND
ministrada.turma_id = turma.idturma AND
serie.id= turma.serie_id AND
ministrada.disciplina_id = disciplina.iddisciplina AND
serie.id=$idserie AND
disciplina.iddisciplina= $iddisciplina");

		return $res;
	}


	
?>