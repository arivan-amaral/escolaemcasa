<?php 

	function desativar_professor($conexao,$idfuncionario) {
    	$conexao->exec("UPDATE funcionario set status=0 WHERE idfuncionario=$idfuncionario ");
    
	}	
	function listar_nome_professor_turma($conexao,$idaluno) {
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
        aluno.idaluno = $idaluno group by funcionario.nome asc");

    	return $res;    
	}	


	function pesquisar_professor_por_id($conexao,$idfuncionario) {
    	$result=$conexao->query("SELECT * FROM funcionario WHERE idfuncionario=$idfuncionario   and funcionario.status=1 ");
    	return $result ;
	}

	function pesquisar_professor_associacao($conexao,$pesquisa) {
    	$result=$conexao->query("SELECT * FROM funcionario WHERE descricao_funcao !='Coordenador' and  descricao_funcao !='Secretário' AND descricao_funcao !='Coordenadora' and nome like '%$pesquisa%'  and funcionario.status=1 ");
    	return $result ;
	}

	function pesquisar_imagem_professor($conexao, $id) {
    	$result=$conexao->query("SELECT * FROM imagem WHERE id_funcionario=$id ");
    	return $result ;
	}

	function inserir_imagem_padrao_professor($conexao,  $id) {
    	$conexao->exec("INSERT INTO imagem (id_funcionario) values ($id) ");
	}

	function alterar_foto_professor($conexao, $nome, $id) {
    	$result = $conexao->exec("UPDATE imagem SET nome = '$nome' WHERE id_funcionario = $id");
    	return $result;
	}
// *************************************************************************************************

	function alterar_dados_professor($conexao,$nome, $email, $senha,$whatsapp,$idfuncionario){
		$conexao->exec("UPDATE funcionario set nome='$nome' email='$email', senha='$senha',whatsapp='$whatsapp' where idfuncionario=$idfuncionario ");
		
	}

	function cadastro_professor($conexao,$nome, $email, $descricao_funcao,$whatsapp, $senha,$cpf){
		$conexao->exec("INSERT INTO funcionario( nome, email, descricao_funcao,whatsapp, senha,cpf) 
			VALUES ('$nome', '$email', '$descricao_funcao','$whatsapp', '$senha','$cpf') ");
		
	}


	function listar_dados_professor($conexao,$idprofessor){
		$res=$conexao->query("SELECT 
			
			funcionario.nome as 'nome',
			funcionario.email,
			funcionario.senha,
			funcionario.whatsapp
		 	FROM funcionario where  idfuncionario = $idprofessor and funcionario.status=1 ");

		return $res;
	}

	function dados_professor($conexao,$idprofessor){
		$res=$conexao->query("SELECT 
			imagem.nome as 'foto',
			funcionario.nome as 'nome',
			funcionario.email,
			funcionario.senha,
			funcionario.whatsapp
		 	FROM funcionario,imagem where  id_funcionario=idfuncionario and idfuncionario = $idprofessor  and funcionario.status=1 ");

		return $res;
	}
	
	function listar_disciplina_professor($conexao,$idprofessor){
	    $res=$conexao->query("SELECT * FROM turma,  escola, ministrada,disciplina,funcionario WHERE
                          ministrada.turma_id=turma.idturma AND
                          ministrada.escola_id=escola.idescola AND
                          ministrada.disciplina_id=disciplina.iddisciplina AND
                          ministrada.professor_id=funcionario.idfuncionario AND
                          funcionario.idfuncionario = $idprofessor and funcionario.status=1 order by nome_escola asc, nome_turma asc");

		return $res;
	}
	
?>