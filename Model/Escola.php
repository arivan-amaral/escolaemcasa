<?php 
function listar_calendario_letivo($conexao){
   $sql = $conexao->query("SELECT * from calendario_letivo   order by calendario_letivo.inicio ASC
      ");
   return $sql->fetchAll();
}
function verificar_bloqueio_funcionario($conexao,$idcalendario,$funcionario_id,$status){
   $sql = $conexao->query("SELECT * from bloquear_acesso  where funcionario_id = $funcionario_id and calendario_letivo_id=$idcalendario and status=$status
      ");
   return $sql->fetchAll();
}

function desativa_bloqueio_funcionario($conexao,$idcalendario,$funcionario_id,$funcionario_responsavel,$status){
   $conexao->exec("UPDATE bloquear_acesso SET status=$status, funcionario_responsavel=$funcionario_responsavel  where funcionario_id = $funcionario_id and calendario_letivo_id=$idcalendario and status=1
      "); 
}
function ativa_bloqueio_funcionario($conexao,$idcalendario,$funcionario_id,$funcionario_responsavel){
  
   $conexao->exec("INSERT INTO bloquear_acesso(funcionario_id, calendario_letivo_id, funcionario_responsavel) VALUES($funcionario_id,$idcalendario,$funcionario_responsavel)");
 
}

function listar_data_periodo($conexao,$ano){
   $sql = $conexao->query("SELECT * from calendario_letivo WHERE ano='$ano' order by calendario_letivo.periodo_id ASC
      ");
   return $sql->fetchAll();
}

function listar_data_por_periodo($conexao,$ano,$periodo_id){
   $sql = $conexao->query("SELECT * from calendario_letivo,periodo WHERE
      calendario_letivo.periodo_id=periodo.id and 
    ano='$ano' and periodo_id=$periodo_id order by calendario_letivo.periodo_id ASC
      ");
   return $sql->fetchAll();
}

function listar_calendario_por_data($conexao,$data){
   $sql = $conexao->query("
      SELECT calendario_letivo.id as 'idcalendario' from 
      calendario_letivo,
      periodo 
      WHERE
         calendario_letivo.periodo_id=periodo.id and 
         '$data' BETWEEN  calendario_letivo.inicio and calendario_letivo.fim
      ");
   return $sql->fetchAll();
}

function pesquisar_solicitacao_transferencia_por_aluno($conexao,$matricula,$aceita){
   $sql = $conexao->query("SELECT * from solicitacao_transferencia WHERE matricula=$matricula and aceita =$aceita
      ");
   return $sql->fetchAll();
}

function pesquisar_solicitacao_transferencia_por_escola($conexao,$visualizada,$aceita, $sql_escolas){
   $sql = $conexao->query("SELECT * from  funcionario,aluno,escola,solicitacao_transferencia WHERE 
      aluno_id=idaluno and
      funcionario.idfuncionario = profissional_solicitante and 
      escola_id=idescola 
       and visualizada= $visualizada and aceita = $aceita  $sql_escolas ) order by solicitacao_transferencia.id desc 
      ");



   return $sql->fetchAll();
}

               
function solicitacao_transferencia($conexao,$matricula,$aluno_id, $serie_id,
$profissional_solicitante,
$escola_id,
$observacao,$ano_letivo,$ano_letivo_vigente,$aceita){
   $sql = $conexao->prepare("INSERT INTO solicitacao_transferencia(aluno_id, serie_id, profissional_solicitante,  escola_id,   observacao, ano_letivo,ano_letivo_vigente,matricula,aceita) VALUES ( :aluno_id, :serie_id, :profissional_solicitante,  :escola_id,:observacao,:ano_letivo,:ano_letivo_vigente,:matricula,:aceita)
      ");

   $sql->bindParam('aluno_id',$aluno_id);
   $sql->bindParam('serie_id',$serie_id);
   $sql->bindParam('profissional_solicitante',$profissional_solicitante);
   $sql->bindParam('escola_id',$escola_id);
 
   $sql->bindParam('observacao',$observacao);
   $sql->bindParam('ano_letivo',$ano_letivo);
   $sql->bindParam('ano_letivo_vigente',$ano_letivo_vigente);
   $sql->bindParam('matricula',$matricula);
   $sql->bindParam('aceita',$aceita);

   $sql->execute();
}  

function verificar_solicitacao_tranferencia(
   $conexao,$aluno_id,$ano_letivo_vigente,$aceita){

   $sql = $conexao->prepare("SELECT * FROM solicitacao_transferencia 
      WHERE 
        aluno_id= :aluno_id and
        ano_letivo_vigente= :ano_letivo_vigente and
       
        aceita= :aceita
      ");

   $sql->bindParam('aluno_id',$aluno_id);
   $sql->bindParam('ano_letivo_vigente',$ano_letivo_vigente);
 
   $sql->bindParam('aceita',$aceita);
   $sql->execute();

   return $sql->fetchAll();
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