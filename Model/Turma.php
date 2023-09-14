<?php 



   function listar_turmas_escola($conexao,$idescola,$idserie){
  
      $sql=$conexao->prepare("SELECT 
         idturma,
         serie.id as 'idserie',
         serie.nome as 'nome_serie',
         nome_turma,
         nome_escola,
         idescola
        FROM ministrada,escola,turma,funcionario,serie WHERE

      serie.id= turma.serie_id AND
      ministrada.escola_id= escola.idescola AND
      ministrada.professor_id= funcionario.idfuncionario and
      ministrada.turma_id = turma.idturma 
      AND escola_id= :idescola 
      AND turma.serie_id= :idserie 

      GROUP BY turma.idturma,serie.id,serie.nome,nome_turma,
         nome_escola,
         idescola
      ORDER BY turma.nome_turma
      ");
      $sql->bindParam("idescola",$idescola);
      $sql->bindParam("idserie",$idserie);

      $sql->execute();
      return $sql->fetchAll();
   }


   function listar_turma_turno_escola($conexao,$idescola,$idserie){
   
      $sql=$conexao->prepare("SELECT idturma,nome_escola,nome_turma,turno FROM 
         relacionamento_turma_escola,escola,turma
       WHERE

      relacionamento_turma_escola.escola_id= escola.idescola AND
      relacionamento_turma_escola.turma_id= turma.idturma 
    
      AND escola_id= :idescola 
      AND turma.serie_id= :idserie 
 
      GROUP BY idturma,nome_escola,nome_turma,turno
      ORDER BY turma.nome_turma
      ");
      $sql->bindParam("idescola",$idescola);
      $sql->bindParam("idserie",$idserie);

      $sql->execute();
      return $sql->fetchAll();
   }

   function cadastrar_turma_escola($conexao,$idEscola,$idTurma,$turno,$ano,$vagas) {
      $sql = $conexao->prepare("INSERT INTO relacionamento_turma_escola (escola_id,turma_id,turno,ano,quantidade_vaga) VALUES (:idEscola,:idTurma,:turno,:ano,:vagas)");
      $sql->execute(array(
         'idEscola' =>$idEscola,
         'idTurma' =>$idTurma,
         'turno' =>$turno,
         'ano' =>$ano,
         'vagas' =>$vagas
      ));
    }


function alterar_vagas($conexao,$id,$idEscola,$idTurma,$ano,$vagas){
   $conexao->exec("UPDATE relacionamento_turma_escola SET quantidade_vaga=$vagas+quantidade_vaga where escola_id = $idEscola and turma_id=$idTurma and ano=$ano and id=$id"); 
}


 function pesquisar_vagas($conexao,$id,$idEscola,$idTurma,$ano) {
        $sql = $conexao->prepare("SELECT * FROM relacionamento_turma_escola where escola_id = :idEscola and turma_id=:idTurma and ano=:ano and id=:id");
        $sql->execute(array(
         'idEscola' =>$idEscola,
         'idTurma' =>$idTurma,
         'ano' =>$ano,
         'id' =>$id
      ));
        return $sql->fetchAll();
    }

   function validar_turma_escola($conexao,$idescola,$ano,$serie,$idturma,$turno) {
        $sql = $conexao->prepare("SELECT count(*) as 'id' FROM  relacionamento_turma_escola,turma where relacionamento_turma_escola.escola_id =:idescola AND turma.idturma = relacionamento_turma_escola.turma_id AND relacionamento_turma_escola.turma_id =:idturma AND turma.serie_id =:serie AND relacionamento_turma_escola.ano =:ano AND relacionamento_turma_escola.turno = :turno");
        $sql->execute(array(
         'idescola' =>$idescola,
         'idturma' =>$idturma,
         'serie' =>$serie,
         'ano' =>$ano,
         'turno' =>$turno
      ));
        return $sql->fetchAll();
    }





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


function associar_professor($conexao, $turma_id, $disciplina_id, $professor_id, $escola_id,$ano){
	$result = $conexao->exec("INSERT INTO ministrada( turma_id, disciplina_id, professor_id, escola_id,ano) 
		VALUES ($turma_id, $disciplina_id, $professor_id, $escola_id, $ano)");
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

function lista_de_turmas_relatorio($conexao,$ano_letivo,$idturmas,$escolas){
 
   $result = $conexao->query("SELECT relacionamento_turma_escola.quantidade_vaga, turma.nome_turma FROM relacionamento_turma_escola, turma WHERE
turma.idturma= relacionamento_turma_escola.turma_id and 
relacionamento_turma_escola.escola_id = $escolas and 
relacionamento_turma_escola.turma_id $idturmas AND
relacionamento_turma_escola.ano='$ano_letivo'");

    return $result;

}



// function quantidade_matriculado_turma_relatorio($conexao,$ano_letivo,$idturmas,$escolas){

//    $result = $conexao->query("SELECT relacionamento_turma_escola.quantidade_vaga FROM relacionamento_turma_escola WHERE
// relacionamento_turma_escola.escola_id $escolas and 
// relacionamento_turma_escola.turma_id $idturmas AND
// relacionamento_turma_escola.ano='$ano_letivo' ");

//     return $result;

// }

function lista_de_turmas($conexao,$serie_id){

   $result = $conexao->query("SELECT * FROM turma where serie_id=$serie_id  ORDER BY nome_turma asc");

    return $result;

}

function quantidade_vaga_turma($conexao,$escola_id,$turma_id,$turno,$ano_letivo_vigente){

   $result = $conexao->query("
      SELECT * FROM relacionamento_turma_escola where  
      relacionamento_turma_escola.escola_id=$escola_id and
      relacionamento_turma_escola.turma_id=$turma_id and
     relacionamento_turma_escola.turno='$turno' and
     relacionamento_turma_escola.ano='$ano_letivo_vigente' ");

    return $result;

}

function quantidade_aluno_na_turma($conexao,$escola_id,$turma_id,$turno,$ano_letivo_vigente){

   $result = $conexao->query("
     SELECT 
   COUNT(*) as 'quantidade'
FROM
 ecidade_matricula

where

ecidade_matricula.matricula_concluida='N' and
ecidade_matricula.matricula_ativa='S' and
ecidade_matricula.matricula_situacao !='CANCELADO' and
ecidade_matricula.turma_escola=$escola_id and
ecidade_matricula.turma_id=$turma_id AND
ecidade_matricula.calendario_ano ='$ano_letivo_vigente'  AND
ecidade_matricula.turno_nome ='$turno' ");

    return $result;

}

function lista_de_turmas_das_escolas_rematricula($conexao,$serie_id,$escola_id,$turno,$ano_letivo_vigente){

   $result = $conexao->query("
      SELECT turma.idturma as 'idturma', relacionamento_turma_escola.id as 'id' , turma.nome_turma,relacionamento_turma_escola.ano, escola.nome_escola,relacionamento_turma_escola.turno, relacionamento_turma_escola.quantidade_vaga FROM serie,turma,relacionamento_turma_escola,escola where 
   relacionamento_turma_escola.escola_id= escola.idescola and
   turma.serie_id=serie.id and
   relacionamento_turma_escola.turma_id=turma.idturma and 
   relacionamento_turma_escola.escola_id=$escola_id and (
   turma.serie_id=$serie_id OR turma.serie_id=16 )and
     turno='$turno' and
     ano=$ano_letivo_vigente 

     ORDER BY nome_turma asc");

    return $result;

}


function lista_de_turmas_das_escolas($conexao,$serie_id,$escola_id,$turno,$ano_letivo_vigente){

   $result = $conexao->query("
      SELECT turma.idturma as 'idturma', relacionamento_turma_escola.id as 'id' , turma.nome_turma,relacionamento_turma_escola.ano, escola.nome_escola,relacionamento_turma_escola.turno, relacionamento_turma_escola.quantidade_vaga FROM serie,turma,relacionamento_turma_escola,escola where 
   relacionamento_turma_escola.escola_id= escola.idescola and
   turma.serie_id=serie.id and
   relacionamento_turma_escola.turma_id=turma.idturma and 
   relacionamento_turma_escola.escola_id=$escola_id and
   turma.serie_id=$serie_id and
     turno='$turno' and
     ano=$ano_letivo_vigente 

     ORDER BY nome_turma asc");

    return $result;

}
function lista_de_turmas_da_escola_relatorio($conexao,$escola_id,$ano_letivo_vigente){

   $result = $conexao->query("
      SELECT turma.idturma as 'idturma', relacionamento_turma_escola.id as 'id' , turma.nome_turma,relacionamento_turma_escola.ano, escola.nome_escola,relacionamento_turma_escola.turno, relacionamento_turma_escola.quantidade_vaga FROM serie,turma,relacionamento_turma_escola,escola where 
   relacionamento_turma_escola.escola_id= escola.idescola and
   turma.serie_id=serie.id and
   relacionamento_turma_escola.turma_id=turma.idturma and 
   relacionamento_turma_escola.escola_id=$escola_id and
   turma.serie_id>0 and
     turno!='' and
     ano=$ano_letivo_vigente 

     ORDER BY nome_turma asc");

    return $result;

}



function excluir_turma_escola($conexao,$id){
   $sql = $conexao->prepare("DELETE FROM relacionamento_turma_escola WHERE id = :id");
   $sql->execute(array(
          'id' =>$id));
}
// function pesquisar_turma_por_escola_por_id($conexao,$idescola,$idturma){

//    $result = $conexao->query("SELECT * FROM turma,escola where serie_id=$serie_id  ORDER BY nome_turma asc");

//     return $result;

// }

function lista_turma($conexao){

   $result = $conexao->query("SELECT * FROM turma  ORDER BY nome_turma asc");

    return $result;

}


function lista_minhas_turmas($conexao,$id_funcionario,$ano_letivo){

        $result = $conexao->query("SELECT * FROM turma,disciplina, ministrada, funcionario,escola where escola.idescola= ministrada.escola_id and turma_id=idturma and disciplina_id=iddisciplina and professor_id=idfuncionario and idfuncionario=$id_funcionario and ministrada.ano='$ano_letivo' ORDER by escola.nome_escola asc, turma.nome_turma asc, disciplina.nome_disciplina asc");

    return $result;

}
function lista_serie($conexao){

   $result = $conexao->query("SELECT * FROM serie  ORDER BY nome asc");

    return $result;

}

?>