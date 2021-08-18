<?php

function cadastro_ocorrencia($conexao,$escola_id, $turma_id, $disciplina_id, $professor_id, $aluno_id, $descricao, $data_ocorrencia){

	$resultado=$conexao->exec(" INSERT INTO ocorrencia_pedagogica(escola_id, turma_id, disciplina_id, professor_id, aluno_id, descricao, data_ocorrencia) VALUES ($escola_id, $turma_id, $disciplina_id, $professor_id, $aluno_id, '$descricao', '$data_ocorrencia')		
		");	
}

function verifica_ocorrencia_cadastrada($conexao, $iddisciplina, $idturma, $idescola, $idprofessor,$data_ocorrencia,$aluno_id){

	$resultado=$conexao->query(" SELECT * FROM ocorrencia_pedagogica WHERE
		escola_id=$idescola and 
		turma_id=$idturma and 
		disciplina_id=$iddisciplina and
		aluno_id=$aluno_id and
		data_ocorrencia='$data_ocorrencia' and
		professor_id=$idprofessor
		
		");
	return $resultado;
	
}

function limpar_ocorrencia_cadastrada($conexao, $iddisciplina, $idturma, $idescola, $idprofessor,$data_ocorrencia,$aluno_id){

	$resultado=$conexao->query(" DELETE FROM ocorrencia_pedagogica WHERE
		escola_id=$idescola and 
		turma_id=$idturma and 
		disciplina_id=$iddisciplina and
		aluno_id=$aluno_id and
		data_ocorrencia='$data_ocorrencia' and
		professor_id=$idprofessor
		
		");
	return $resultado;
	
}


function listar_ocorrencia_cadastrado($conexao, $iddisciplina, $idturma, $idescola, $idprofessor){

	$resultado=$conexao->query(" SELECT * FROM ocorrencia_pedagogica WHERE
		escola_id=$idescola and 
		turma_id=$idturma and 
		disciplina_id=$iddisciplina and
		professor_id=$idprofessor GROUP BY data_ocorrencia
		
		");
	return $resultado;
	
}

// ***********************************************************************************************

function limpa_parecer_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$idaluno,$idperiodo,$data_nota,$parecer_disciplina_id,$avaliacao){
    $resultado=$conexao->exec(" DELETE FROM nota WHERE
    	escola_id=$idescola and 
    	turma_id=$idturma and 
    	disciplina_id=$iddisciplina and
    	aluno_id=$idaluno and
    	periodo_id=$idperiodo and 
    	parecer_disciplina_id=$parecer_disciplina_id and 
    	avaliacao='$avaliacao' and 

    	data_nota='$data_nota'
    	");
    return $resultado;
}

function limpa_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$idaluno,$idperiodo,$data_nota,$avaliacao){
    $conexao->exec(" DELETE FROM nota WHERE
    	escola_id=$idescola and 
    	turma_id=$idturma and 
    	disciplina_id=$iddisciplina and
    	aluno_id=$idaluno and
    	periodo_id=$idperiodo and 
    	avaliacao='$avaliacao' and 
    	data_nota='$data_nota'
    	");
  
}


function verifica_parecer_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$idaluno,$idperiodo,$data_nota,$parecer_disciplina_id,$avaliacao){
    $resultado=$conexao->query(" SELECT * FROM nota WHERE
    	escola_id=$idescola and 
    	turma_id=$idturma and 
    	disciplina_id=$iddisciplina and
    	aluno_id=$idaluno and
    	periodo_id=$idperiodo and 
    	parecer_disciplina_id=$parecer_disciplina_id and 
    	avaliacao='$avaliacao' and 

    	data_nota='$data_nota'
    	");
    return $resultado;
}

function verifica_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$idaluno,$idperiodo,$data_nota,$avaliacao){
    $resultado=$conexao->query(" SELECT * FROM nota WHERE
    	escola_id=$idescola and 
    	turma_id=$idturma and 
    	disciplina_id=$iddisciplina and
    	aluno_id=$idaluno and
    	periodo_id=$idperiodo and 
    	data_nota='$data_nota' and 
    	avaliacao ='$avaliacao'
    	");
    return $resultado;
}

// ************************************************************************

function listar_parecer_disciplina($conexao,$iddisciplina){
    $resultado=$conexao->query(" SELECT * FROM parecer_disciplina WHERE
       disciplina_id =$iddisciplina  and status=1");
    return $resultado;
}


function cadastro_nota($conexao,$nota, $parecer_disciplina_id, $parecer_descritivo, $sigla, $escola_id, $turma_id, $disciplina_id, $aluno_id, $periodo_id, $data_nota,$avaliacao) {
    $conexao->exec("INSERT INTO nota(nota, parecer_disciplina_id, parecer_descritivo, sigla, escola_id, turma_id, disciplina_id, aluno_id, periodo_id, data_nota,avaliacao) VALUES ($nota, $parecer_disciplina_id, '$parecer_descritivo', '$sigla', $escola_id, $turma_id, $disciplina_id, $aluno_id, $periodo_id, '$data_nota','$avaliacao')");
    return $conexao;
}

// ********************************************************************************

function cadastro_conteudo_aula($conexao,$descricao, $disciplina_id, $turma_id, $escola_id, $professor_id, $data,$aula) {
    $conexao->exec("INSERT INTO conteudo_aula(descricao, disciplina_id, turma_id, escola_id, professor_id, data,aula) VALUES ('$descricao', $disciplina_id, $turma_id, $escola_id, $professor_id, '$data','$aula')");
    return $conexao;
}

function limpa_conteudo_aula($conexao, $iddisciplina, $idturma, $idescola, $professor_id, $data,$aula) {
    $conexao->exec("DELETE FROM conteudo_aula WHERE
      aula='$aula' and 
      professor_id=$professor_id and 
      data='$data' and 
      disciplina_id=$iddisciplina and 
      escola_id=$idescola and 
      turma_id=$idturma");
  
}

function listar_trimestre($conexao) {
    $resultado=$conexao->query("SELECT * FROM periodo where status =1");
  return $resultado;
}

function listar_frequencia_cadastrado($conexao, $iddisciplina, $idturma, $idescola, $professor_id) {
    $resultado=$conexao->query("SELECT * FROM frequencia WHERE
      professor_id=$professor_id and 
      disciplina_id=$iddisciplina and 
      escola_id=$idescola and 
      turma_id=$idturma  group by aula ");
  return $resultado;
}

function listar_conteudo_aula_cadastrado($conexao, $iddisciplina, $idturma, $idescola, $professor_id) {
    $resultado=$conexao->query("SELECT * FROM conteudo_aula WHERE
      disciplina_id=$iddisciplina and 
      escola_id=$idescola and 
      turma_id=$idturma order by data");
  return $resultado;
}

function verificar_conteudo_aula_cadastrado_por_data($conexao, $iddisciplina, $idturma, $idescola, $data) {
    $resultado=$conexao->query("SELECT * FROM conteudo_aula WHERE
      data='$data' and 
      disciplina_id=$iddisciplina and 
      escola_id=$idescola and 
      turma_id=$idturma order by data");
  return $resultado;
}



function excluir_frequencia_lancada($conexao,$conteudo_aula_id) {
    $conexao->exec("DELETE FROM frequencia WHERE conteudo_aula_id=$conteudo_aula_id
      ");
    $conexao->exec("DELETE FROM conteudo_aula WHERE
       id=$conteudo_aula_id
      ");


}

// function excluir_frequencia_lancada($conexao,$escola_id,$turma_id,$disciplina_id,$data,$aula) {
//     $conexao->exec("DELETE FROM conteudo_aula WHERE
//       professor_id=$professor_id and 
//       disciplina_id=$iddisciplina and 
//       escola_id=$idescola and 
//       turma_id=$idturma and data='$data' and aula='$aula'
//       ");

//     $conexao->exec("DELETE FROM frequencia WHERE
//       professor_id=$professor_id and 
//       disciplina_id=$iddisciplina and 
//       escola_id=$idescola and 
//       turma_id=$idturma and data_frequencia='$data' and aula='$aula'
//       ");

// }



function excluir_avaliacao_lancada($conexao,$escola_id,$turma_id,$disciplina_id,$periodo_id,$data_nota,$avaliacao) {
    $conexao->exec(" DELETE FROM nota WHERE
      disciplina_id=$disciplina_id and 
      escola_id=$escola_id and 
      turma_id=$turma_id and
      data_nota='$data_nota' and 
      periodo_id =$periodo_id and 
      avaliacao='$avaliacao'
      ");
    
}

function listar_todas_avaliacao_lancada($conexao,$idescola,$idturma,$iddisciplina,$avaliacao) {
    $resultado=$conexao->query(" SELECT * FROM nota WHERE
      
      disciplina_id=$iddisciplina and 
      escola_id=$idescola and 
      turma_id=$idturma and avaliacao='$avaliacao' group by data_nota ");
    return $resultado;
}

function listar_todas_avaliacao_lancada_parecer($conexao,$idescola,$idturma,$iddisciplina,$avaliacao,$aluno_id) {
    $resultado=$conexao->query(" SELECT * FROM nota WHERE
      
      disciplina_id=$iddisciplina and 
      escola_id=$idescola and 
      turma_id=$idturma and avaliacao='$avaliacao' and aluno_id=$aluno_id and parecer_descritivo!='' ");
    return $resultado;
}


function listar_avaliacao_lancada($conexao,$idescola,$idturma,$iddisciplina) {
    $resultado=$conexao->query(" SELECT * FROM nota WHERE
     
      disciplina_id=$iddisciplina and 
      escola_id=$idescola and 
      turma_id=$idturma GROUP BY avaliacao,periodo_id ");
    return $resultado;
}

function verificar_conteudo_aula($conexao, $iddisciplina, $idturma, $idescola, $professor_id, $data,$aula) {
    $resultado=$conexao->query("SELECT * FROM conteudo_aula WHERE
  
      data='$data' and 
      disciplina_id=$iddisciplina and 
      escola_id=$idescola and 
      aula='$aula' and 
      turma_id=$idturma");
  return $resultado;
}


function cadastro_frequencia($conexao,$idescola,$idturma,$iddisciplina,$professor_id,$aluno_id,$data_frequencia,$conteudo_aula_id,$presenca,$aula) {
    $conexao->exec(" INSERT INTO frequencia( aluno_id,turma_id, professor_id, data_frequencia, conteudo_aula_id, disciplina_id, escola_id,presenca,aula) VALUES (
    	$aluno_id,$idturma, $professor_id, '$data_frequencia', $conteudo_aula_id, $iddisciplina, $idescola,$presenca,'$aula'
)");
    return $conexao;
}

function limpar_cadastro_frequencia($conexao,$idescola,$idturma,$iddisciplina,$professor_id,$data_frequencia,$aula) {
    $conexao->exec(" DELETE FROM frequencia WHERE
      aula='$aula' and 
      professor_id=$professor_id and 
      data_frequencia='$data_frequencia' and 
      disciplina_id=$iddisciplina and 
      escola_id=$idescola and 
      turma_id=$idturma ");
    return $conexao;
}

// ****************************************************************************************

function verificar_nota_por_periodo($conexao,$idescola,$idturma,$iddisciplina,$professor_id,$data_frequencia,$aluno_id) {
    $resultado=$conexao->query(" SELECT * FROM frequencia WHERE
      professor_id=$professor_id and 
      data_frequencia='$data_frequencia' and 
      disciplina_id=$iddisciplina and 
      escola_id=$idescola and 
      turma_id=$idturma and aluno_id=$aluno_id and presenca=1");
    return $resultado;
}

function verificar_nota_por_data($conexao,$idescola,$idturma,$iddisciplina,$professor_id,$data_frequencia,$aluno_id) {
    $resultado=$conexao->query(" SELECT * FROM frequencia WHERE
      professor_id=$professor_id and 
      data_frequencia='$data_frequencia' and 
      disciplina_id=$iddisciplina and 
      escola_id=$idescola and 
      turma_id=$idturma and aluno_id=$aluno_id and presenca=1");
    return $resultado;
}
// ****************************************************************************************

function verificar_frequencia($conexao,$idescola,$idturma,$iddisciplina,$professor_id,$data_frequencia,$aluno_id,$aula) {
    $resultado=$conexao->query(" SELECT * FROM frequencia WHERE

      data_frequencia='$data_frequencia' and 
      disciplina_id=$iddisciplina and 
      escola_id=$idescola and 
      aula='$aula' and 
      turma_id=$idturma and aluno_id=$aluno_id and presenca=1");
    return $resultado;
}



// ********************************************************************************
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
		$res=$conexao->query("SELECT turma.nome_turma, aluno.senha,aluno.email,aluno.nome as 'nome_aluno', aluno.idaluno, aluno.status as 'status_aluno', turma.nome_turma FROM aluno, ano_letivo,turma where turma_id=$idturma and aluno_id=idaluno and turma_id=idturma and escola_id=$idescola  ORDER by nome ASC");
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


	function listar_disciplina_para_boletim($conexao,$idaluno){
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
		disciplina.facultativo=0 AND
		aluno.idaluno = $idaluno");
		return $res;
	}
	
?>