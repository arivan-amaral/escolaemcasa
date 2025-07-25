<?php


function salvar_arquivo_laudo($conexao,$idaluno,$nome_arquivo){
    $sql=$conexao->prepare("UPDATE aluno  SET laudo=? WHERE idaluno = ?");

   $sql->execute(array($nome_arquivo,$idaluno));

}



function buscar_notas_trimestre_boletim($conexao,$idescola,$idturma,$iddisciplina,$ano_letivo, $periodo_id, $idaluno){

  $sql=  $conexao->query("
          SELECT avaliacao,periodo_id,nota FROM nota_parecer WHERE
          escola_id=$idescola and
          turma_id=$idturma and
          disciplina_id=$iddisciplina and 
          ano_nota=$ano_letivo and
          periodo_id=$periodo_id and aluno_id=$idaluno  group by avaliacao,periodo_id,nota,nota ");

    return $sql;

}



function listar_aluno_da_turma_ata_resultado_final_geral($conexao,$turma_id,$escola_id,$ano_letivo,$idaluno){

  $res=$conexao->query("
    SELECT 
UPPER(aluno.nome) as 'nome_aluno',
aluno.sexo,
aluno.data_nascimento,
aluno.idaluno,
aluno.email,
aluno.status as 'status_aluno',
aluno.senha,
turma.nome_turma,

ecidade_matricula.matricula_codigo as 'matricula',
ecidade_matricula.matricula_datamatricula as 'data_matricula',
ecidade_matricula.datasaida as 'datasaida'

FROM
 ecidade_matricula,
aluno,turma,escola

where

ecidade_matricula.aluno_id= aluno.idaluno AND
ecidade_matricula.turma_id = turma.idturma and 
ecidade_matricula.turma_escola = escola.idescola and 
ecidade_matricula.calendario_ano ='$ano_letivo' and 
 

ecidade_matricula.turma_escola=$escola_id and
ecidade_matricula.matricula_situacao ='MATRICULADO' and

ecidade_matricula.turma_id=$turma_id and ecidade_matricula.aluno_id=$idaluno  ORDER by aluno.nome ASC");


   return $res;
} 



function listar_aluno_da_turma_ata_resultado_final_matricula_concluida_geral($conexao,$turma_id,$escola_id,$ano_letivo, $idaluno){
  $res=$conexao->query("
    SELECT 
UPPER(aluno.nome) as 'nome_aluno',
aluno.sexo,
aluno.data_nascimento,
aluno.idaluno,
aluno.email,
aluno.status as 'status_aluno',
aluno.senha,
turma.nome_turma,

ecidade_matricula.matricula_codigo as 'matricula',
ecidade_matricula.matricula_datamatricula as 'data_matricula',
ecidade_matricula.datasaida as 'datasaida'

FROM
 ecidade_matricula,
aluno,turma,escola

where

ecidade_matricula.aluno_id= aluno.idaluno AND
ecidade_matricula.turma_id = turma.idturma and 
ecidade_matricula.turma_escola = escola.idescola and 
ecidade_matricula.calendario_ano ='$ano_letivo' and 
 
-- ecidade_matricula.matricula_concluida='S' and
-- ecidade_matricula.matricula_ativa='N' and
ecidade_matricula.turma_escola=$escola_id and
ecidade_matricula.matricula_situacao !='CANCELADO' and
ecidade_matricula.turma_id=$turma_id and ecidade_matricula.aluno_id=$idaluno ORDER by aluno.nome ASC");


   return $res;
} 




function registrar_sistema_atual_nota_historico($conexao, $idaluno, $ano){
    $sql="SELECT 
     turma.nome_turma,
     escola.nome_escola,
     escola.idescola,
     ecidade_matricula.matricula_codigo AS 'matricula',
     ecidade_matricula.matricula_datamatricula AS 'data_matricula',
     ecidade_matricula.matricula_concluida AS 'matricula_concluida',
     ecidade_matricula.matricula_ativa AS 'matricula_ativa',
     ecidade_matricula.matricula_situacao AS 'matricula_situacao',
     ecidade_matricula.datasaida AS 'datasaida',
     ecidade_matricula.turma_escola AS 'idescola',
     ecidade_matricula.turma_id AS 'idturma',
     turma.serie_id AS 'idserie',
     ecidade_matricula.calendario_ano AS 'calendario_ano'
   FROM 
     ecidade_matricula
     JOIN turma ON ecidade_matricula.turma_id = turma.idturma
     JOIN escola ON ecidade_matricula.turma_escola = escola.idescola
   WHERE 
     ecidade_matricula.aluno_id = $idaluno and 
     ecidade_matricula.calendario_ano = '$ano' 
     AND ecidade_matricula.matricula_situacao in('MATRICULADO', 'REMATRICULADO')
   ORDER BY 
     ecidade_matricula.matricula_codigo DESC, 
     ecidade_matricula.calendario_ano ASC LIMIT 1";

   $result_ecidade_matricula=$conexao->query($sql);
// echo "$sql <br>";
   return $result_ecidade_matricula->fetchAll();
}


function pesquisar_dados_aluno_historico($conexao,$aluno_id,$calendario_ano){
$res=$conexao->query(" ");
return $res->fetchAll();
}

function excluir_questao($conexao, $idaluno) {
        $conexao->exec("DELETE FROM aluno WHERE idaluno=$idaluno");
 //teste
    }

// function verificar_aluno_na_turna_rematricula($conexao,$aluno_id,$calendario_ano){
// $res=$conexao->query("SELECT * FROM ecidade_matricula where 
//                     calendario_ano='$calendario_ano' and matricula_tipo='R'  
//                      and aluno_id=$aluno_id ");
// return $res->fetchAll();
// }
function verificar_aluno_na_turna_rematricula($conexao,$aluno_id,$calendario_ano){
$res=$conexao->query("SELECT * FROM ecidade_matricula, turma where 
                    calendario_ano='$calendario_ano' and matricula_ativa='S'  
                     and aluno_id=$aluno_id and turma.idturma=ecidade_matricula.turma_id and turma.serie_id !=17 and turma.serie_id !=18;");
return $res->fetchAll();
}

function data_matricula($conexao,$aluno_id,$calendario_ano){
$res=$conexao->query("SELECT * FROM ecidade_matricula where 
                    calendario_ano='$calendario_ano' 
                     and aluno_id=$aluno_id ");
return $res->fetchAll();
}

function data_matricula_ativa($conexao,$aluno_id){
$res=$conexao->query("SELECT * FROM ecidade_matricula where  aluno_id=$aluno_id order by matricula_codigo asc ");
return $res->fetchAll();
}


function verificar_matricula_ativa($conexao,$aluno_id, $ano_letivo){
$res=$conexao->query("SELECT  turma.serie_id,turno_nome,turma_escola,turma_id,ecidade_matricula.etapa, matricula_datamatricula, matricula_codigo  FROM ecidade_matricula, turma where  turma_id = idturma and matricula_ativa='S' and matricula_concluida='N' and aluno_id=$aluno_id and calendario_ano='$ano_letivo'  ");
return $res->fetchAll();
}

function verificar_cadastro_lista_espera($conexao,$cpf_aluno){
    $sql=$conexao->prepare("SELECT 
    *
    FROM  
    lista_de_espera 
    WHERE
        cpf_aluno=? LIMIT 1");

   $sql->execute(array($cpf_aluno));
   return $sql->fetchAll();

} 

function pesquisa_lista_espera($conexao, $lista_escolas, $limite, $pesquisa_nome_aluno) {
  $sql = $conexao->prepare("SELECT 
      lista_de_espera.id,
      nome_aluno,
      nome_responsavel,
      funcionario.nome as 'nome_funcionario',
      serie.nome as 'nome_serie',
      escola.nome_escola,
      lista_de_espera.data_hora,
      lista_de_espera.telefone,
      lista_de_espera.escola_id,
      lista_de_espera.observacao,
      lista_de_espera.data_nascimento,
      lista_de_espera.status,
      lista_de_espera.tipo_nec
  FROM  
      lista_de_espera, serie, escola, funcionario
  WHERE
      lista_de_espera.serie_id = serie.id 
      AND lista_de_espera.escola_id = escola.idescola
      AND lista_de_espera.funcionario_id = funcionario.idfuncionario 
      $lista_escolas 
      $pesquisa_nome_aluno
  ORDER BY 
      CASE WHEN lista_de_espera.tipo_nec = 'TEA' THEN 1 ELSE 2 END ASC, 
      lista_de_espera.status ASC, 
      lista_de_espera.id ASC
  LIMIT $limite");

  $sql->execute();
  return $sql->fetchAll();
}


function pesquisa_editar_lista_espera($conexao,$id){
    $sql=$conexao->prepare("SELECT 
        lista_de_espera.id,
        nome_aluno,
        nome_responsavel,
     cpf_aluno,
     cpf_responsavel,
     endereco,
        lista_de_espera.data_hora,
        lista_de_espera.telefone,
        lista_de_espera.escola_id,
        lista_de_espera.observacao,
        lista_de_espera.data_nascimento,
        lista_de_espera.status
    FROM  
    lista_de_espera
    WHERE
         lista_de_espera.id =$id LIMIT  1");

   $sql->execute();
   return $sql->fetchAll();

}



function aceitar_lista_espera($conexao,$id,$status){
    $sql=$conexao->prepare("UPDATE lista_de_espera  SET status=? WHERE id = ?");

   $sql->execute(array($status,$id));

}


function editar_lista_espera($conexao,$nome_aluno,$cpf_aluno,$data_nascimento,$nome_responsavel,$cpf_responsavel,$telefone,$endereco,$escola_id,$serie_id,$funcionario_id,$observacao,$id){
    $sql=$conexao->prepare("UPDATE lista_de_espera SET nome_aluno=?,cpf_aluno=?,data_nascimento=?,nome_responsavel=?,cpf_responsavel=?,telefone=?,endereco=?,escola_id=?,serie_id=?,funcionario_id=?,observacao=? WHERE id = ?");

   $sql->execute(array($nome_aluno,$cpf_aluno,$data_nascimento,$nome_responsavel,$cpf_responsavel,$telefone,$endereco,$escola_id,$serie_id,$funcionario_id,$observacao,$id));

}

function cadastrar_lista_espera($conexao,$nome_aluno,$cpf_aluno,$data_nascimento,$nome_responsavel,$cpf_responsavel,$telefone,$endereco,$escola_id,$serie_id,$funcionario_id,$observacao){
    $sql=$conexao->prepare("INSERT INTO lista_de_espera ( nome_aluno,cpf_aluno,data_nascimento,nome_responsavel,cpf_responsavel,telefone,endereco,escola_id,serie_id,funcionario_id,observacao) values (?,?,?,?,?,?,?,?,?,?,?) ");

   $sql->execute(array($nome_aluno,$cpf_aluno,$data_nascimento,$nome_responsavel,$cpf_responsavel,$telefone,$endereco,$escola_id,$serie_id,$funcionario_id,$observacao));

}


function cancelar_aprovar_concelho($conexao,$idescola,$idturma,$iddisciplina,$idaluno,$ano_letivo){
  $sql=$conexao->prepare("DELETE FROM historico_nota WHERE escola_id = :idescola and turma_id = :idturma and disciplina_id = :iddisciplina and aluno_id = :idaluno and ano = :ano_letivo");
  
  $sql->bindParam("idescola",$idescola);
  $sql->bindParam("idturma",$idturma);
  $sql->bindParam("iddisciplina",$iddisciplina);
  $sql->bindParam("idaluno",$idaluno);
  $sql->bindParam("ano_letivo",$ano_letivo);
  $sql->execute();

}

function aprovar_concelho($conexao,$idescola,$idturma,$iddisciplina,$idaluno, $ano_letivo){
  $sql=$conexao->prepare("INSERT INTO historico_nota 
    ( escola_id, turma_id, disciplina_id, aluno_id, ano) VALUES 
    ( :idescola, :idturma, :iddisciplina, :idaluno, :ano_letivo)");
  
  $sql->bindParam("idescola",$idescola);
  $sql->bindParam("idturma",$idturma);
  $sql->bindParam("iddisciplina",$iddisciplina);
  $sql->bindParam("idaluno",$idaluno);
  $sql->bindParam("ano_letivo",$ano_letivo);
  $sql->execute();

}

function buscar_aprovar_concelho($conexao,$idescola,$idturma,$iddisciplina,$idaluno, $ano_letivo){
  $sql=$conexao->prepare("SELECT * FROM historico_nota WHERE escola_id = :idescola and turma_id = :idturma and disciplina_id = :iddisciplina and aluno_id = :idaluno and ano=:ano_letivo and status=1");
  
  $sql->bindParam("idescola",$idescola);
  $sql->bindParam("idturma",$idturma);
  $sql->bindParam("iddisciplina",$iddisciplina);
  $sql->bindParam("idaluno",$idaluno);
  $sql->bindParam("ano_letivo",$ano_letivo);
  $sql->execute();
  return $sql->fetchAll();

}


// function quantidade_aluno_turma($conexao,$idturma,$idescola){
//   $sql=$conexao->prepare("SELECT COUNT(*) as 'quantidade' FROM
//    aluno, turma 
//    WHERE 

//    turma.idturma=:idturma and
//     aluno_id=idaluno and 
//     turma_id=idturma and 
//     escola_id=:idescola  

//     ORDER by nome ASC");
  
//   $sql->bindParam("idturma",$idturma);
//   $sql->bindParam("idescola",$idescola);
//   $sql->execute();

//   return $sql->fetchAll();
// }


function pesquisar_aluno($conexao,$pesquisa,$codigo_sql ) {
    $sql = $conexao->query("SELECT serie.id as 'idserie', idturma, idescola, escola.nome_escola,
        ano_letivo.idano_letivo as 'matricula', turma.nome_turma, aluno.nome, aluno.idaluno FROM aluno,ano_letivo,escola,turma,serie where
        ano_letivo.status_letivo=1 AND
        serie.id = turma.serie_id and 
        aluno.idaluno=ano_letivo.aluno_id and 
        escola.idescola = ano_letivo.escola_id and 
        turma.idturma = ano_letivo.turma_id and 
        $codigo_sql  and 
        (aluno.idaluno like '$pesquisa' OR aluno.nome like '%$pesquisa%' ) limit 50
        ");

    // $pesquisa='%'.$pesquisa.'%';
    // $sql->execute(
    //     array(
    //         "codigo_sql"=>$codigo_sql,
    //         "nome_aluno"=>$pesquisa,
    //         "idaluno"=>$pesquisa
    //     )
    // );
    return $sql->fetchAll();
}

function pesquisar_aluno2($conexao,$id) {
   $sql = $conexao->prepare("SELECT * FROM aluno where idaluno = :id");
   $sql->execute(array('id' =>$id));
   return $sql->fetchAll();
}

function cadastro_ocorrencia($conexao,$escola_id, $turma_id, $disciplina_id, $professor_id, $aluno_id, $descricao, $data_ocorrencia,$ano_letivo){

	$resultado=$conexao->exec(" INSERT INTO ocorrencia_pedagogica(escola_id, turma_id, disciplina_id, professor_id, aluno_id, descricao, data_ocorrencia,ano) VALUES ($escola_id, $turma_id, $disciplina_id, $professor_id, $aluno_id, '$descricao', '$data_ocorrencia',$ano_letivo)		
		");	
}

function verifica_ocorrencia_cadastrada($conexao, $iddisciplina, $idturma, $idescola, $idprofessor,$data_ocorrencia,$aluno_id){

	$resultado=$conexao->query(" SELECT * FROM ocorrencia_pedagogica WHERE
		escola_id=$idescola and 
		turma_id=$idturma and 
		aluno_id=$aluno_id and
		data_ocorrencia='$data_ocorrencia' AND (disciplina_id=1 OR disciplina_id=1000)
		
		");

        // and professor_id=$idprofessor
	return $resultado;
	
}

function limpar_ocorrencia_cadastrada($conexao, $iddisciplina, $idturma, $idescola, $idprofessor,$data_ocorrencia,$aluno_id,$ano_letivo){

	$resultado=$conexao->query(" DELETE FROM ocorrencia_pedagogica WHERE
		escola_id=$idescola and 
		turma_id=$idturma and 
		disciplina_id=$iddisciplina and
		aluno_id=$aluno_id and
		data_ocorrencia='$data_ocorrencia' and
		professor_id=$idprofessor and
        ano=$ano_letivo
		
		");
	return $resultado;
	
}


function listar_ocorrencia_cadastrado($conexao, $iddisciplina, $idturma, $idescola, $idprofessor,$ano_letivo){

	$resultado=$conexao->query(" SELECT data_ocorrencia FROM ocorrencia_pedagogica WHERE
		escola_id=$idescola and 
		turma_id=$idturma  and ano='$ano_letivo' and 
        (disciplina_id=1 or disciplina_id=1000)  GROUP BY data_ocorrencia
		
		");
    // and professor_id=$idprofessor
	return $resultado;
	
}

// ***********************************************************************************************

function limpa_parecer_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$idaluno,$idperiodo,$data_nota,$parecer_disciplina_id,$avaliacao){
    $resultado=$conexao->exec(" DELETE FROM nota_parecer WHERE
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
    $conexao->exec(" DELETE FROM nota_parecer WHERE
    	escola_id=$idescola and 
    	turma_id=$idturma and 
    	disciplina_id=$iddisciplina and
    	aluno_id=$idaluno and
    	periodo_id=$idperiodo and 
    	avaliacao='$avaliacao' and 
    	data_nota='$data_nota'
    	");

}


function verifica_parecer_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$idaluno,$idperiodo,$parecer_disciplina_id,$avaliacao,$ano_letivo){
    $resultado=$conexao->query(" SELECT * FROM nota_parecer WHERE
    	escola_id=$idescola and 
        ano_nota=$ano_letivo and 
    	turma_id=$idturma and 
    	disciplina_id=$iddisciplina and
    	aluno_id=$idaluno and
    	periodo_id=$idperiodo and 
    	parecer_disciplina_id=$parecer_disciplina_id and 
    	avaliacao='$avaliacao'
    	");
    return $resultado;
}

function verifica_nota_diario_av3_fund1($conexao,$idescola,$idturma,$iddisciplina,$idaluno,$idperiodo,$avaliacao,$ano_letivo){
    $resultado=$conexao->query(" SELECT * FROM nota_parecer WHERE
    	escola_id=$idescola and 
    	turma_id=$idturma and 
    	disciplina_id=$iddisciplina and
    	aluno_id=$idaluno and
    	periodo_id=$idperiodo and 
        parecer_disciplina_id=0 and
        avaliacao ='$avaliacao' and 
        ano_nota =$ano_letivo

        ");
    return $resultado;
}

function verifica_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$idaluno,$idperiodo,$avaliacao,$ano_letivo){
    $resultado=$conexao->query(" SELECT * FROM nota_parecer WHERE
        escola_id=$idescola and 
        turma_id=$idturma and 
        disciplina_id=$iddisciplina and
        aluno_id=$idaluno and
        periodo_id=$idperiodo and 
        avaliacao ='$avaliacao' and 
        ano_nota = $ano_letivo
        ");
    return $resultado;
}

function verifica_sigla_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$idaluno,$idperiodo,$avaliacao,$parecer_disciplina_id,$ano_letivo){
    $resultado=$conexao->query(" SELECT * FROM nota_parecer WHERE
        escola_id=$idescola and 
        ano_nota=$ano_letivo and 
        turma_id=$idturma and 
        disciplina_id=$iddisciplina and
        aluno_id=$idaluno and
        periodo_id=$idperiodo and 
        avaliacao ='$avaliacao' and 
        parecer_disciplina_id=$parecer_disciplina_id
        ");
    return $resultado;
}


function quantidade_nota_pareceres_individual_diario($conexao,$idescola,$idturma,$iddisciplina,$idaluno,$idperiodo,$avaliacao){
    $resultado=$conexao->query(" SELECT count(*) AS 'quantidade' FROM nota_parecer WHERE
        escola_id=$idescola and 
        turma_id=$idturma and 
        disciplina_id=$iddisciplina and
        aluno_id=$idaluno and
        periodo_id=$idperiodo and 
        avaliacao ='$avaliacao'
        ");
    return $resultado;
}

// ************************************************************************

function listar_parecer_disciplina($conexao,$iddisciplina,$ano_letivo){
    $resultado=$conexao->query("SELECT * FROM parecer_disciplina WHERE
       disciplina_id =$iddisciplina  and status=1  and parecer_disciplina.ano=$ano_letivo ");
    return $resultado->fetchAll();
}


function cadastro_nota($conexao,$nota, $parecer_disciplina_id, $parecer_descritivo, $sigla, $escola_id, $turma_id, $disciplina_id, $aluno_id, $periodo_id, $data_nota,$avaliacao,$funcionario_id,$ano_nota) {
    $conexao->exec("INSERT INTO nota_parecer(nota, parecer_disciplina_id, parecer_descritivo, sigla, escola_id, turma_id, disciplina_id, aluno_id, periodo_id, data_nota,avaliacao,funcionario_id,ano_nota) VALUES ($nota, $parecer_disciplina_id, '$parecer_descritivo', '$sigla', $escola_id, $turma_id, $disciplina_id, $aluno_id, $periodo_id, '$data_nota','$avaliacao',$funcionario_id,$ano_nota)");
  
}

function cadastro_nota_aluno_fora($conexao,$nota, $escola_id, $turma_id, $disciplina_id, $aluno_id, $periodo_id, $avaliacao,$funcionario_id,$escola_origem,$ano_referencia, $serie_id, $carga_horaria, $total_falta,$aluno_finalizou ) {
    $conexao->exec("INSERT INTO nota_parecer
(nota, escola_id, turma_id, disciplina_id, aluno_id, periodo_id, avaliacao,funcionario_id,escola_origem,ano_referencia, serie_id, carga_horaria, total_falta,aluno_finalizou,ano_nota) VALUES

($nota, $escola_id, $turma_id, $disciplina_id, $aluno_id, $periodo_id, '$avaliacao',
    $funcionario_id,'$escola_origem','$ano_referencia', $serie_id, '$carga_horaria', $total_falta,'$aluno_finalizou',$ano_referencia)");


}

function listar_nota_aluno_fora($conexao,$aluno_id) {
    
  $resultado=  $conexao->query("SELECT 
 nota_parecer.idnota as 'idnota',
 aluno.nome as 'nome_aluno',
 nota_parecer.escola_origem as 'escola_origem',
 serie.nome as 'nome_serie',
 escola.nome_escola as 'escola_atual',
 nota_parecer.nota as 'nota',
 periodo.descricao as 'periodo',
 disciplina.nome_disciplina as 'nome_disciplina',
 nota_parecer.avaliacao as 'tipo_avaliacao'

     FROM  
        nota_parecer,serie,aluno,turma,disciplina,escola,periodo
        WHERE 
     nota_parecer.aluno_finalizou !='' and 
     nota_parecer.escola_id=escola.idescola and
     nota_parecer.disciplina_id=disciplina.iddisciplina and
     nota_parecer.aluno_id=aluno.idaluno and
     nota_parecer.serie_id= serie.id and 
     nota_parecer.turma_id= turma.idturma and 
     nota_parecer.periodo_id= periodo.id and 
     nota_parecer.aluno_id=$aluno_id order by serie.nome

     ");

    return $resultado;
}


function excluir_notas_cadastrada_fora($conexao,$idnota) {
    $conexao->exec("DELETE FROM nota_parecer where idnota=$idnota");
}
// ********************************************************************************

function cadastro_conteudo_aula($conexao,$descricao, $disciplina_id, $turma_id, $escola_id, $professor_id, $data,$aula,$ano_conteudo,$quantidade_aula,$funcionario_id) {
    $conexao->exec("INSERT INTO conteudo_aula(descricao, disciplina_id, turma_id, escola_id, professor_id, data,aula,ano_conteudo,quantidade_aula, funcionario_id) VALUES ('$descricao', $disciplina_id, $turma_id, $escola_id, $professor_id, '$data','$aula',$ano_conteudo,$quantidade_aula,$funcionario_id)");
    
}

function editar_conteudo_aula($conexao,$descricao, $idconteudo,$quantidade_aula) {
    $conexao->exec("UPDATE conteudo_aula SET descricao='$descricao', quantidade_aula=$quantidade_aula where id=$idconteudo");
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

function pesquisa_conteudo_aula($conexao, $iddisciplina, $idturma, $idescola, $data,$aula) {
    $sql=$conexao->query("SELECT * FROM conteudo_aula WHERE
      aula='$aula' and 
      data='$data' and 
      disciplina_id=$iddisciplina and 
      escola_id=$idescola and 
      turma_id=$idturma limit 1");
    return $sql; 
}

function verificar_conteudo_aula_em_aluno_trasferido_escola($conexao, $idconteudo,$idescola) {
    $sql=$conexao->query("SELECT count(*) as 'quantidade' FROM frequencia WHERE
      conteudo_aula_id=$idconteudo and 
      escola_id !=$idescola");
    return $sql; 
}


function listar_trimestre($conexao,$ano) {
    $resultado=$conexao->query("SELECT periodo.id , periodo.descricao, calendario_letivo.inicio, calendario_letivo.fim FROM periodo , calendario_letivo where calendario_letivo.periodo_id = periodo.id and calendario_letivo.ano=$ano and periodo.status =1");
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

function listar_conteudo_aula_cadastrado($conexao, $iddisciplina, $idturma, $idescola, $professor_id,$ano_letivo) {
    $resultado=$conexao->query("SELECT * FROM conteudo_aula WHERE
      disciplina_id=$iddisciplina and 
       
      escola_id=$idescola and 
      ano_conteudo=$ano_letivo and 
      turma_id=$idturma order by data, aula ");
    return $resultado;
}
function listar_conteudo_aula_cadastrado_por_data($conexao, $iddisciplina, $idturma, $idescola, $professor_id,$ano_letivo,$inicio,$fim) {
    $resultado=$conexao->query("SELECT * FROM conteudo_aula WHERE
      disciplina_id=$iddisciplina and 
       
      escola_id=$idescola and 
      ano_conteudo=$ano_letivo and 
      turma_id=$idturma and conteudo_aula.data BETWEEN '$inicio' and '$fim'order by data, aula ");
    return $resultado;
}

function listar_conteudo_aula_cadastrado_regente($conexao, $iddisciplina, $idturma, $idescola, $professor_id,$ano_letivo) {
  
    $resultado=$conexao->query("SELECT conteudo_aula.id,data,aula,professor_id FROM conteudo_aula WHERE
      escola_id=$idescola and 
      ano_conteudo=$ano_letivo and 
      turma_id=$idturma  and (professor_id = $professor_id  ) GROUP BY data,aula,conteudo_aula.id order by data, aula ");
    // or professor_id >0
    return $resultado;
}
function listar_conteudo_aula_cadastrado_regente_por_data($conexao, $iddisciplina, $idturma, $idescola, $professor_id,$ano_letivo,$inicio,$fim) {
  
    $resultado=$conexao->query("SELECT conteudo_aula.id,data,aula,professor_id FROM conteudo_aula WHERE
      escola_id=$idescola and 
      ano_conteudo=$ano_letivo and 
      turma_id=$idturma and conteudo_aula.data BETWEEN '$inicio' and '$fim'  GROUP BY data,aula,conteudo_aula.id order by data, aula ");
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

function verificar_conteudo_aula_cadastrado_por_data_aula($conexao, $iddisciplina, $idturma, $idescola, $data,$aula) {
    $resultado=$conexao->query("SELECT * FROM conteudo_aula WHERE
      data='$data' and 
      aula='$aula' and 
      disciplina_id=$iddisciplina and 
      escola_id=$idescola and 
      turma_id=$idturma order by data");
    return $resultado;
}



function excluir_frequencia_lancada($conexao,$conteudo_aula_id,$idprofessor) {
    $conexao->exec("DELETE FROM frequencia WHERE conteudo_aula_id=$conteudo_aula_id 
      ");
    $conexao->exec("DELETE FROM conteudo_aula WHERE
       id=$conteudo_aula_id LIMIT 1
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
    $conexao->exec(" DELETE FROM nota_parecer WHERE
      disciplina_id=$disciplina_id and 
      escola_id=$escola_id and 
      turma_id=$turma_id and
      data_nota='$data_nota' and 
      periodo_id =$periodo_id and 
      avaliacao='$avaliacao'
      ");
    
}

function listar_todas_avaliacao_lancada($conexao,$idescola,$idturma,$iddisciplina,$avaliacao) {
    $resultado=$conexao->query(" SELECT data_nota,escola_id,disciplina_id,turma_id,nota FROM nota_parecer WHERE

      disciplina_id=$iddisciplina and 
      escola_id=$idescola and 
      turma_id=$idturma and avaliacao='$avaliacao' group by data_nota,escola_id,disciplina_id,turma_id,nota ");
    return $resultado;
}

function listar_todas_avaliacao_lancada_parecer($conexao,$idescola,$idturma,$iddisciplina,$avaliacao,$aluno_id,$periodo_id,$ano_nota) {
    $resultado=$conexao->query(" SELECT parecer_descritivo FROM nota_parecer WHERE
      disciplina_id=$iddisciplina and 
      escola_id=$idescola and 
      ano_nota=$ano_nota and 
      turma_id=$idturma and avaliacao='$avaliacao' and aluno_id=$aluno_id and parecer_descritivo !='' and periodo_id=$periodo_id group by parecer_descritivo limit 1  ");
    return $resultado;
}


function listar_avaliacao_lancada($conexao,$idescola,$idturma,$iddisciplina) {
    $resultado=$conexao->query(" SELECT * FROM nota_parecer WHERE

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


function cadastro_frequencia($conexao,$idescola,$idturma,$iddisciplina,$professor_id,$aluno_id,$data_frequencia,$conteudo_aula_id,$presenca,$aula,$ano_frequencia) {
    $conexao->exec(" INSERT INTO frequencia( aluno_id,turma_id, professor_id, data_frequencia, conteudo_aula_id, disciplina_id, escola_id,presenca,aula,ano_frequencia) VALUES (
    	$aluno_id,$idturma, $professor_id, '$data_frequencia', $conteudo_aula_id, $iddisciplina, $idescola,$presenca,'$aula',$ano_frequencia
    )");
   
}

function limpar_cadastro_frequencia($conexao,$idescola,$idturma,$iddisciplina,$professor_id,$data_frequencia,$aula) {
    $conexao->exec(" DELETE FROM frequencia WHERE
      aula='$aula' and 

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
function verificar_frequencia_infantil_fund1($conexao,$idescola,$idturma,$iddisciplina,$professor_id,$data_frequencia,$aluno_id,$aula) {
    $resultado=$conexao->query(" SELECT * FROM frequencia WHERE

      data_frequencia='$data_frequencia' and 
    
      escola_id=$idescola and 
      aula='$aula' and 
      turma_id=$idturma and aluno_id=$aluno_id and presenca=1");
    return $resultado;
}

function verificar_frequencia_na_data($conexao,$idescola,$idturma,$iddisciplina,$professor_id,$data_frequencia,$aula) {
    $resultado=$conexao->query(" SELECT * FROM frequencia WHERE

      data_frequencia='$data_frequencia' and 
      disciplina_id=$iddisciplina and 
      escola_id=$idescola and 
      aula='$aula' and 
      turma_id=$idturma group by data_frequencia");
    return $resultado;
}

function verificar_conteudo_na_data($conexao,$idescola,$idturma,$iddisciplina,$professor_id,$data,$aula) {
    $resultado=$conexao->query(" SELECT data,disciplina_id,escola_id,aula,turma_id FROM conteudo_aula WHERE

      data='$data' and 
      disciplina_id=$iddisciplina and 
      escola_id=$idescola and 
      aula='$aula' and 
      turma_id=$idturma group by data");
    return $resultado;
}

function verificar_frequencia_na_data_conteudo($conexao,$idescola,$idturma,$iddisciplina,$data_frequencia,$aula) {
    $resultado=$conexao->query(" SELECT * FROM frequencia WHERE

      data_frequencia='$data_frequencia' and 
      disciplina_id=$iddisciplina and 
      escola_id=$idescola and 
      aula='$aula' and 
      turma_id=$idturma group by data_frequencia limit 1");
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

function mudar_situacao_aluno($conexao, $matricula, $status, $data) {
 $result = $conexao->exec("UPDATE ecidade_matricula SET datasaida = '$data', matricula_situacao = '$status',matricula_datasaida = '$data', matricula_datamodif = '$data',matricula_ativa = 'N' ,matricula_concluida = 'N' WHERE matricula_codigo = $matricula");
 return $result;
}

function restaurar_situacao_aluno($conexao, $matricula) {
 $result = $conexao->exec("UPDATE ecidade_matricula SET datasaida = 'null', matricula_situacao = 'MATRICULADO',matricula_datasaida = 'null', matricula_datamodif = 'null',matricula_ativa = 'S' ,matricula_concluida = 'N' WHERE matricula_codigo = $matricula");
 return $result;
}

function alterar_foto_aluno($conexao, $nome, $id) {
 $result = $conexao->exec("UPDATE imagem SET nome = '$nome' WHERE id_aluno = $id");
 return $result;
}

function alterar_foto_carterinha_aluno($conexao, $imagem_carteirinha_transporte, $id) {
 $result = $conexao->exec("UPDATE aluno SET imagem_carteirinha_transporte = '$imagem_carteirinha_transporte' WHERE idaluno = $id");
 return $result;
}
	// *****************************************************************************************
function cadastrar_ano_letivo($conexao,$escola_id, $turma_id, $aluno_id, $ano) {
    $sql=$conexao->prepare("INSERT INTO ano_letivo(escola_id, turma_id,  aluno_id, ano) VALUES (:escola_id, :turma_id, :aluno_id, :ano)");
     $sql->bindParam("escola_id",$escola_id);
     $sql->bindParam("turma_id",$turma_id);
     $sql->bindParam("aluno_id",$aluno_id);
     $sql->bindParam("ano",$ano);
     $sql->execute();
}



function cadastrar_ecidade_matricula($conexao, $aluno_id, $turma_id, $matricula_obs, $matricula_tipo, $calendario_ano, $turma_escola, $turno_nome) {

    $sql=$conexao->prepare("INSERT INTO ecidade_matricula(aluno_id, turma_id, matricula_obs, matricula_tipo, calendario_ano, turma_escola,  turno_nome) VALUES (
        :aluno_id,:turma_id,:matricula_obs,:matricula_tipo,:calendario_ano,:turma_escola,:turno_nome)");

   $sql->bindParam("aluno_id",$aluno_id);
   $sql->bindParam("turma_id",$turma_id);
   $sql->bindParam("matricula_obs",$matricula_obs);
   $sql->bindParam("matricula_tipo",$matricula_tipo);
   $sql->bindParam("calendario_ano",$calendario_ano);
   $sql->bindParam("turma_escola",$turma_escola);
   // $sql->bindParam("escola_nome",$escola_nome);
   $sql->bindParam("turno_nome",$turno_nome);

    $sql->execute();
}

function cadastrar_ecidade_movimentacao_escolar($conexao,$matricula_codigo,$aluno_id,$turma_id,$calendario_ano,$escola_id,$escola_nome,$matriculamov_procedimento,$matriculamov_descr) {
    $sql=$conexao->prepare("INSERT INTO ecidade_movimentacao_escolar(matricula_codigo, aluno_id, turma_id, calendario_ano, escola_id, escola_nome, matriculamov_procedimento, matriculamov_descr) VALUES (:matricula_codigo,:aluno_id,:turma_id,:calendario_ano,:escola_id,:escola_nome,:matriculamov_procedimento,:matriculamov_descr)");
        
        $sql->bindParam("matricula_codigo",$matricula_codigo);
        $sql->bindParam("aluno_id",$aluno_id);
        $sql->bindParam("turma_id",$turma_id);
        $sql->bindParam("calendario_ano",$calendario_ano);
        $sql->bindParam("escola_id",$escola_id);
        $sql->bindParam("escola_nome",$escola_nome);
        $sql->bindParam("matriculamov_procedimento",$matriculamov_procedimento);
        $sql->bindParam("matriculamov_descr",$matriculamov_descr);
    $sql->execute();
}
  function saveFile($file) {
    $fileType = $file['type'];
    if ($fileType !== 'application/pdf') {
        return "Erro: Apenas arquivos PDF são permitidos.";
    }

    $uploadDirectory = 'laudo/';

    $fileName = uniqid() . '-' . $file['name'];

    if (move_uploaded_file($file['tmp_name'], $uploadDirectory . $fileName)) {
        return "<br>Arquivo $fileName enviado com sucesso<br>";
    } else {
        return "Erro ao enviar o arquivo.";
    }
  }

function cadastro_aluno($conexao,$nome,
    $sexo,
    $email,
    $filiacao1,
    $filiacao2,
    $senha,
    $whatsapp,
    $whatsapp_responsavel,
    $data_nascimento,

    $numero_nis,
    $codigo_inep,
    $bolsa_familia,
    $tipo_responsavel,
    $raca_aluno,
    $estado_civil_aluno,
    $tipo_sanguinio_aluno,
    $profissao,
    $situacao_documentacao,
    $tipo_certidao,
    $numero_termo,
    $folha,
    $uf_cartorio,
    $municipio_cartorio,
    $nome_cartorio,
    $numero_indentidade,
    $uf_identidade,
    $orgao_emissor_indentidade,
    $data_expedicao,
    $numero_cnh,
    $categoria_cnh,
    $cpf,
    $cartao_sus,
    $observacao,


     $necessidade_especial,
 $apoio_pedagogico,

 $tipo_diagnostico,
 $cpf_filiacao1,
 $cpf_filiacao2,
 $endereco,
 $complemento,
 $numero_endereco,
 $uf_endereco,
 $municipio_endereco,
 $bairro_endereco,
 $zona_endereco,
 $cep_endereco,
 $nacionalidade,
 $pais,
 $naturalidade,
 $localidade,
 $transposte_escolar,
 $poder_publico_responsavel,
 $recebe_escolaridade_outro_espaco,
 $matricula_certidao,
 $uf_municipio_cartorio,
 $cartorio,
 $nome_responsavel,
 $cpf_responsavel,
 $nome_identificacao_social,
 $tamanho_uniforme
) {

    $sql=$conexao->prepare("INSERT INTO aluno(  nome, sexo, email, filiacao1, filiacao2,  senha, whatsapp, whatsapp_responsavel, data_nascimento, numero_nis, codigo_inep, bolsa_familia, tipo_responsavel, raca_aluno, estado_civil_aluno, tipo_sanguinio_aluno, profissao, situacao_documentacao, tipo_certidao, numero_termo, folha, uf_cartorio, municipio_cartorio, nome_cartorio, numero_indentidade, uf_identidade, orgao_emissor_indentidade, data_expedicao, numero_cnh, categoria_cnh, cpf, cartao_sus, observacao, 
necessidade_especial,
 apoio_pedagogico,

 tipo_diagnostico,
 cpf_filiacao1,
 cpf_filiacao2,
 endereco,
 complemento,
 numero_endereco,
 uf_endereco,
 municipio_endereco,
 bairro_endereco,
 zona_endereco,
 cep_endereco,
 nacionalidade,
 pais,
 naturalidade,
 localidade,
 transposte_escolar,
 poder_publico_responsavel,
 recebe_escolaridade_outro_espaco,
 matricula_certidao,
 uf_municipio_cartorio,
 cartorio,
 nome_responsavel,
 tamanho_uniforme,
 cpf_responsavel,
 nome_identificacao_social
 ) VALUES (
    :nome,
    :sexo,
    :email,
    :filiacao1,
    :filiacao2,
    :senha,
    :whatsapp,
    :whatsapp_responsavel,
    :data_nascimento,

    :numero_nis,
    :codigo_inep,
    :bolsa_familia,
    :tipo_responsavel,
    :raca_aluno,
    :estado_civil_aluno,
    :tipo_sanguinio_aluno,
    :profissao,
    :situacao_documentacao,
    :tipo_certidao,
    :numero_termo,
    :folha,
    :uf_cartorio,
    :municipio_cartorio,
    :nome_cartorio,
    :numero_indentidade,
    :uf_identidade,
    :orgao_emissor_indentidade,
    :data_expedicao,
    :numero_cnh,
    :categoria_cnh,
    :cpf,
    :cartao_sus,
    :observacao,

    :necessidade_especial,
    :apoio_pedagogico,

    :tipo_diagnostico,
    :cpf_filiacao1,
    :cpf_filiacao2,
    :endereco,
    :complemento,
    :numero_endereco,
    :uf_endereco,
    :municipio_endereco,
    :bairro_endereco,
    :zona_endereco,
    :cep_endereco,
    :nacionalidade,
    :pais,
    :naturalidade,
    :localidade,
    :transposte_escolar,
    :poder_publico_responsavel,
    :recebe_escolaridade_outro_espaco,
    :matricula_certidao,
    :uf_municipio_cartorio,
    :cartorio,
    :nome_responsavel,
    :tamanho_uniforme,
    :cpf_responsavel,
    :nome_identificacao_social
)");



 $sql->bindParam("nome",$nome);
 $sql->bindParam("sexo",$sexo);
 $sql->bindParam("email",$email);
 $sql->bindParam("filiacao1",$filiacao1);
 $sql->bindParam("filiacao2",$filiacao2);
 $sql->bindParam("senha",$senha);
 $sql->bindParam("whatsapp",$whatsapp);
 $sql->bindParam("whatsapp_responsavel",$whatsapp_responsavel);
 $sql->bindParam("data_nascimento",$data_nascimento);
 $sql->bindParam("numero_nis",$numero_nis);
 $sql->bindParam("codigo_inep",$codigo_inep);
 $sql->bindParam("bolsa_familia",$bolsa_familia);
 $sql->bindParam("tipo_responsavel",$tipo_responsavel);
 $sql->bindParam("raca_aluno",$raca_aluno);
 $sql->bindParam("estado_civil_aluno",$estado_civil_aluno);
 $sql->bindParam("tipo_sanguinio_aluno",$tipo_sanguinio_aluno);
 $sql->bindParam("profissao",$profissao);
 $sql->bindParam("situacao_documentacao",$situacao_documentacao);
 $sql->bindParam("tipo_certidao",$tipo_certidao);
 $sql->bindParam("numero_termo",$numero_termo);
 $sql->bindParam("folha",$folha);
 $sql->bindParam("uf_cartorio",$uf_cartorio);
 $sql->bindParam("municipio_cartorio",$municipio_cartorio);
 $sql->bindParam("nome_cartorio",$nome_cartorio);
 $sql->bindParam("numero_indentidade",$numero_indentidade);
 $sql->bindParam("uf_identidade",$uf_identidade);
 $sql->bindParam("orgao_emissor_indentidade",$orgao_emissor_indentidade);
 $sql->bindParam("data_expedicao",$data_expedicao);
 $sql->bindParam("numero_cnh",$numero_cnh);
 $sql->bindParam("categoria_cnh",$categoria_cnh);
 $sql->bindParam("cpf",$cpf);
 $sql->bindParam("cartao_sus",$cartao_sus);
 $sql->bindParam("observacao",$observacao);


$sql->bindParam("necessidade_especial",$necessidade_especial);
 $sql->bindParam("apoio_pedagogico",$apoio_pedagogico);

 $sql->bindParam("tipo_diagnostico",$tipo_diagnostico);
 $sql->bindParam("cpf_filiacao1",$cpf_filiacao1);
 $sql->bindParam("cpf_filiacao2",$cpf_filiacao2);
 $sql->bindParam("endereco",$endereco);
 $sql->bindParam("complemento",$complemento);
 $sql->bindParam("numero_endereco",$numero_endereco);
 $sql->bindParam("uf_endereco",$uf_endereco);
 $sql->bindParam("municipio_endereco",$municipio_endereco);
 $sql->bindParam("bairro_endereco",$bairro_endereco);
 $sql->bindParam("zona_endereco",$zona_endereco);
 $sql->bindParam("cep_endereco",$cep_endereco);
 $sql->bindParam("nacionalidade",$nacionalidade);
 $sql->bindParam("pais",$pais);
 $sql->bindParam("naturalidade",$naturalidade);
 $sql->bindParam("localidade",$localidade);
 $sql->bindParam("transposte_escolar",$transposte_escolar);
 $sql->bindParam("poder_publico_responsavel",$poder_publico_responsavel);
 $sql->bindParam("recebe_escolaridade_outro_espaco",$recebe_escolaridade_outro_espaco);
 $sql->bindParam("matricula_certidao",$matricula_certidao);
 $sql->bindParam("uf_municipio_cartorio",$uf_municipio_cartorio);
 $sql->bindParam("cartorio", $cartorio);
 $sql->bindParam("nome_responsavel", $nome_responsavel);
 $sql->bindParam("tamanho_uniforme", $tamanho_uniforme);
 $sql->bindParam("cpf_responsavel", $cpf_responsavel);
 $sql->bindParam("nome_identificacao_social", $nome_identificacao_social);
 $sql->execute();
 

 // return $conexao;
}

##############################################################

function cadastro_aluno_migracao($conexao,$idaluno,$nome,
    $sexo,
    $email,
    $filiacao1,
    $filiacao2,
    $senha,
    $whatsapp,
    $whatsapp_responsavel,
    $data_nascimento,

    $numero_nis,
    $codigo_inep,
    $bolsa_familia,
    $tipo_responsavel,
    $raca_aluno,
    $estado_civil_aluno,
    $tipo_sanguinio_aluno,
    $profissao,
    $situacao_documentacao,
    $tipo_certidao,
    $numero_termo,
    $folha,
    $uf_cartorio,
    $municipio_cartorio,
    $nome_cartorio,
    $numero_indentidade,
    $uf_identidade,
    $orgao_emissor_indentidade,
    $data_expedicao,
    $numero_cnh,
    $categoria_cnh,
    $cpf,
    $cartao_sus,
    $observacao,


     $necessidade_especial,
 $apoio_pedagogico,

 $tipo_diagnostico,
 $cpf_filiacao1,
 $cpf_filiacao2,
 $endereco,
 $complemento,
 $numero_endereco,
 $uf_endereco,
 $municipio_endereco,
 $bairro_endereco,
 $zona_endereco,
 $cep_endereco,
 $nacionalidade,
 $pais,
 $naturalidade,
 $localidade,
 $transposte_escolar,
 $poder_publico_responsavel,
 $recebe_escolaridade_outro_espaco,
 $matricula_certidao,
 $uf_municipio_cartorio,
 $cartorio,
 $nome_responsavel,
 $tamanho_uniforme,
 $cpf_responsavel
 

) {

    $sql=$conexao->prepare("INSERT INTO aluno(idaluno,  nome, sexo, email, filiacao1, filiacao2,  senha, whatsapp, whatsapp_responsavel, data_nascimento, numero_nis, codigo_inep, bolsa_familia, tipo_responsavel, raca_aluno, estado_civil_aluno, tipo_sanguinio_aluno, profissao, situacao_documentacao, tipo_certidao, numero_termo, folha, uf_cartorio, municipio_cartorio, nome_cartorio, numero_indentidade, uf_identidade, orgao_emissor_indentidade, data_expedicao, numero_cnh, categoria_cnh, cpf, cartao_sus, observacao, 
necessidade_especial,
 apoio_pedagogico,

 tipo_diagnostico,
 cpf_filiacao1,
 cpf_filiacao2,
 endereco,
 complemento,
 numero_endereco,
 uf_endereco,
 municipio_endereco,
 bairro_endereco,
 zona_endereco,
 cep_endereco,
 nacionalidade,
 pais,
 naturalidade,
 localidade,
 transposte_escolar,
 poder_publico_responsavel,
 recebe_escolaridade_outro_espaco,
 matricula_certidao,
 uf_municipio_cartorio,
 cartorio,
 nome_responsavel,
 tamanho_uniforme,
 cpf_responsavel
 ) VALUES (
    :idaluno,
    :nome,
    :sexo,
    :email,
    :filiacao1,
    :filiacao2,
    :senha,
    :whatsapp,
    :whatsapp_responsavel,
    :data_nascimento,

    :numero_nis,
    :codigo_inep,
    :bolsa_familia,
    :tipo_responsavel,
    :raca_aluno,
    :estado_civil_aluno,
    :tipo_sanguinio_aluno,
    :profissao,
    :situacao_documentacao,
    :tipo_certidao,
    :numero_termo,
    :folha,
    :uf_cartorio,
    :municipio_cartorio,
    :nome_cartorio,
    :numero_indentidade,
    :uf_identidade,
    :orgao_emissor_indentidade,
    :data_expedicao,
    :numero_cnh,
    :categoria_cnh,
    :cpf,
    :cartao_sus,
    :observacao,

    :necessidade_especial,
    :apoio_pedagogico,
  
    :tipo_diagnostico,
    :cpf_filiacao1,
    :cpf_filiacao2,
    :endereco,
    :complemento,
    :numero_endereco,
    :uf_endereco,
    :municipio_endereco,
    :bairro_endereco,
    :zona_endereco,
    :cep_endereco,
    :nacionalidade,
    :pais,
    :naturalidade,
    :localidade,
    :transposte_escolar,
    :poder_publico_responsavel,
    :recebe_escolaridade_outro_espaco,
    :matricula_certidao,
    :uf_municipio_cartorio,
    :cartorio,
    :nome_responsavel,
    :tamanho_uniforme,
    :cpf_responsavel
)");



 $sql->bindParam("idaluno",$idaluno);
 $sql->bindParam("nome",$nome);
 $sql->bindParam("sexo",$sexo);
 $sql->bindParam("email",$email);
 $sql->bindParam("filiacao1",$filiacao1);
 $sql->bindParam("filiacao2",$filiacao2);
 $sql->bindParam("senha",$senha);
 $sql->bindParam("whatsapp",$whatsapp);
 $sql->bindParam("whatsapp_responsavel",$whatsapp_responsavel);
 $sql->bindParam("data_nascimento",$data_nascimento);
 $sql->bindParam("numero_nis",$numero_nis);
 $sql->bindParam("codigo_inep",$codigo_inep);
 $sql->bindParam("bolsa_familia",$bolsa_familia);
 $sql->bindParam("tipo_responsavel",$tipo_responsavel);
 $sql->bindParam("raca_aluno",$raca_aluno);
 $sql->bindParam("estado_civil_aluno",$estado_civil_aluno);
 $sql->bindParam("tipo_sanguinio_aluno",$tipo_sanguinio_aluno);
 $sql->bindParam("profissao",$profissao);
 $sql->bindParam("situacao_documentacao",$situacao_documentacao);
 $sql->bindParam("tipo_certidao",$tipo_certidao);
 $sql->bindParam("numero_termo",$numero_termo);
 $sql->bindParam("folha",$folha);
 $sql->bindParam("uf_cartorio",$uf_cartorio);
 $sql->bindParam("municipio_cartorio",$municipio_cartorio);
 $sql->bindParam("nome_cartorio",$nome_cartorio);
 $sql->bindParam("numero_indentidade",$numero_indentidade);
 $sql->bindParam("uf_identidade",$uf_identidade);
 $sql->bindParam("orgao_emissor_indentidade",$orgao_emissor_indentidade);
 $sql->bindParam("data_expedicao",$data_expedicao);
 $sql->bindParam("numero_cnh",$numero_cnh);
 $sql->bindParam("categoria_cnh",$categoria_cnh);
 $sql->bindParam("cpf",$cpf);
 $sql->bindParam("cartao_sus",$cartao_sus);
 $sql->bindParam("observacao",$observacao);


$sql->bindParam("necessidade_especial",$necessidade_especial);
 $sql->bindParam("apoio_pedagogico",$apoio_pedagogico);

 $sql->bindParam("tipo_diagnostico",$tipo_diagnostico);
 $sql->bindParam("cpf_filiacao1",$cpf_filiacao1);
 $sql->bindParam("cpf_filiacao2",$cpf_filiacao2);
 $sql->bindParam("endereco",$endereco);
 $sql->bindParam("complemento",$complemento);
 $sql->bindParam("numero_endereco",$numero_endereco);
 $sql->bindParam("uf_endereco",$uf_endereco);
 $sql->bindParam("municipio_endereco",$municipio_endereco);
 $sql->bindParam("bairro_endereco",$bairro_endereco);
 $sql->bindParam("zona_endereco",$zona_endereco);
 $sql->bindParam("cep_endereco",$cep_endereco);
 $sql->bindParam("nacionalidade",$nacionalidade);
 $sql->bindParam("pais",$pais);
 $sql->bindParam("naturalidade",$naturalidade);
 $sql->bindParam("localidade",$localidade);
 $sql->bindParam("transposte_escolar",$transposte_escolar);
 $sql->bindParam("poder_publico_responsavel",$poder_publico_responsavel);
 $sql->bindParam("recebe_escolaridade_outro_espaco",$recebe_escolaridade_outro_espaco);
 $sql->bindParam("matricula_certidao",$matricula_certidao);
 $sql->bindParam("uf_municipio_cartorio",$uf_municipio_cartorio);
 $sql->bindParam("cartorio", $cartorio);
 $sql->bindParam("nome_responsavel", $nome_responsavel);
 $sql->bindParam("tamanho_uniforme", $tamanho_uniforme);
 $sql->bindParam("cpf_responsavel", $cpf_responsavel);
 $sql->execute();
}

##############################################################
 

 
function editar_dados_aluno($conexao,$nome,
    $sexo,
    $email,
    $filiacao1,
    $filiacao2,
 
    $whatsapp,
    $whatsapp_responsavel,
    $data_nascimento,

    $numero_nis,
    $codigo_inep,
    $bolsa_familia,
    $tipo_responsavel,
    $raca_aluno,
    $estado_civil_aluno,
    $tipo_sanguinio_aluno,
    $profissao,
    $situacao_documentacao,
    $tipo_certidao,
    $numero_termo,
    $folha,
    $uf_cartorio,
    $municipio_cartorio,
    $nome_cartorio,
    $numero_indentidade,
    $uf_identidade,
    $orgao_emissor_indentidade,
    $data_expedicao,
    $numero_cnh,
    $categoria_cnh,
    $cpf,
    $cartao_sus,
    $observacao,

 $necessidade_especial,
 $apoio_pedagogico,

 $tipo_diagnostico,
 $cpf_filiacao1,
 $cpf_filiacao2,
 $endereco,
 $complemento,
 $numero_endereco,
 $uf_endereco,
 $municipio_endereco,
 $bairro_endereco,
 $zona_endereco,
 $cep_endereco,
 $nacionalidade,
 $pais,
 $naturalidade,
 $localidade,
 $transposte_escolar,
 $poder_publico_responsavel,
 $recebe_escolaridade_outro_espaco,
 $matricula_certidao,
 $uf_municipio_cartorio,
 $cartorio,
 $idaluno,

 $nome_responsavel,
 $tamanho_uniforme,
 $cpf_responsavel
) {

    $sql=$conexao->prepare("UPDATE aluno SET 
        nome= :nome, sexo=:sexo, email=:email, filiacao1=:filiacao1, filiacao2=:filiacao2, whatsapp = :whatsapp, whatsapp_responsavel=:whatsapp_responsavel, data_nascimento=:data_nascimento, numero_nis= :numero_nis, codigo_inep=:codigo_inep, bolsa_familia=:bolsa_familia, tipo_responsavel=:tipo_responsavel, raca_aluno= :raca_aluno, estado_civil_aluno=:estado_civil_aluno, tipo_sanguinio_aluno=:tipo_sanguinio_aluno, profissao= :profissao, situacao_documentacao=:situacao_documentacao, tipo_certidao=:tipo_certidao, numero_termo=:numero_termo, folha=:folha, uf_cartorio=:uf_cartorio, municipio_cartorio=:municipio_cartorio, nome_cartorio=:nome_cartorio, numero_indentidade=:numero_indentidade, uf_identidade=:uf_identidade, orgao_emissor_indentidade=:orgao_emissor_indentidade, data_expedicao=:data_expedicao, numero_cnh=:numero_cnh, categoria_cnh=:categoria_cnh, cpf=:cpf, cartao_sus=:cartao_sus, observacao=:observacao, 
necessidade_especial=:necessidade_especial,
 apoio_pedagogico=:apoio_pedagogico,

 tipo_diagnostico=:tipo_diagnostico,
 cpf_filiacao1=:cpf_filiacao1,
 cpf_filiacao2=:cpf_filiacao2,
 endereco=:endereco,
 complemento=:complemento,
 numero_endereco=:numero_endereco,
 uf_endereco=:uf_endereco,
 municipio_endereco=:municipio_endereco,
 bairro_endereco=:bairro_endereco,
 zona_endereco=:zona_endereco,
 cep_endereco=:cep_endereco,
 nacionalidade=:nacionalidade,
 pais=:pais,
 naturalidade=:naturalidade,
 localidade=:localidade,
 transposte_escolar=:transposte_escolar,
 poder_publico_responsavel=:poder_publico_responsavel,
 recebe_escolaridade_outro_espaco=:recebe_escolaridade_outro_espaco,
 matricula_certidao=:matricula_certidao,
 uf_municipio_cartorio=:uf_municipio_cartorio,
 cartorio=:cartorio,
 nome_responsavel= :nome_responsavel,
 tamanho_uniforme= :tamanho_uniforme,
 cpf_responsavel = :cpf_responsavel

 WHERE idaluno=:idaluno

");



 $sql->bindParam("nome",$nome);
 $sql->bindParam("sexo",$sexo);
 $sql->bindParam("email",$email);
 $sql->bindParam("filiacao1",$filiacao1);
 $sql->bindParam("filiacao2",$filiacao2);
 $sql->bindParam("whatsapp",$whatsapp);
 $sql->bindParam("whatsapp_responsavel",$whatsapp_responsavel);
 $sql->bindParam("data_nascimento",$data_nascimento);
 $sql->bindParam("numero_nis",$numero_nis);
 $sql->bindParam("codigo_inep",$codigo_inep);
 $sql->bindParam("bolsa_familia",$bolsa_familia);
 $sql->bindParam("tipo_responsavel",$tipo_responsavel);
 $sql->bindParam("raca_aluno",$raca_aluno);
 $sql->bindParam("estado_civil_aluno",$estado_civil_aluno);
 $sql->bindParam("tipo_sanguinio_aluno",$tipo_sanguinio_aluno);
 $sql->bindParam("profissao",$profissao);
 $sql->bindParam("situacao_documentacao",$situacao_documentacao);
 $sql->bindParam("tipo_certidao",$tipo_certidao);
 $sql->bindParam("numero_termo",$numero_termo);
 $sql->bindParam("folha",$folha);
 $sql->bindParam("uf_cartorio",$uf_cartorio);
 $sql->bindParam("municipio_cartorio",$municipio_cartorio);
 $sql->bindParam("nome_cartorio",$nome_cartorio);
 $sql->bindParam("numero_indentidade",$numero_indentidade);
 $sql->bindParam("uf_identidade",$uf_identidade);
 $sql->bindParam("orgao_emissor_indentidade",$orgao_emissor_indentidade);
 $sql->bindParam("data_expedicao",$data_expedicao);
 $sql->bindParam("numero_cnh",$numero_cnh);
 $sql->bindParam("categoria_cnh",$categoria_cnh);
 $sql->bindParam("cpf",$cpf);
 $sql->bindParam("cartao_sus",$cartao_sus);
 $sql->bindParam("observacao",$observacao);


$sql->bindParam("necessidade_especial",$necessidade_especial);
 $sql->bindParam("apoio_pedagogico",$apoio_pedagogico);
 $sql->bindParam("tipo_diagnostico",$tipo_diagnostico);
 $sql->bindParam("cpf_filiacao1",$cpf_filiacao1);
 $sql->bindParam("cpf_filiacao2",$cpf_filiacao2);
 $sql->bindParam("endereco",$endereco);
 $sql->bindParam("complemento",$complemento);
 $sql->bindParam("numero_endereco",$numero_endereco);
 $sql->bindParam("uf_endereco",$uf_endereco);
 $sql->bindParam("municipio_endereco",$municipio_endereco);
 $sql->bindParam("bairro_endereco",$bairro_endereco);
 $sql->bindParam("zona_endereco",$zona_endereco);
 $sql->bindParam("cep_endereco",$cep_endereco);
 $sql->bindParam("nacionalidade",$nacionalidade);
 $sql->bindParam("pais",$pais);
 $sql->bindParam("naturalidade",$naturalidade);
 $sql->bindParam("localidade",$localidade);
 $sql->bindParam("transposte_escolar",$transposte_escolar);
 $sql->bindParam("poder_publico_responsavel",$poder_publico_responsavel);
 $sql->bindParam("recebe_escolaridade_outro_espaco",$recebe_escolaridade_outro_espaco);
 $sql->bindParam("matricula_certidao",$matricula_certidao);
 $sql->bindParam("uf_municipio_cartorio",$uf_municipio_cartorio);
 $sql->bindParam("cartorio", $cartorio);
 $sql->bindParam("nome_responsavel", $nome_responsavel);
 $sql->bindParam("cpf_responsavel", $cpf_responsavel);
 $sql->bindParam("idaluno", $idaluno);
 $sql->execute();

 // return $conexao;
}

	



function meus_dados_aluno($conexao,$idaluno){
  $res=$conexao->query("SELECT * FROM aluno where idaluno = $idaluno ");
  return $res;
}	

function dados_aluno($conexao,$idaluno){
  $res=$conexao->query("SELECT imagem.nome as 'foto', aluno.nome as 'nome',aluno.idaluno as 'idaluno', aluno.whatsapp, aluno.email,aluno.senha, aluno.whatsapp_responsavel FROM aluno,imagem where  id_aluno=idaluno and idaluno = $idaluno  ORDER by nome ASC");
  return $res;
} 

function pesquisar_dados_aluno_por_id($conexao,$idaluno){
  $res=$conexao->query("SELECT * FROM aluno WHERE aluno.idaluno =$idaluno");

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
  $res=$conexao->query("SELECT aluno.senha,aluno.email,aluno.nome as 'nome_aluno', aluno.idaluno, aluno.status as 'status_aluno', turma.nome_turma FROM aluno, ano_letivo,turma where ano_letivo.status_letivo=1 AND turma_id=$idturma and aluno_id=idaluno and turma_id=idturma and aluno.status='Ativo' ORDER by nome ASC");
  return $res;
}

function listar_aluno_da_turma_coordenador($conexao,$idturma,$idescola){
  $res=$conexao->query("SELECT turma.nome_turma, aluno.senha,aluno.email,aluno.nome as 'nome_aluno', aluno.idaluno, aluno.status as 'status_aluno', turma.nome_turma FROM aluno, ano_letivo,turma where ano_letivo.status_letivo=1 AND turma_id=$idturma and aluno_id=idaluno and turma_id=idturma and escola_id=$idescola  ORDER by nome ASC");
  return $res;
}
 ///
function listar_aluno_da_turma_professor($conexao, $idturma, $escola_id) {
        $stmt = $conexao->prepare("SELECT aluno.senha, aluno.email, aluno.nome as nome_aluno, aluno.idaluno, aluno.status as status_aluno, turma.nome_turma, ano_letivo.etapa_id 
        FROM aluno
        JOIN ano_letivo ON aluno.ano_letivo_id = ano_letivo.idano_letivo
        JOIN turma ON aluno.turma_id = turma.idturma
        WHERE ano_letivo.status_letivo = 1
        AND turma_id = ?
        AND escola_id = ?
        AND status = 'Ativo'
        ORDER BY nome_aluno ASC");
    
     $stmt->execute(array($idturma, $escola_id));

    return $stmt->fetchAll();
}


// function listar_aluno_da_turma_professor($conexao,$idturma,$escola_id){
//   $res=$conexao->query("SELECT aluno.senha,aluno.email,aluno.nome as 'nome_aluno', aluno.idaluno, aluno.status as 'status_aluno', turma.nome_turma,ano_letivo.etapa_id FROM aluno, ano_letivo,turma where 
//         ano_letivo.status_letivo=1 AND
//    turma_id=$idturma and aluno_id=idaluno and turma_id=idturma and escola_id=$escola_id and status like'Ativo' ORDER by nome ASC");
//   return $res;
// }	
///

function pesquisar_aluno_da_turma_ata_resultado_final($conexao, $matricula, $ano_letivo) {
    $stmt = $conexao->prepare("SELECT 
        m.matricula_situacao as 'procedimento',
        m.datasaida,
        m.destinosaida
        FROM ecidade_matricula m
        WHERE m.matricula_codigo = ?
        AND m.calendario_ano = ?
        AND m.matricula_situacao NOT IN ('MATRICULADO', 'REMATRICULAR ALUNO')");
    
   
     $stmt->execute(array($matricula, $ano_letivo));

    return $stmt->fetchAll();

  
}

// function pesquisar_aluno_da_turma_ata_resultado_final($conexao,$matricula,$ano_letivo){
//   $res=$conexao->query("SELECT 
//         ecidade_matricula.matricula_situacao as 'procedimento',

//         ecidade_matricula.datasaida as 'datasaida',
//         ecidade_matricula.destinosaida as 'destinosaida',
//         ecidade_matricula.matricula_situacao as 'procedimento'
// FROM
// ecidade_matricula

// WHERE 
// ecidade_matricula.matricula_codigo=$matricula and 
// ecidade_matricula.calendario_ano ='$ano_letivo' and 
// ecidade_matricula.matricula_situacao !='MATRICULADO' 
// AND ecidade_matricula.matricula_situacao !='REMATRICULAR ALUNO' 
//  ");
  
//   return $res;
// }

function pesquisar_aluno_da_turma_listagem($conexao,$matricula,$ano_letivo){
  $res=$conexao->query("SELECT 
        ecidade_matricula.matricula_situacao as 'procedimento',

        ecidade_matricula.datasaida as 'datasaida',
        ecidade_matricula.destinosaida as 'destinosaida',
        ecidade_matricula.matricula_situacao as 'procedimento'
FROM
ecidade_matricula

WHERE 
ecidade_matricula.matricula_codigo=$matricula and 
ecidade_matricula.calendario_ano ='$ano_letivo' 
AND ecidade_matricula.matricula_situacao !='REMATRICULAR ALUNO' 
 ");
  
  return $res;
} 


// function pesquisar_aluno_da_turma_ata_resultado_final($conexao,$matricula,$_SESSION['ano_letivo']){
//   $res=$conexao->query("SELECT 
//         aluno.nome as 'nome_aluno',
//         aluno.idaluno,
       
//         ecidade_movimentacao_escolar.matriculamov_dataevento AS 'data_evento',
//         ecidade_movimentacao_escolar.matriculamov_descr as 'descricao_procedimento',
//         ecidade_movimentacao_escolar.matricula_codigo as 'matricula',
        
//         ecidade_matricula.matricula_situacao as 'procedimento',

//         ecidade_matricula.datasaida as 'datasaida',
//         ecidade_matricula.destinosaida as 'destinosaida',
//         ecidade_matricula.matricula_situacao as 'procedimento'
// FROM
// ecidade_movimentacao_escolar,
// aluno,escola,ecidade_matricula

// WHERE 
// ecidade_matricula.aluno_id= aluno.idaluno AND
// ecidade_matricula.matricula_codigo = ecidade_movimentacao_escolar.matricula_codigo and 
 
// ecidade_movimentacao_escolar.escola_id = escola.idescola and 
// ecidade_matricula.matricula_codigo=$matricula and 

// ecidade_matricula.calendario_ano ='2021' and 

// ecidade_matricula.matricula_situacao !='MATRICULADO' 
// AND ecidade_matricula.matricula_situacao !='REMATRICULAR ALUNO' 
 
//  ORDER by aluno.nome ASC");
  
//   return $res;
// } 

// function listar_aluno_da_turma_ata_resultado_final($conexao,$aluno_id,$turma_id,$escola_id){
//   $res=$conexao->query("SELECT 
//         aluno.nome as 'nome_aluno',
//         aluno.idaluno,
//         turma.nome_turma,
//         ecidade_movimentacao_escolar.matriculamov_dataevento AS 'data_evento',
//         ecidade_movimentacao_escolar.matriculamov_descr as 'descricao_procedimento',
//         ecidade_movimentacao_escolar.matricula_codigo as 'matricula',
        
//         ecidade_matricula.matricula_situacao as 'procedimento',

//         ecidade_matricula.datasaida as 'datasaida',
//         ecidade_matricula.destinosaida as 'destinosaida',
//         ecidade_matricula.matricula_situacao as 'procedimento'
// FROM
// ecidade_movimentacao_escolar,
// aluno,turma,escola,ecidade_matricula

// WHERE 
// ecidade_matricula.aluno_id= aluno.idaluno AND
// ecidade_matricula.matricula_codigo = ecidade_movimentacao_escolar.matricula_codigo and 
 
// ecidade_movimentacao_escolar.escola_id = escola.idescola and 
// ecidade_movimentacao_escolar.escola_id=$escola_id and
// ecidade_movimentacao_escolar.turma_id=$turma_id and
// ecidade_movimentacao_escolar.aluno_id=$aluno_id and

// ecidade_matricula.calendario_ano ='2021' and 
// ecidade_matricula.matricula_situacao !='MATRICULADO' 
// AND 
// aluno.status like'Ativo' ORDER by aluno.nome ASC");
  
//   return $res;
// } 



function listar_aluno_da_escola_carteirinha($conexao,$escola_id,$idturma,$ano_letivo){
//     ecidade_matricula.matricula_concluida='N' and
// ecidade_matricula.matricula_ativa='S' and
  $res=$conexao->query("
    SELECT 
aluno.nome as 'nome_aluno',
aluno.linha_transporte,
aluno.imagem_carteirinha_transporte ,
escola.nome_escola,
aluno.sexo,
aluno.data_nascimento,
aluno.cpf as cpf_aluno,
aluno.whatsapp_responsavel,
aluno.nome_responsavel,
aluno.idaluno,
aluno.email,
aluno.status as 'status_aluno',
turma.nome_turma,

ecidade_matricula.matricula_codigo as 'matricula',
ecidade_matricula.matricula_datamatricula as 'data_matricula',
ecidade_matricula.datasaida as 'datasaida'

FROM
 ecidade_matricula,
aluno,turma,escola

where
$idturma 
ecidade_matricula.aluno_id= aluno.idaluno AND
ecidade_matricula.turma_id = turma.idturma and 
ecidade_matricula.turma_escola = escola.idescola and 
ecidade_matricula.calendario_ano ='$ano_letivo' and 
 

ecidade_matricula.turma_escola=$escola_id and
ecidade_matricula.matricula_situacao !='CANCELADO' and
ecidade_matricula.matricula_ativa ='S' and
aluno.aluno_transpublico=1  ORDER by aluno.nome ASC");


   return $res;
} 



function pesquisar_por_nome_carteirinha_escola($conexao,$nome_aluno,$ano_letivo){
 
  $res=$conexao->query("
    SELECT 
aluno.nome as 'nome_aluno',
aluno.linha_transporte,
aluno.imagem_carteirinha_transporte ,
escola.nome_escola,
aluno.sexo,
aluno.data_nascimento,
aluno.cpf as cpf_aluno,
aluno.whatsapp_responsavel,
aluno.nome_responsavel,
aluno.idaluno,
aluno.email,
aluno.status as 'status_aluno',
turma.nome_turma,

ecidade_matricula.matricula_codigo as 'matricula',
ecidade_matricula.matricula_datamatricula as 'data_matricula',
ecidade_matricula.datasaida as 'datasaida'

FROM
 ecidade_matricula,
aluno,turma,escola

where
ecidade_matricula.aluno_id= aluno.idaluno AND
ecidade_matricula.turma_id = turma.idturma and 
ecidade_matricula.turma_escola = escola.idescola and 
ecidade_matricula.calendario_ano ='$ano_letivo' and 
 
ecidade_matricula.matricula_situacao !='CANCELADO' and
ecidade_matricula.matricula_ativa ='S' and
aluno.aluno_transpublico=1 and aluno.nome LIKE '%$nome_aluno%'  ORDER by aluno.nome ASC");


   return $res;
} 
function pesquisar_id_carteirinha_escola($conexao,$nome_aluno,$ano_letivo,$idaluno){
 
  $res=$conexao->query("
    SELECT 
aluno.nome as 'nome_aluno',
aluno.linha_transporte,
aluno.imagem_carteirinha_transporte ,
escola.nome_escola,
aluno.sexo,
aluno.data_nascimento,
aluno.cpf as cpf_aluno,
aluno.whatsapp_responsavel,
aluno.nome_responsavel,
aluno.idaluno,
aluno.email,
aluno.status as 'status_aluno',
turma.nome_turma,

ecidade_matricula.matricula_codigo as 'matricula',
ecidade_matricula.matricula_datamatricula as 'data_matricula',
ecidade_matricula.datasaida as 'datasaida'

FROM
 ecidade_matricula,
aluno,turma,escola

where
ecidade_matricula.aluno_id= aluno.idaluno AND
ecidade_matricula.turma_id = turma.idturma and 
ecidade_matricula.turma_escola = escola.idescola and 
ecidade_matricula.calendario_ano ='$ano_letivo' and 
 
ecidade_matricula.matricula_situacao !='CANCELADO' and
ecidade_matricula.matricula_ativa ='S' and
aluno.aluno_transpublico=1 and aluno.idaluno IN($idaluno)  ORDER by aluno.nome ASC");


   return $res;
} 

function listar_aluno_da_turma_ata_resultado_final($conexao,$turma_id,$escola_id,$ano_letivo){
  $res=$conexao->query("
    SELECT
    aluno.laudo, 
    
    aluno.aluno_transpublico, 
    aluno.linha_transporte,
    aluno.imagem_carteirinha_transporte ,
     UPPER(aluno.nome) AS nome_aluno,
    UPPER(aluno.nome_identificacao_social) AS nome_identificacao_social,
    aluno.sexo,
    aluno.data_nascimento,
    aluno.idaluno,
    aluno.email,
    aluno.status AS status_aluno,
    aluno.senha,
    turma.nome_turma,
    ecidade_matricula.matricula_codigo AS matricula,
    ecidade_matricula.matricula_datamatricula AS data_matricula,
    ecidade_matricula.datasaida AS datasaida
FROM ecidade_matricula
INNER JOIN aluno ON ecidade_matricula.aluno_id = aluno.idaluno
INNER JOIN turma ON ecidade_matricula.turma_id = turma.idturma
INNER JOIN escola ON ecidade_matricula.turma_escola = escola.idescola
WHERE ecidade_matricula.turma_escola = $escola_id
  AND ecidade_matricula.turma_id = $turma_id
  AND ecidade_matricula.calendario_ano = '$ano_letivo'
  AND ecidade_matricula.matricula_situacao != 'CANCELADO'
ORDER BY aluno.nome ASC");


   return $res;
} 


function listar_aluno_da_turma_avaliacao($conexao,$turma_id,$escola_id,$ano_letivo){
  $res=$conexao->query("
    SELECT
    aluno.aluno_transpublico, 
    aluno.linha_transporte,
    aluno.imagem_carteirinha_transporte ,
    aluno.nome AS nome_aluno,
    aluno.nome_identificacao_social AS nome_identificacao_social,
    aluno.sexo,
    aluno.data_nascimento,
    aluno.idaluno,
    aluno.email,
    aluno.status AS status_aluno,
    aluno.senha,
    turma.nome_turma,
    ecidade_matricula.matricula_codigo AS matricula,
    ecidade_matricula.matricula_datamatricula AS data_matricula,
    ecidade_matricula.datasaida AS datasaida
FROM ecidade_matricula
INNER JOIN aluno ON ecidade_matricula.aluno_id = aluno.idaluno
INNER JOIN turma ON ecidade_matricula.turma_id = turma.idturma
INNER JOIN escola ON ecidade_matricula.turma_escola = escola.idescola
WHERE ecidade_matricula.turma_escola = $escola_id
  AND ecidade_matricula.turma_id = $turma_id
  AND ecidade_matricula.calendario_ano = '$ano_letivo'
  AND ecidade_matricula.matricula_situacao = 'MATRICULADO'
ORDER BY aluno.nome ASC");


   return $res;
} 





function listar_aluno_da_turma_ata_resultado_final_matricula_concluida($conexao,$turma_id,$escola_id,$ano_letivo){
  $res=$conexao->query("
    SELECT 
    aluno.laudo, 
    aluno.aluno_transpublico, 
    aluno.linha_transporte,
    aluno.imagem_carteirinha_transporte,
    UPPER(aluno.nome) AS nome_aluno,
    UPPER(aluno.nome_identificacao_social) AS nome_identificacao_social,

    aluno.sexo,
    aluno.data_nascimento,
    aluno.idaluno,
    aluno.email,
    aluno.status AS status_aluno,
    aluno.senha,
    turma.nome_turma,
    ecidade_matricula.matricula_codigo AS matricula,
    ecidade_matricula.matricula_datamatricula AS data_matricula,
    ecidade_matricula.datasaida AS datasaida
FROM ecidade_matricula
INNER JOIN aluno ON ecidade_matricula.aluno_id = aluno.idaluno
INNER JOIN turma ON ecidade_matricula.turma_id = turma.idturma
INNER JOIN escola ON ecidade_matricula.turma_escola = escola.idescola
WHERE ecidade_matricula.turma_escola = $escola_id
  AND ecidade_matricula.turma_id = $turma_id
  AND ecidade_matricula.calendario_ano = '$ano_letivo'
  AND ecidade_matricula.matricula_situacao <> 'CANCELADO'
ORDER BY aluno.nome ASC
  ");


   return $res;

}



function listar_aluno_da_turma_avaliacao_matricula_concluida($conexao,$turma_id,$escola_id,$ano_letivo){
  $res=$conexao->query("
    SELECT 
    aluno.aluno_transpublico, 
    aluno.linha_transporte,
    aluno.imagem_carteirinha_transporte,
    aluno.nome AS nome_aluno,
    aluno.nome_identificacao_social AS nome_identificacao_social,

    aluno.sexo,
    aluno.data_nascimento,
    aluno.idaluno,
    aluno.email,
    aluno.status AS status_aluno,
    aluno.senha,
    turma.nome_turma,
    ecidade_matricula.matricula_codigo AS matricula,
    ecidade_matricula.matricula_datamatricula AS data_matricula,
    ecidade_matricula.datasaida AS datasaida
FROM ecidade_matricula
INNER JOIN aluno ON ecidade_matricula.aluno_id = aluno.idaluno
INNER JOIN turma ON ecidade_matricula.turma_id = turma.idturma
INNER JOIN escola ON ecidade_matricula.turma_escola = escola.idescola
WHERE ecidade_matricula.turma_escola = $escola_id
  AND ecidade_matricula.turma_id = $turma_id
  AND ecidade_matricula.calendario_ano = '$ano_letivo'
  AND ecidade_matricula.matricula_situacao = 'MATRICULADO'
ORDER BY aluno.nome ASC
  ");


   return $res;

}





function listar_aluno_do_simulado_professor($conexao,$escola_id,$idserie,$indice){
  $res=$conexao->query("SELECT aluno.senha,aluno.email,aluno.nome as 'nome_aluno', aluno.idaluno, aluno.status as 'status_aluno', turma.nome_turma,turma.idturma
   FROM 
   aluno, ano_letivo,turma where
        ano_letivo.status_letivo=1 AND
   serie_id=$idserie and aluno_id=idaluno and turma_id=idturma and escola_id=$escola_id and status like'Ativo' ORDER by turma.nome_turma, nome ASC limit $indice,50");
  return $res;
}	


	// function listar_aluno_do_simulado_professor($conexao,$escola_id,$idserie){
	// 	$res=$conexao->query("SELECT aluno.senha,aluno.email,aluno.nome as 'nome_aluno', aluno.idaluno, aluno.status as 'status_aluno', turma.nome_turma,turma.idturma
	// 	 FROM 
	// 		aluno, ano_letivo,turma where
	// 		 serie_id=$idserie and aluno_id=idaluno and turma_id=idturma and escola_id=$escola_id and status like'Ativo' ORDER by nome ASC");
	// 	return $res;
	// }

function listar_disciplina_aluno($conexao,$idaluno,$ano_letivo){
  // $res=$conexao->query("SELECT 
  //  disciplina.nome_disciplina,
  //  disciplina.iddisciplina,
  //  funcionario.nome as 'nome_professor',
  //  turma.idturma,
  //  turma.nome_turma
  //  FROM turma, ecidade_matricula, aluno , escola, ministrada,disciplina,funcionario WHERE
  //  aluno.idaluno=ecidade_matricula.aluno_id AND
  //  turma.idturma=ecidade_matricula.turma_id AND
  //  escola.idescola=ecidade_matricula.turma_escola AND

  //  ministrada.turma_id=turma.idturma AND
  //  ministrada.escola_id=escola.idescola AND
  //  ministrada.disciplina_id=disciplina.iddisciplina AND
  //  ministrada.professor_id=funcionario.idfuncionario AND
  //  ecidade_matricula.calendario_ano='$ano_letivo' AND
  //  aluno.idaluno = $idaluno limit 1");
  //  
  //  
  $res=$conexao->query("WITH  
    ref AS (
    SELECT
        turma.idturma as id_turma,
        turma.nome_turma,
        ecidade_matricula.calendario_ano as ano,    
        escola.idescola as id_escola
    FROM
        aluno
    INNER JOIN ecidade_matricula ON ecidade_matricula.aluno_id = aluno.idaluno AND ecidade_matricula.calendario_ano = '$ano_letivo'
    INNER JOIN turma ON turma.idturma = ecidade_matricula.turma_id
    INNER JOIN escola ON escola.idescola = ecidade_matricula.turma_escola
    WHERE
        aluno.idaluno = $idaluno
    )
    
    
    SELECT 
    
        disciplina.nome_disciplina,
        disciplina.iddisciplina,
        funcionario.nome as 'nome_professor',
        ministrada.turma_id,
        (SELECT ref.nome_turma FROM ref) as nome_turma
    
    FROM ministrada 
    
    INNER JOIN disciplina ON ministrada.disciplina_id=disciplina.iddisciplina
    INNER JOIN funcionario ON ministrada.professor_id=funcionario.idfuncionario
   
    WHERE ministrada.turma_id= (SELECT ref.id_turma FROM ref) and ministrada.ano= (SELECT ref.ano FROM ref) and ministrada.escola_id =(SELECT ref.id_escola FROM ref)");
  return $res;
}


function listar_disciplina_para_relatorio($conexao,$idturmas,$escola_id,$ano_letivo){
  $res=$conexao->query("
  SELECT
disciplina.nome_disciplina,
disciplina.abreviacao,
disciplina.iddisciplina,
funcionario.nome as nome_professor,
turma.idturma,
turma.nome_turma
FROM
ministrada
INNER JOIN turma ON ministrada.turma_id = turma.idturma
INNER JOIN escola ON ministrada.escola_id = escola.idescola
INNER JOIN disciplina ON ministrada.disciplina_id = disciplina.iddisciplina
INNER JOIN funcionario ON ministrada.professor_id = funcionario.idfuncionario
WHERE
disciplina.facultativo = 0
AND ministrada.ano = $ano_letivo
AND ministrada.escola_id = $escola_id AND ministrada.turma_id $idturmas ");


return $res;

 


}


function listar_disciplina_para_boletim($conexao,$idturma,$escola_id,$ano_letivo){
  $res=$conexao->query("
  SELECT
disciplina.nome_disciplina,
disciplina.abreviacao,
disciplina.iddisciplina,
funcionario.nome as nome_professor,
turma.idturma,
turma.nome_turma
FROM
ministrada
INNER JOIN turma ON ministrada.turma_id = turma.idturma
INNER JOIN escola ON ministrada.escola_id = escola.idescola
INNER JOIN disciplina ON ministrada.disciplina_id = disciplina.iddisciplina
INNER JOIN funcionario ON ministrada.professor_id = funcionario.idfuncionario
WHERE
disciplina.facultativo = 0
AND ministrada.ano = $ano_letivo
AND ministrada.turma_id = $idturma
AND ministrada.escola_id = $escola_id");


return $res;

}


function listar_disciplina_para_nota_geral($conexao,$idturma,$escola_id,$ano_letivo,$idfuncionario){
  $res=$conexao->query("
  SELECT
disciplina.nome_disciplina,
disciplina.abreviacao,
disciplina.iddisciplina,
funcionario.nome as nome_professor,
turma.idturma,
turma.nome_turma
FROM
ministrada
INNER JOIN turma ON ministrada.turma_id = turma.idturma
INNER JOIN escola ON ministrada.escola_id = escola.idescola
INNER JOIN disciplina ON ministrada.disciplina_id = disciplina.iddisciplina
INNER JOIN funcionario ON ministrada.professor_id = funcionario.idfuncionario
WHERE
disciplina.facultativo = 0
AND ministrada.ano = $ano_letivo
AND ministrada.turma_id = $idturma
AND ministrada.escola_id = $escola_id 
AND ministrada.professor_id = $idfuncionario");


return $res;

}



function listar_disciplina_para_ata($conexao,$escola_id,$idturma,$ano_letivo){
    

  $res=$conexao->query("SELECT disciplina.nome_disciplina, 
           disciplina.abreviacao, 
           disciplina.iddisciplina, 
           funcionario.nome AS nome_professor, 
           turma.idturma, 
           turma.nome_turma, 
           carga_horaria.CH AS carga_horaria 
    FROM carga_horaria 
    JOIN turma ON carga_horaria.serie_id = turma.serie_id 
    JOIN disciplina ON carga_horaria.disciplina_id = disciplina.iddisciplina 
    JOIN ministrada ON ministrada.disciplina_id = disciplina.iddisciplina 
    JOIN escola ON ministrada.escola_id = escola.idescola 
    JOIN funcionario ON ministrada.professor_id = funcionario.idfuncionario 
    WHERE ministrada.turma_id = turma.idturma 
      AND ministrada.ano = $ano_letivo 
      AND disciplina.facultativo = 0 
      AND turma.idturma = $idturma 
      AND escola.idescola = $escola_id 
    ORDER BY disciplina.ordem ASC;
   ");
  return $res;
  // SELECT 
  //  disciplina.nome_disciplina,
  //  disciplina.abreviacao,
  //  disciplina.iddisciplina,
  //  funcionario.nome as 'nome_professor',
  //  turma.idturma,
  //  turma.nome_turma,
  //  carga_horaria.CH AS 'carga_horaria'

  //  FROM carga_horaria, turma,   escola, ministrada,disciplina,funcionario WHERE
  //   carga_horaria.serie_id=turma.serie_id AND
  //   carga_horaria.disciplina_id=disciplina.iddisciplina AND
    
  //   ministrada.turma_id=turma.idturma AND
  //  ministrada.escola_id=escola.idescola AND
  //  ministrada.disciplina_id=disciplina.iddisciplina AND
  //  ministrada.professor_id=funcionario.idfuncionario AND
  //  ministrada.ano=$ano_letivo AND
  //  disciplina.facultativo=0 AND
  //  turma.idturma = $idturma and
  //  escola.idescola = $escola_id order by disciplina.ordem asc
}


function alterar_status_carteirinha_transporte($conexao,$idaluno, $status, $linha_transporte){
  $sql=$conexao->prepare("UPDATE aluno set aluno_transpublico= :status, linha_transporte= :linha_transporte WHERE idaluno = :idaluno");
  
  $sql->bindParam("status",$status);
  $sql->bindParam("linha_transporte",$linha_transporte);
  $sql->bindParam("idaluno",$idaluno);
  
  $sql->execute();

}