<?php 
function pesquisar_solicitacao_transferencia_por_escola($conexao,$visualizada,$aceita, $sql_escolas){
   $sql = $conexao->query("SELECT * from  funcionario,aluno,escola,solicitacao_transferencia WHERE 
      aluno_id=idaluno and
      funcionario.idfuncionario = profissional_solicitante and 
      escola_id=idescola 
       and visualizada= $visualizada and aceita = $aceita  $sql_escolas ) order by solicitacao_transferencia.id desc 
      ");



   return $sql->fetchAll();
}

function solicitacao_transferencia($conexao,$aluno_id, $serie_id,
$profissional_solicitante,
$escola_id,
$observacao,$ano_letivo,$ano_letivo_vigente){
   $sql = $conexao->prepare("INSERT INTO solicitacao_transferencia(aluno_id, serie_id, profissional_solicitante,  escola_id,   observacao, ano_letivo,ano_letivo_vigente) VALUES ( :aluno_id, :serie_id, :profissional_solicitante,  :escola_id,:observacao,:ano_letivo,:ano_letivo_vigente)
      ");

   $sql->bindParam('aluno_id',$aluno_id);
   $sql->bindParam('serie_id',$serie_id);
   $sql->bindParam('profissional_solicitante',$profissional_solicitante);
   $sql->bindParam('escola_id',$escola_id);
 
   $sql->bindParam('observacao',$observacao);
   $sql->bindParam('ano_letivo',$ano_letivo);
   $sql->bindParam('ano_letivo_vigente',$ano_letivo_vigente);

   $sql->execute();
}


function rematricular_aluno($conexao,$aluno_id,$turma_id,$turma_id_anterior,$matricula_situacao,$matricula_concluida,$matricula_datamatricula,$matricula_ativa,$matricula_tipo,$calendario_ano,$turma_escola,$turno_nome){
   $sql = $conexao->prepare("INSERT INTO ecidade_matricula( aluno_id, turma_id, turma_id_anterior,  matricula_situacao, matricula_concluida,  matricula_datamatricula,  matricula_ativa, matricula_tipo,   calendario_ano, turma_escola, turno_nome) VALUES (:aluno_id,:turma_id,:turma_id_anterior,:matricula_situacao,:matricula_concluida,:matricula_datamatricula,:matricula_ativa,:matricula_tipo,:calendario_ano,:turma_escola,:turno_nome)
      ");

$sql->bindParam("aluno_id",$aluno_id);
$sql->bindParam("turma_id",$turma_id);
$sql->bindParam("turma_id_anterior",$turma_id_anterior);
$sql->bindParam("matricula_situacao",$matricula_situacao);
$sql->bindParam("matricula_concluida",$matricula_concluida);

$sql->bindParam("matricula_datamatricula",$matricula_datamatricula);
$sql->bindParam("matricula_ativa",$matricula_ativa);
$sql->bindParam("matricula_tipo",$matricula_tipo);
 
$sql->bindParam("calendario_ano",$calendario_ano);
$sql->bindParam("turma_escola",$turma_escola);
$sql->bindParam("turno_nome",$turno_nome);

   $sql->execute();
}



function mudar_situacao_rematricular_aluno($conexao,$matricula_codigo){
   $sql = $conexao->prepare("UPDATE ecidade_matricula set matricula_concluida='S', matricula_ativa='N' where matricula_codigo =:matricula_codigo
      ");
   $sql->bindParam("matricula_codigo",$matricula_codigo);
   $sql->execute();
}






function desassociar_coordenador($conexao, $id){
   $result = $conexao->exec("DELETE FROM relacionamento_funcionario_escola where idrelacionamento_funcionario_escola=$id");
}

function lista_escola($conexao){
   $result = $conexao->query("SELECT * FROM escola  ORDER BY nome_escola asc");
    return $result;
  
}
function buscar_escola_por_id($conexao,$id){
   $result = $conexao->query("SELECT * FROM escola  where idescola=$id");
    return $result;
  
}


?>