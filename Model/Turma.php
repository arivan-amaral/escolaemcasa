<?php 
   function listar_turmas_com_mesma_disciplinas_do_professor($conexao,$idescola,$idprofessor,$idserie,$iddisciplina){
    $sql= $conexao->query("SELECT * FROM ministrada,escola,turma,disciplina where
                           ministrada.turma_id=idturma and
                           ministrada.disciplina_id=iddisciplina and 
                           ministrada.escola_id=idescola and
                           ministrada.escola_id=idescola and

                           idescola=$idescola and
                           professor_id=$idprofessor and
                           serie_id=$idserie and 
                           disciplina_id=$iddisciplina
                        
                          ");
     return $sql;
   }


function associar_professor($conexao, $turma_id, $disciplina_id, $professor_id, $escola_id){
	$result = $conexao->exec("INSERT INTO ministrada( turma_id, disciplina_id, professor_id, escola_id) 
		VALUES ($turma_id, $disciplina_id, $professor_id, $escola_id)");
}

function desassociar_professor($conexao, $id){
	$result = $conexao->exec("DELETE FROM ministrada where idministrada=$id");
}
 	 

function associar_aluno($conexao, $ano, $turma_id, $aluno_id,  $escola_id){
	$result = $conexao->exec("INSERT INTO ano_letivo (ano, turma_id, aluno_id,  escola_id) VALUES ('$ano', $turma_id, $aluno_id,$escola_id)");

}



function lista_de_turmas_por_id($conexao,$idturma){

   $result = $conexao->query("SELECT * FROM turma where idturma=$idturma");

    return $result;

}

function lista_de_turmas($conexao,$serie_id){

   $result = $conexao->query("SELECT * FROM turma where serie_id=$serie_id  ORDER BY nome_turma asc");

    return $result;

}

function lista_turma($conexao){

   $result = $conexao->query("SELECT * FROM turma  ORDER BY nome_turma asc");

    return $result;

}


function lista_minhas_turmas($conexao,$id_funcionario){

        $result = $conexao->query("SELECT * FROM turma,disciplina, ministrada, funcionario,escola where escola.idescola= ministrada.escola_id and turma_id=idturma and disciplina_id=iddisciplina and professor_id=idfuncionario and idfuncionario=$id_funcionario ORDER by escola.nome_escola asc, turma.nome_turma asc, disciplina.nome_disciplina asc");

    return $result;

}
function lista_serie($conexao){

   $result = $conexao->query("SELECT * FROM serie  ORDER BY nome asc");

    return $result;

}

?>