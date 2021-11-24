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
$observacao){
   $sql = $conexao->prepare("INSERT INTO solicitacao_transferencia(aluno_id, serie_id, profissional_solicitante,  escola_id,   observacao) VALUES ( :aluno_id, :serie_id, :profissional_solicitante,  :escola_id,:observacao)
      ");

   $sql->bindParam('aluno_id',$aluno_id);
   $sql->bindParam('serie_id',$serie_id);
   $sql->bindParam('profissional_solicitante',$profissional_solicitante);
   $sql->bindParam('escola_id',$escola_id);
 
   $sql->bindParam('observacao',$observacao);

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