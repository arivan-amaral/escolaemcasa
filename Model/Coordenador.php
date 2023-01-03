<?php 
	function pesquisar_coordenador_por_id($conexao,$idfuncionario) {
    	$result=$conexao->query("SELECT * FROM funcionario WHERE idfuncionario=$idfuncionario   and funcionario.status=1 ");
    	return $result ;
	}


	function pesquisar_imagem_coordenador($conexao, $id) {
    	$result=$conexao->query("SELECT * FROM imagem WHERE id_funcionario=$id ");
    	return $result ;
	}

	function pesquisar_coordenador($conexao, $pesquisa) {
    	$result=$conexao->query("SELECT * FROM funcionario WHERE (descricao_funcao like 'Coordenador' or descricao_funcao like 'Coordenadora' or descricao_funcao like 'Secretário' or descricao_funcao like 'Diretor') and  nome like '%$pesquisa%'
    	and status=1 order by nivel_acesso_id desc , nome asc ");
    	return $result ;
	}	

	function escola_associada($conexao,$idfuncionario){
    	$result=$conexao->query("SELECT * FROM funcionario,relacionamento_funcionario_escola,escola WHERE relacionamento_funcionario_escola.escola_id =escola.idescola and relacionamento_funcionario_escola.funcionario_id = funcionario.idfuncionario  AND  
			idfuncionario=$idfuncionario ");
    	return $result ;
	}	

	function excluir_coordenador($conexao,$id){
    	$conexao->exec("DELETE FROM relacionamento_funcionario_escola where funcionario_id=$id");
    	$conexao->exec("UPDATE funcionario set status=0 where idfuncionario=$id");
    	
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
    	$conexao->exec("INSERT INTO imagem (id_funcionario) values ($coordenador_id) ");
	}
	function associar_coordenador_a_escola($conexao,  $funcionario_id,$escola_id,$ano) {
    	$conexao->exec("INSERT INTO relacionamento_funcionario_escola (funcionario_id,escola_id,ano) values ($funcionario_id,$escola_id,$ano) ");
	}

// *************************************************************************************************

	function cadastro_coordenador($conexao,$nome, $email, $descricao_funcao,$whatsapp, $senha,$cpf){
		$conexao->exec("INSERT INTO funcionario( nome, email, descricao_funcao,whatsapp, senha,cpf) 
			VALUES ('$nome', '$email', '$descricao_funcao','$whatsapp', '$senha','$cpf') ");
		
	}	

	function editar_coordenador($conexao,$nome, $email, $descricao_funcao,$whatsapp,$idfuncionario,$cpf){
		$conexao->exec("UPDATE funcionario SET nome='$nome', email='$email', descricao_funcao='$descricao_funcao', whatsapp='$whatsapp', cpf='$cpf' WHERE idfuncionario= $idfuncionario ");
		 
		
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

	function listar_turmas_inicial_coordenador($conexao,$idescola,$ano_letivo){
	    $res=$conexao->query("SELECT 
	       idturma,
	       turma.seguimento,
	       
	       serie.id as 'idserie',
	       serie.nome as 'nome_serie',
	       nome_turma,
	       idescola,
	       nome_escola,
	       relacionamento_turma_escola.turno

	FROM escola,turma,serie,relacionamento_turma_escola WHERE

		relacionamento_turma_escola.escola_id= escola.idescola and 
		relacionamento_turma_escola.turma_id = turma.idturma AND
		turma.serie_id = serie.id AND
		escola.idescola='$idescola' AND 
		relacionamento_turma_escola.ano='$ano_letivo'

	 ORDER BY turma.nome_turma");

		return $res;
		
	 // GROUP BY turma.idturma
	}


	// function listar_turmas_coordenador($conexao,$idescola,$ano_letivo){
	//      $res=$conexao->query("SELECT 
	//         idturma,
	//         turma.seguimento,
	        
	//         serie.id as 'idserie',
	//         serie.nome as 'nome_serie',
	//         nome_turma,
	//         idescola,
	//         nome_escola,
	//         relacionamento_turma_escola.turno

	//  FROM escola,turma,serie,relacionamento_turma_escola WHERE

	//  	relacionamento_turma_escola.escola_id= escola.idescola and 
	//  	relacionamento_turma_escola.turma_id = turma.idturma AND
	//  	turma.serie_id = serie.id AND
	//  	escola.idescola='$idescola' AND 
	//  	relacionamento_turma_escola.ano='$ano_letivo'

	//   ORDER BY turma.nome_turma");

	//  	return $res;
	// }	


	function listar_turmas_coordenador($conexao,$idescola,$ano_letivo){
	    $res=$conexao->query("SELECT 
	       idturma,
	       turma.seguimento,
	       serie.id as 'idserie',
	       serie.nome as 'nome_serie',
	       nome_turma,
	       idescola,
	       nome_escola
	      FROM ministrada,escola,turma,funcionario,serie WHERE

	    serie.id= turma.serie_id AND
	    ministrada.escola_id= escola.idescola AND
	    ministrada.professor_id= funcionario.idfuncionario and
	    ministrada.turma_id = turma.idturma AND
	    ministrada.ano = '$ano_letivo' AND
	    escola_id=$idescola GROUP BY turma.idturma
	    ORDER BY turma.nome_turma");

		return $res;
	}

function listar_disciplina_da_turma($conexao,$idturma,$idescola,$ano_letivo){
	    $res=$conexao->query("SELECT turma.nome_turma, disciplina.iddisciplina,disciplina.nome_disciplina, funcionario.nome FROM turma, ministrada,disciplina, funcionario WHERE 
	    	funcionario.idfuncionario= ministrada.professor_id AND
	    	disciplina.iddisciplina=ministrada.disciplina_id AND
	    	 ministrada.turma_id=turma.idturma AND 
	    	 ministrada.ano='$ano_letivo' AND 
	    	 turma.idturma = $idturma and escola_id=$idescola ORDER by nome_disciplina ASC");

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