<?php 

	function desativar_professor($conexao,$idfuncionario) {
    	$conexao->exec("UPDATE funcionario set status=0 WHERE idfuncionario=$idfuncionario ");
    
	}	
	function listar_nome_professor_turma($conexao,$idaluno,$ano_letivo) {
    	        $res=$conexao->query("SELECT 
  disciplina.nome_disciplina,
  disciplina.iddisciplina,
  funcionario.nome as nome_professor,
  turma.idturma,
  turma.nome_turma
FROM ministrada
JOIN disciplina ON ministrada.disciplina_id = disciplina.iddisciplina
JOIN funcionario ON ministrada.professor_id = funcionario.idfuncionario
JOIN turma ON ministrada.turma_id = turma.idturma
JOIN ano_letivo ON turma.idturma = ano_letivo.turma_id
JOIN aluno ON ano_letivo.aluno_id = aluno.idaluno
JOIN escola ON ministrada.escola_id = escola.idescola AND escola.idescola = ano_letivo.escola_id
WHERE 
  ministrada.ano = $ano_letivo AND
  aluno.idaluno = $idaluno AND
  ano_letivo.status_letivo = 1
GROUP BY 
  disciplina.iddisciplina,
  disciplina.nome_disciplina,
  funcionario.nome,
  turma.idturma,
  turma.nome_turma
ORDER BY 
  disciplina.nome_disciplina ASC
");

    	return $res;  

    	// SELECT 
    	//           disciplina.nome_disciplina,
    	//           disciplina.iddisciplina,
    	//           funcionario.nome as 'nome_professor',
    	//           turma.idturma,
    	//           turma.nome_turma
    	//          FROM turma, ano_letivo, aluno , escola, ministrada,disciplina,funcionario WHERE
    	//           ano_letivo.status_letivo=1 AND 
    	//         aluno.idaluno=ano_letivo.aluno_id AND
    	//         ano_letivo.status_letivo=1 AND
    	//         turma.idturma=ano_letivo.turma_id AND
    	//         escola.idescola=ano_letivo.escola_id AND

    	//         ministrada.ano='$ano_letivo' AND
    	//         ministrada.turma_id=turma.idturma AND
    	//         ministrada.escola_id=escola.idescola AND
    	//         ministrada.disciplina_id=disciplina.iddisciplina AND
    	//         ministrada.professor_id=funcionario.idfuncionario AND
    	//         aluno.idaluno = $idaluno group by funcionario.nome,turma.idturma,
    	//           turma.nome_turma,
    	//           disciplina.iddisciplina,
    	//          disciplina.nome_disciplina asc  
	}	

	function listar_nome_professor_turma_ministrada($conexao,$idturma,$idescola,$ano_letivo) {
    	        $res=$conexao->query("
    	        	SELECT 
								    funcionario.nome AS nome_professor,
								    turma.idturma,
								    turma.nome_turma
								FROM ministrada
								JOIN funcionario ON ministrada.professor_id = funcionario.idfuncionario
								JOIN turma ON ministrada.turma_id = turma.idturma
								JOIN escola ON ministrada.escola_id = escola.idescola
								WHERE
								    ministrada.ano = $ano_letivo AND
								    turma.idturma = $idturma AND 
								    escola.idescola = $idescola
								ORDER BY
								    escola.nome_escola ASC,
								    turma.nome_turma ASC ");

    	return $res;    

    	// SELECT 
          	
      //     funcionario.nome as 'nome_professor',
      //     turma.idturma,
      //     turma.nome_turma
      //    FROM turma, escola, ministrada,funcionario WHERE
         
      //   ministrada.ano='$ano_letivo' AND
      //   ministrada.turma_id=turma.idturma AND
      //   ministrada.escola_id=escola.idescola AND
       
      //   ministrada.professor_id=funcionario.idfuncionario AND
      //   turma.idturma = $idturma and 
      //   escola.idescola = $idescola 
      //   group by funcionario.nome,turma.idturma,
      //     turma.nome_turma asc
	}	

	function listar_nome_professor_turma_por_disciplina($conexao,$idturma,$iddisciplina,$idescola,$ano_letivo) {
    	        $res=$conexao->query("
								    	   SELECT 
								    disciplina.nome_disciplina,
								    disciplina.iddisciplina,
								    funcionario.nome AS nome_professor,
								    turma.idturma,
								    turma.nome_turma
								FROM ministrada
								INNER JOIN turma ON ministrada.turma_id = turma.idturma
								INNER JOIN escola ON ministrada.escola_id = escola.idescola
								INNER JOIN disciplina ON ministrada.disciplina_id = disciplina.iddisciplina
								INNER JOIN funcionario ON ministrada.professor_id = funcionario.idfuncionario
								WHERE ministrada.ano = '$ano_letivo'
								AND ministrada.escola_id = '$idescola'
								AND ministrada.turma_id = '$idturma'
								AND ministrada.disciplina_id = '$iddisciplina'
								LIMIT 1 ");

    	return $res;  

    	 // SELECT 
       //    disciplina.nome_disciplina,
       //    disciplina.iddisciplina,
       //    funcionario.nome as 'nome_professor',
       //    turma.idturma,
       //    turma.nome_turma
       //   FROM turma, escola, ministrada,disciplina,funcionario WHERE
 
       //  ministrada.turma_id=turma.idturma AND
       //  ministrada.escola_id=escola.idescola AND
       //  ministrada.disciplina_id=disciplina.iddisciplina AND
       //  ministrada.professor_id=funcionario.idfuncionario and

       //  ministrada.ano='$ano_letivo' AND
       //  ministrada.escola_id='$idescola' AND
       //  ministrada.turma_id='$idturma' AND
       //  ministrada.disciplina_id='$iddisciplina' limit 1  
	}	

	function listar_disciplina_professor_regente($conexao,$idserie,$idturma,$idescola,$ano_letivo) {
    	$res=$conexao->query("SELECT 
		  d.iddisciplina as disciplina_id,
		  d.nome_disciplina,
		  d.abreviacao,
		  f.nome as nome_professor,
		  t.idturma,
		  t.nome_turma
		FROM ministrada m
		JOIN turma t ON m.turma_id = t.idturma
		JOIN escola e ON m.escola_id = e.idescola
		JOIN disciplina d ON m.disciplina_id = d.iddisciplina
		JOIN funcionario f ON m.professor_id = f.idfuncionario
		WHERE 
		  m.ano = $ano_letivo AND
		  m.escola_id = $idescola AND
		  m.turma_id = $idturma AND
		  t.serie_id = $idserie ");


    	return $res;


    	//SELECT 
      //     disciplina.iddisciplina as 'disciplina_id',
      //     disciplina.nome_disciplina,
      //     disciplina.abreviacao,
      //     disciplina.iddisciplina,
      //     funcionario.nome as 'nome_professor',
      //     turma.idturma,
      //     turma.nome_turma
      //    FROM turma, escola, ministrada,disciplina,funcionario WHERE
 
      //   ministrada.turma_id=turma.idturma AND
      //   ministrada.escola_id=escola.idescola AND
      //   ministrada.disciplina_id=disciplina.iddisciplina AND
      //   ministrada.professor_id=funcionario.idfuncionario and
      //   ministrada.ano='$ano_letivo' AND
      //   ministrada.escola_id='$idescola' AND
      //   ministrada.turma_id='$idturma' AND
      //   turma.serie_id='$idserie'    
	}	


	function pesquisar_professor_por_id($conexao,$idfuncionario) {
    	$result=$conexao->query("SELECT * FROM funcionario WHERE idfuncionario=$idfuncionario   and funcionario.status=1 ");
    	return $result ;
	}
	function pesquisar_professor_por_id_status($conexao,$idfuncionario) {
    	$result=$conexao->query("SELECT * FROM funcionario WHERE idfuncionario=$idfuncionario  ");
    	return $result ;
	}

	function pesquisar_professor_associacao($conexao,$pesquisa) {
    	$result=$conexao->query("SELECT * FROM funcionario WHERE descricao_funcao like '%Professo%'  and nome like '%$pesquisa%' OR  idfuncionario = '$pesquisa'  ");
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
		$conexao->exec("UPDATE funcionario set nome='$nome', email='$email', senha='$senha',whatsapp='$whatsapp' where idfuncionario=$idfuncionario ");
		
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
	
	function listar_disciplina_professor($conexao,$idprofessor,$ano_letivo){
	    $res=$conexao->query("SELECT *
FROM ministrada
INNER JOIN turma ON ministrada.turma_id = turma.idturma
INNER JOIN escola ON ministrada.escola_id = escola.idescola
INNER JOIN disciplina ON ministrada.disciplina_id = disciplina.iddisciplina
INNER JOIN funcionario ON ministrada.professor_id = funcionario.idfuncionario
WHERE funcionario.idfuncionario = $idprofessor
AND ministrada.ano = $ano_letivo
AND funcionario.status = 1
ORDER BY escola.nome_escola ASC, turma.nome_turma ASC
");

		return $res;
		// SELECT * FROM turma,  escola, ministrada,disciplina,funcionario WHERE
		//                           ministrada.turma_id=turma.idturma AND
		//                           ministrada.escola_id=escola.idescola AND
		//                           ministrada.disciplina_id=disciplina.iddisciplina AND
		//                           ministrada.professor_id=funcionario.idfuncionario AND
		//                           funcionario.idfuncionario = $idprofessor and
		//                           ministrada.ano = $ano_letivo and
		//                            funcionario.status=1 order by nome_escola asc, nome_turma asc
	}




	function listar_disciplina_professor_na_turma($conexao,$idescola,$idturma,$idprofessor,$ano_letivo){
	    $res=$conexao->query("

	    	SELECT *
	    	FROM ministrada
	    	INNER JOIN turma ON ministrada.turma_id = turma.idturma
	    	INNER JOIN escola ON ministrada.escola_id = escola.idescola
	    	INNER JOIN disciplina ON ministrada.disciplina_id = disciplina.iddisciplina
	    	INNER JOIN funcionario ON ministrada.professor_id = funcionario.idfuncionario
	    	WHERE funcionario.idfuncionario = $idprofessor
	    	AND ministrada.escola_id = $idescola
	    	AND ministrada.turma_id = $idturma
	    	AND ministrada.ano = '$ano_letivo'
	    	AND funcionario.status = 1
	    	ORDER BY escola.nome_escola ASC, turma.nome_turma ASC

	    	");

		return $res;


		// SELECT * FROM turma,  escola, ministrada,disciplina,funcionario WHERE
    //                       ministrada.turma_id=turma.idturma AND
    //                       ministrada.escola_id=escola.idescola AND
    //                       ministrada.disciplina_id=disciplina.iddisciplina AND
    //                       ministrada.professor_id=funcionario.idfuncionario AND
    //                       funcionario.idfuncionario = $idprofessor and
    //                       ministrada.escola_id = $idescola and
    //                       ministrada.turma_id = $idturma and
    //                       ministrada.ano = '$ano_letivo' and
    //                        funcionario.status=1 order by nome_escola asc, nome_turma asc
	}
	
?>