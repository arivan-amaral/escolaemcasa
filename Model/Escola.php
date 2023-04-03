<?php 
function verifica_dia_letivo($conexao,$data){
   $sql = $conexao->query("SELECT * from dia_nao_letivo where data='$data'
      ");
   return $sql->fetchAll();
}

function listar_calendario_letivo($conexao){
   $sql = $conexao->query("SELECT * from calendario_letivo   order by calendario_letivo.inicio ASC
      ");
   return $sql->fetchAll();
}

function pesquisar_escola2($conexao,$id) {
   $sql = $conexao->prepare("SELECT * FROM escola where idescola = :id");
   $sql->execute(array('id' =>$id));
   return $sql->fetchAll();
}

function verificar_bloqueio_funcionario($conexao,$idcalendario,$funcionario_id,$status){
   $sql = $conexao->query("SELECT * from bloquear_acesso  where funcionario_id = $funcionario_id and calendario_letivo_id=$idcalendario and status=$status
      ");
   return $sql->fetchAll();
}

 function pesquisa_matricula_mensal($conexao,$escola,$serie_id,$ano){
    $sql = "SELECT *
            FROM ecidade_matricula
            INNER JOIN turma ON turma.idturma = ecidade_matricula.turma_id
            WHERE 
               $escola AND
               $serie_id 
              AND ecidade_matricula.matricula_situacao = 'MATRICULADO' 
              
              AND ecidade_matricula.calendario_ano = $ano  
            ORDER BY turma.nome_turma ASC";
// echo "$sql";
       $stmt = $conexao->query($sql);
       // $stmt->bindValue(':serie_id', $serie_id, PDO::PARAM_INT);
       // $stmt->bindValue(':escola', $escola, PDO::PARAM_STR);
       // $stmt->bindValue(':ano', $ano, PDO::PARAM_INT);
       // $stmt->execute();
       $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
       return $resultados;
 }
 

// function pesquisa_matricula_mensal($conexao,$escola,$serie_id,$ano){
//    $sql = $conexao->query("SELECT * from ecidade_matricula, turma  where 
//       turma.idturma = turma_id and
//       turma.serie_id = $serie_id and
//        matricula_situacao ='MATRICULADO' AND
//         turma_escola='$escola' and
//          calendario_ano = $ano  
//          order by nome_turma asc");
//    return $sql->fetchAll();
// }




function pesquisa_relatorio_filtro($conexao,$texto,$sexo,$escola,$ano_letivo,$ordenacao,$necessidade_especial){
   $sql = $conexao->query("SELECT $texto FROM aluno,ecidade_matricula,escola,turma WHERE ecidade_matricula.aluno_id = aluno.idaluno AND ecidade_matricula.turma_escola = escola.idescola AND ecidade_matricula.turma_id = turma.idturma AND ecidade_matricula.calendario_ano='$ano_letivo' AND ecidade_matricula.matricula_ativa='S' AND ecidade_matricula.matricula_concluida='N' AND aluno.sexo = '$sexo'  AND ecidade_matricula.turma_escola=$escola $necessidade_especial ORDER BY $ordenacao ");
   
   return $sql->fetchAll();
}
function pesquisa_relatorio_filtro_todos($conexao,$texto,$escola,$ano_letivo, $necessidade_especial){
   $sql = $conexao->query("SELECT $texto FROM aluno,ecidade_matricula,escola,turma WHERE ecidade_matricula.aluno_id = aluno.idaluno AND ecidade_matricula.turma_escola = escola.idescola AND ecidade_matricula.turma_id = turma.idturma AND ecidade_matricula.calendario_ano='$ano_letivo' AND ecidade_matricula.matricula_ativa='S' AND ecidade_matricula.matricula_concluida='N'   AND ecidade_matricula.turma_escola=$escola $necessidade_especial ORDER BY escola.nome_escola ASC, turma.nome_turma ASC, aluno.nome asc;");
   
   return $sql->fetchAll();
}
function pesquisa_relatorio_filtro_quantidade_sexo($conexao,$escola,$ano_letivo,$idturma, $necessidade_especial){
   $sql = $conexao->query("SELECT aluno.sexo, count(*) as 'quantidade' FROM aluno,ecidade_matricula,escola,turma WHERE ecidade_matricula.aluno_id = aluno.idaluno AND ecidade_matricula.turma_escola = escola.idescola AND ecidade_matricula.turma_id = turma.idturma AND ecidade_matricula.calendario_ano='$ano_letivo' AND ecidade_matricula.matricula_ativa='S'AND ecidade_matricula.matricula_ativa='S' and ecidade_matricula.turma_id='$idturma'  AND ecidade_matricula.matricula_concluida='N'   AND ecidade_matricula.turma_escola=$escola  $necessidade_especial GROUP BY aluno.sexo ORDER BY  aluno.sexo ASC;");
   
   return $sql->fetchAll();
}


function pesquisa_aluno_mensal($conexao,$escola){
   $sql = $conexao->query("SELECT count(*) as 'id' from ecidade_matricula  where matricula_situacao ='MATRICULADO' AND turma_escola='$escola'");
   return $sql->fetchAll();
}

function pesquisa_matricula_mensal_todos($conexao,$escola){
   $sql = $conexao->query("SELECT * from ecidade_matricula  where matricula_situacao = 'MATRICULADO' AND turma_escola = $escola ");
   return $sql->fetchAll();
}

function total_alunos_escola($conexao,$escola){
   $sql = $conexao->query("SELECT count(*) as 'alunos' from ecidade_matricula  where matricula_situacao = 'MATRICULADO' AND turma_escola = $escola AND matricula_ativa = 'S' AND calendario_ano = '2022' ");
   return $sql->fetchAll();
}

function pesquisa_matricula_mensal_quant($conexao,$data_inicial,$data_final,$escola,$idturma){
   $sql = $conexao->query("SELECT count(*) as 'alunos' from ecidade_matricula  where  $escola AND matricula_situacao = 'MATRICULADO'  AND turma_id = $idturma AND matricula_datamatricula BETWEEN '$data_inicial' AND '$data_final'");
   return $sql->fetchAll();
}
function pesquisa_matricula_mensal_quant_anterior($conexao,$escola,$idturma,$ano_letivo){
   $sql = $conexao->query("SELECT count(*) as 'alunos' from ecidade_matricula  where 
       $escola AND
      matricula_situacao = 'MATRICULADO' AND
    
      turma_id = $idturma and calendario_ano='$ano_letivo'");
   return $sql->fetchAll();
}

function pesquisa_matricula_mensal_quant_todos($conexao,$escola,$idturma){
   $sql = $conexao->query("SELECT count(*) as 'alunos' from ecidade_matricula  where matricula_situacao = 'MATRICULADO' AND turma_escola = $escola AND turma_id = $idturma AND matricula_datamatricula");
   return $sql->fetchAll();
}


function pesquisa_escola($conexao){
   $sql = $conexao->query("SELECT * from escola ORDER by nome_escola asc");
   return $sql->fetchAll();
}

function pesquisa_turma($conexao,$turma){
   $sql = $conexao->query("SELECT * from turma where idturma = '$turma' ORDER by nome_turma asc ");
   return $sql->fetchAll();
}

function pesquisa_serie($conexao,$idserie){
   $sql = $conexao->query("SELECT * from serie where id = '$idserie' ORDER by nome asc");
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

function listar_data_por_periodo_ano($conexao,$ano,$periodo_id){
   $sql = $conexao->query("SELECT calendario_letivo.id as 'idcalendario' from calendario_letivo,periodo WHERE
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

function lista_solicitacao_transferencia_recebida($conexao,$visualizada,$aceita, $sql_escolas){
   $sql = $conexao->query("SELECT 
              solicitacao_transferencia.id as 'idsolicitacao',
              solicitacao_transferencia.matricula as 'matricula_aluno',
              aluno.idaluno,
              aluno.nome,
              data_solicitacao,
              solicitacao_transferencia.observacao,
              solicitacao_transferencia.turma_id_origem,
              escola_id_origem,
              escola_id,
              serie_id,
              serie.nome as 'nome_serie',
              aceita
               from  funcionario,aluno,escola,solicitacao_transferencia,serie WHERE 
      aluno_id=idaluno and
      funcionario.idfuncionario = profissional_solicitante and 
      solicitacao_transferencia.serie_id = serie.id and 
      escola_id=idescola 
       and visualizada= $visualizada   $sql_escolas ) order by solicitacao_transferencia.aceita asc,solicitacao_transferencia.id desc limit 200
      ");
   return $sql->fetchAll();
}
function lista_solicitacao_transferencia_enviada($conexao,$visualizada, $sql_escolas){
   $sql = $conexao->query("SELECT * from  funcionario,aluno,escola,solicitacao_transferencia WHERE 
      aluno_id=idaluno and
      funcionario.idfuncionario = profissional_solicitante and 
      escola_id_origem=idescola 
       and visualizada= $visualizada  $sql_escolas ) order by solicitacao_transferencia.aceita asc, solicitacao_transferencia.id desc limit 200
      ");
   return $sql->fetchAll();
}

function quantidade_solicitacao_transferencia_enviada_por_escola($conexao,$aceita, $sql_escolas){
   $sql = $conexao->query("SELECT COUNT(*) as 'quantidade' from  aluno,escola,solicitacao_transferencia WHERE 
      aluno_id=idaluno and
      escola_id_origem=idescola  and
       aceita = $aceita 
        $sql_escolas ) order by solicitacao_transferencia.id desc 
      ");
   return $sql->fetchAll();
}
function quantidade_solicitacao_transferencia_recebida_por_escola($conexao,$aceita, $sql_escolas){
   $sql = $conexao->query("SELECT COUNT(*) as 'quantidade' from aluno,escola,solicitacao_transferencia WHERE 
      aluno_id=idaluno and
      escola_id=idescola  and
       aceita = $aceita 
        $sql_escolas ) order by solicitacao_transferencia.id desc 
      ");
   return $sql->fetchAll();
}


               
function rejeitar_solicitacao_transferencia($conexao,$profissional_resposta,$idsolicitacao,$resposta_solicitacao,$aceita){
   $sql = $conexao->prepare("UPDATE solicitacao_transferencia SET profissional_resposta= :profissional_resposta , aceita= :aceita, resposta_solicitacao=:resposta_solicitacao WHERE id = :idsolicitacao ");

   $sql->bindParam('profissional_resposta',$profissional_resposta);
   $sql->bindParam('aceita',$aceita);
   $sql->bindParam('idsolicitacao',$idsolicitacao);
   $sql->bindParam('resposta_solicitacao',$resposta_solicitacao);
   $sql->execute();
}  

function retornar_aluno_apos_transferencia_rejeitada($conexao,$matricula_codigo){
   $sql = $conexao->prepare("UPDATE ecidade_matricula SET 
      datasaida= '' ,
       matricula_ativa='S', 
       matricula_concluida='N',
       matricula_situacao='MATRICULADO'

       WHERE matricula_codigo = :matricula_codigo ");

   $sql->bindParam('matricula_codigo',$matricula_codigo);
 
   $sql->execute();
}  

 function aceitar_solicitacao_transferencia($conexao,$profissional_resposta,$idsolicitacao,$aceita){
   $sql = $conexao->prepare("UPDATE solicitacao_transferencia SET profissional_resposta= :profissional_resposta , aceita= :aceita WHERE id = :idsolicitacao ");

   $sql->bindParam('profissional_resposta',$profissional_resposta);
   $sql->bindParam('aceita',$aceita);
   $sql->bindParam('idsolicitacao',$idsolicitacao);
   $sql->execute();
}   


function migrar_notas_transferencia($conexao,$nova_turma,$nova_escola, $aluno_id , $antiga_escola, $antiga_turma, $ano_nota){
   $sql = $conexao->prepare("UPDATE nota_parecer SET 
      turma_id= ? , escola_id = ? 
      where aluno_id= ? and escola_id= ? and turma_id= ? and ano_nota= ? ");

   
   $sql->execute(array($nova_turma,$nova_escola, $aluno_id, $antiga_escola , $antiga_turma, $ano_nota));
}  
               
function solicitacao_transferencia($conexao,$matricula,$aluno_id, $serie_id,
$profissional_solicitante,
$escola_id,
$observacao,$ano_letivo,$ano_letivo_vigente,$aceita,$escola_id_origem,$turma_id_origem){
   $sql = $conexao->prepare("INSERT INTO solicitacao_transferencia(aluno_id, serie_id, profissional_solicitante,  escola_id,   observacao, ano_letivo,ano_letivo_vigente,matricula,aceita,escola_id_origem,turma_id_origem) VALUES ( :aluno_id, :serie_id, :profissional_solicitante,  :escola_id,:observacao,:ano_letivo,:ano_letivo_vigente,:matricula,:aceita,:escola_id_origem,:turma_id_origem)
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
   $sql->bindParam('escola_id_origem',$escola_id_origem);
   $sql->bindParam('turma_id_origem',$turma_id_origem);

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


function rematricular_aluno($conexao,$aluno_id,$turma_id,$turma_id_anterior,$matricula_situacao,$matricula_concluida,$matricula_datamatricula,$matricula_ativa,$matricula_tipo,$calendario_ano,$turma_escola,$turno_nome,$etapa){
   $sql = $conexao->prepare("INSERT INTO ecidade_matricula( aluno_id, turma_id, turma_id_anterior,  matricula_situacao, matricula_concluida,  matricula_datamatricula,  matricula_ativa, matricula_tipo,   calendario_ano, turma_escola, turno_nome, etapa) VALUES (:aluno_id,:turma_id,:turma_id_anterior,:matricula_situacao,:matricula_concluida,:matricula_datamatricula,:matricula_ativa,:matricula_tipo,:calendario_ano,:turma_escola,:turno_nome,:etapa)
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
$sql->bindParam("etapa",$etapa);

   $sql->execute();
}



function mudar_situacao_rematricular_aluno($conexao,$matricula_codigo){
   $sql = $conexao->prepare("UPDATE ecidade_matricula set matricula_concluida='S', matricula_ativa='N' where matricula_codigo =:matricula_codigo
      ");
   $sql->bindParam("matricula_codigo",$matricula_codigo);
   $sql->execute();
}

function mudar_situacao_transferencia_aluno($conexao,$matricula_codigo,$procedimento,$data_saida){
   $sql = $conexao->prepare("UPDATE ecidade_matricula set matricula_concluida='S', matricula_ativa='N', matricula_situacao='$procedimento', datasaida='$data_saida'where matricula_codigo =:matricula_codigo
      ");
   $sql->bindParam("matricula_codigo",$matricula_codigo);
   $sql->execute();
}


function mudar_situacao_transferencia_aluno_aceita($conexao,$matricula_codigo,$procedimento,$data_saida){
   $sql = $conexao->prepare("UPDATE ecidade_matricula set matricula_concluida='S', matricula_ativa='N' , matricula_situacao='$procedimento', datasaida='$data_saida' where matricula_codigo =:matricula_codigo
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

function buscar_escola_por_nome($conexao,$nome_escola){
   $result = $conexao->query("SELECT * FROM escola where nome_escola like '%$nome_escola%'");
    return $result;
  
}

?>