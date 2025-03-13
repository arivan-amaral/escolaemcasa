<?php  

function buscar_chamada($conexao,$setor_id){
   $result = $conexao->query("SELECT * FROM chamada where setor_id=$setor_id and (status ='em_andamento' or status='esperando_resposta')  ORDER BY id asc");
    return $result;

}

function buscar_chamada_em_andamento($conexao,$setor_id){
   $result = $conexao->query("SELECT * FROM chamada where setor_id=$setor_id and status ='em_andamento'  ORDER BY id asc");
    return $result;

}

function pesquisar_chamado($conexao,$chamado_id){
   $result = $conexao->query("SELECT * FROM chamada where id=$chamado_id");
    return $result;

}

function pesquisar_mensagens($conexao,$id_funcionario){
   $result = $conexao->query("SELECT * FROM mensagem_chamado where enviado=$id_funcionario");
    return $result;

}

function pesquisar_mensagens_quant($conexao,$id_funcionario){
   $result = $conexao->query("SELECT count(*) as 'mensagens' FROM mensagem_chamado where enviado=$id_funcionario");
    return $result;

}

function pesquisar_mensagens_quant_menu($conexao,$id_funcionario){
   $result = $conexao->query("SELECT count(*) as 'mensagens' FROM mensagem_chamado where enviado=$id_funcionario and status = ''");
    return $result;

}

function pesquisar_resposta_mensagens($conexao,$id_mensagem){
   $result = $conexao->query("SELECT * FROM resposta_mensagem_chamado where id_mensagem=$id_mensagem");
    return $result;

}

function quant_resposta($conexao,$id_mensagem){
   $result = $conexao->query("SELECT count(*) as 'resposta' FROM resposta_mensagem_chamado where id_mensagem=$id_mensagem");
    return $result;

}

function quant_mensagens($conexao,$id_funcionario){
   $result = $conexao->query("SELECT count(*) as 'mensagens' FROM mensagem_chamado where enviado=$id_funcionario");
    return $result;

}
function pesquisar_chamado_status($conexao,$chamado_id){
   $result = $conexao->query("SELECT * FROM chamada where status like '%$chamado_id%' order by data desc ");
    return $result;

}

function pesquisar_chamado_status_data($conexao,$chamado_id,$data_inicial,$data_final){
   $result = $conexao->query("SELECT chamada.id,chamada.funcionario_id,chamada.setor_id,chamada.status,chamada.tipo_solicitacao,chamada.func_respondeu_id, chamada.data_previsao FROM chamada,chat_chamado where chamada.status like '%$chamado_id%'and chat_chamado.status = 'inicial' and chamada.id = chat_chamado.chamada_id and chat_chamado.data BETWEEN '$data_inicial' AND '$data_final'");
    return $result;

}

function pesquisar_chamado_setor($conexao,$chamado_id){
   $result = $conexao->query("SELECT * FROM chamada where setor_id=$chamado_id order by data desc ");
    return $result;

}

function pesquisar_chamado_setor_data($conexao,$chamado_id,$data_inicial,$data_final){
   $result = $conexao->query("SELECT chamada.id,chamada.funcionario_id,chamada.setor_id,chamada.status,chamada.tipo_solicitacao,chamada.func_respondeu_id, chamada.data_previsao FROM chamada,chat_chamado where chamada.setor_id=$chamado_id and chat_chamado.status = 'inicial' and chamada.id = chat_chamado.chamada_id and chat_chamado.data BETWEEN '$data_inicial' AND '$data_final'");
    return $result;

}

function pesquisar_chamado_escola($conexao,$chamado_id){
   $result = $conexao->query("SELECT * FROM chamada where tipo_solicitacao=$chamado_id and setor_id = '11' order by data desc ");
    return $result;

}

function pesquisar_chamado_escola_data($conexao,$chamado_id,$data_inicial,$data_final){
   $result = $conexao->query("SELECT chamada.id,chamada.funcionario_id,chamada.setor_id,chamada.status,chamada.tipo_solicitacao
,chamada.func_respondeu_id, chamada.data_previsao FROM 
chamada,chat_chamado where chamada.tipo_solicitacao=$chamado_id and chamada.setor_id = '11'and chat_chamado.status = 'inicial'
and chamada.id = chat_chamado.chamada_id and chat_chamado.data BETWEEN '$data_inicial' AND '$data_final' order by chamada.data desc ");
    return $result;

}


function pesquisar_chamado_data_solicitante($conexao,$data_inicial,$data_final){
   $result = $conexao->query("SELECT * FROM chat_chamado where status = 'inicial' and data BETWEEN '$data_inicial' AND '$data_final' ");
    return $result;

}


function pesquisar_chamado_data_retorno($conexao,$data_inicial,$data_final){
   $result = $conexao->query("SELECT * FROM chamada where data_previsao BETWEEN '$data_inicial' AND '$data_final' ");
    return $result;

}

function pesquisar_chamado_solicitante($conexao,$chamado_id){
   $result = $conexao->query("SELECT * FROM chamada where funcionario_id=$chamado_id order by data desc ");
    return $result;

}

function pesquisar_chamado_solicitante_data($conexao,$chamado_id,$data_inicial,$data_final){
   $result = $conexao->query("SELECT chamada.id,chamada.funcionario_id,chamada.setor_id,chamada.status,chamada.tipo_solicitacao,chamada.func_respondeu_id, chamada.data_previsao FROM chamada,chat_chamado where chamada.funcionario_id = $chamado_id and chat_chamado.status = 'inicial' and chamada.id = chat_chamado.chamada_id and chamada.funcionario_id = chat_chamado.funcionario_id and chat_chamado.data BETWEEN '$data_inicial' AND '$data_final'");
    return $result;

}

function pesquisar_chamado_retorno($conexao,$chamado_id){
   $result = $conexao->query("SELECT * FROM chamada where func_respondeu_id = $chamado_id");
    return $result;

}

function pesquisar_chamado_retorno_data($conexao,$chamado_id,$data_inicial,$data_final){
   $result = $conexao->query("SELECT chamada.id,chamada.funcionario_id,chamada.setor_id,chamada.status,chamada.tipo_solicitacao,chamada.func_respondeu_id, chamada.data_previsao FROM chamada,chat_chamado where chamada.func_respondeu_id=$chamado_id and chat_chamado.status = 'inicial' and chamada.id = chat_chamado.chamada_id and chat_chamado.data BETWEEN '$data_inicial' AND '$data_final'");
    return $result;

}

function pesquisar_todos_chamado($conexao,$idfuncionario){
   $result = $conexao->query("SELECT * FROM chamada where funcionario_id=$idfuncionario order by data desc ");
    return $result;

}

function buscar_arquivos($conexao,$chamado_id){
   $result = $conexao->query("SELECT * FROM arquivos_chamado where chamado_id=$chamado_id");
    return $result;

}

function verificar_arquivos($conexao,$chamado_id){
   $result = $conexao->query("SELECT count(*) as 'id' FROM arquivos_chamado where chamado_id=$chamado_id");
    return $result;

}

function quant_novos_usuario($conexao,$usuario_id){
   $result = $conexao->query("SELECT count(*) as 'chamadas' FROM chamada where funcionario_id=$usuario_id and status = 'esperando_resposta'");
    return $result;

}

function quant_andamento_usuario($conexao,$usuario_id){
   $result = $conexao->query("SELECT count(*) as 'chamadas' FROM chamada where funcionario_id=$usuario_id and status = 'em_andamento'");
    return $result;

}

function quant_atrasado_usuario($conexao,$usuario_id){
   $result = $conexao->query("SELECT count(*) as 'chamadas' FROM chamada where funcionario_id=$usuario_id and status = 'atrasado'");
    return $result;

}

function quant_finalizado_usuario($conexao,$usuario_id){
   $result = $conexao->query("SELECT count(*) as 'chamadas' FROM chamada where funcionario_id=$usuario_id and status = 'finalizado'");
    return $result;

}

function buscar_chamada_atraso($conexao,$setor_id){
   $result = $conexao->query("SELECT * FROM chamada where setor_id=$setor_id and status ='em_andamento' ORDER BY id asc");
    return $result;

}


function buscar_chamada2($conexao,$setor_id){
   $result = $conexao->query("SELECT * FROM chamada where setor_id=$setor_id and (status ='em_andamento' or status='esperando_resposta' or status ='atrasado')  ORDER BY id asc");
    return $result;

}

function buscar_chamada_escola($conexao,$setor_id,$escola_id){
   $result = $conexao->query("SELECT * FROM chamada where setor_id=$setor_id and (status ='em_andamento' or status='esperando_resposta' or status ='atrasado') and tipo_solicitacao = $escola_id  ORDER BY id asc");
    return $result;

}

function buscar_chamada_atraso2_escola($conexao,$setor_id,$escola_id){
   $result = $conexao->query("SELECT * FROM chamada where setor_id=$setor_id and status ='atrasado' and tipo_solicitacao = $escola_id  ORDER BY id asc");
    return $result;

}

function buscar_chamada_andamento_escola($conexao,$setor_id,$escola_id){
   $result = $conexao->query("SELECT * FROM chamada where setor_id=$setor_id and status ='em_andamento' and tipo_solicitacao = $escola_id  ORDER BY id asc");
    return $result;

}

function buscar_chamada_finalizado_escola($conexao,$setor_id,$escola_id){
   $result = $conexao->query("SELECT * FROM chamada where setor_id=$setor_id and status ='finalizado'  and tipo_solicitacao = $escola_id  ORDER BY id asc");
    return $result;

}

function buscar_chamada_novas_escola($conexao,$setor_id,$escola_id){
   $result = $conexao->query("SELECT * FROM chamada where setor_id=$setor_id and status='esperando_resposta' and tipo_solicitacao = $escola_id  ORDER BY id asc");
    return $result;

}

function escola_funcionario($conexao,$id_funcionario){
   $result = $conexao->query("SELECT * FROM relacionamento_funcionario_escola where funcionario_id=$id_funcionario");
    return $result;

}

function nome_funcionario($conexao,$id_funcionario){
   $result = $conexao->query("SELECT * FROM funcionario where idfuncionario=$id_funcionario");
    return $result;

}

function id_funcionario($conexao,$nome_funcionario){
   $result = $conexao->query("SELECT * FROM funcionario where nome like '%$nome_funcionario%' ");
    return $result;

}


function buscar_escola($conexao,$id_escola){
   $result = $conexao->query("SELECT * FROM escola where idescola=$id_escola");
    return $result;

}

function listar_chamados($conexao,$setor_id, $status){
   $result = $conexao->query("SELECT * FROM chamada where setor_id=$setor_id and chamada.status LIKE '$status' ORDER BY id asc");
    return $result;

}


function buscar_chamada_finalizada($conexao,$setor_id){
   $result = $conexao->query("SELECT * FROM chamada where setor_id=$setor_id and status ='finalizado' ORDER BY id asc");
    return $result;

}

function validar_chamada($conexao,$funcionario_id,$id_chamada){
   $result = $conexao->query("SELECT count(*) as 'chamados' FROM chamada where funcionario_id=$funcionario_id and id =$id_chamada and (status = 'em_andamento' or status='esperando_resposta') ORDER BY id asc");
    return $result;

}

function pesquisa_tipo_solicitacao($conexao,$id){
   $result = $conexao->query("SELECT * FROM tipo_solicitacao_chamada where id=$id");
    return $result;

}

function mostrar_minhas_chamadas($conexao,$idsetor,$idfuncionario){
   $result = $conexao->query("SELECT * FROM chamada where funcionario_id=$idfuncionario and setor_id =$idsetor LIMIT 5 ");
    return $result;

}

function mostrar_chat_chamada($conexao,$chamada_id,$funcionario_id){
   $result = $conexao->query("SELECT * FROM chat_chamado where chamada_id=$chamada_id and funcionario_id =$funcionario_id and status='inicial'");
    return $result;

}

function buscar_minhas_chamada($conexao,$idfuncionario){
   $result = $conexao->query("SELECT * FROM chamada where funcionario_id=$idfuncionario ORDER BY id asc");
    return $result;

}

function buscar_minhas_chamada_atraso($conexao,$idfuncionario){
   $result = $conexao->query("SELECT * FROM chamada where funcionario_id=$idfuncionario and status = 'atrasado' ORDER BY id asc");
    return $result;

}

function buscar_minhas_chamada_andamento($conexao,$idfuncionario){
   $result = $conexao->query("SELECT * FROM chamada where funcionario_id=$idfuncionario and status = 'em_andamento' ORDER BY id asc");
    return $result;
}

function buscar_minhas_chamada_finalizado($conexao,$idfuncionario){
   $result = $conexao->query("SELECT * FROM chamada where funcionario_id=$idfuncionario and status = 'finalizado' ORDER BY id asc");
    return $result;

}

function buscar_minhas_chamada_novas($conexao,$idfuncionario){
   $result = $conexao->query("SELECT * FROM chamada where funcionario_id=$idfuncionario and status = 'esperando_resposta' ORDER BY id asc");
    return $result;

}

function buscar_chamada_atraso2($conexao,$setor_id){
   $result = $conexao->query("SELECT * FROM chamada where setor_id=$setor_id and status = 'atrasado' ORDER BY id asc");
    return $result;

}

function buscar_chamada_andamento($conexao,$setor_id){
   $result = $conexao->query("SELECT * FROM chamada where setor_id=$setor_id and status = 'em_andamento' ORDER BY id asc");
    return $result;

}

function buscar_chamada_finalizado($conexao,$setor_id){
   $result = $conexao->query("SELECT * FROM chamada where setor_id=$setor_id and status = 'finalizado' ORDER BY id asc");
    return $result;

}

function buscar_chamada_novas($conexao,$setor_id){
   $result = $conexao->query("SELECT * FROM chamada where setor_id=$setor_id and status = 'esperando_resposta' ORDER BY id asc");
    return $result;

}



function pesquisa_chamada($conexao,$chamada_id){
   $result = $conexao->query("SELECT * FROM chamada where id=$chamada_id");
    return $result;

}



function pesquisa_chat($conexao,$chamada_id){
   $result = $conexao->query("SELECT * FROM chat_chamado where chamada_id=$chamada_id and status='inicial'");
    return $result;

}


function quantidade_chamada_pendente($conexao,$setor_id){
   $result = $conexao->query("SELECT count(*) as 'chamada' FROM chamada where setor_id=$setor_id and status='esperando_resposta'");
    return $result;

}

function quantidade_chamada_pendente_escola($conexao,$setor_id,$escola_id){
   $result = $conexao->query("SELECT count(*) as 'chamada' FROM chamada where setor_id=$setor_id and status='esperando_resposta' and tipo_solicitacao = $escola_id");
    return $result;

}

function quantidade_chamada_andamento_escola($conexao,$setor_id,$escola_id){
   $result = $conexao->query("SELECT count(*) as 'chamada' FROM chamada where setor_id=$setor_id and status='em_andamento' and tipo_solicitacao = $escola_id");
    return $result;

}

function quantidade_chamada_total_escola($conexao,$setor_id,$escola_id){
   $result = $conexao->query("SELECT count(*) as 'chamada' FROM chamada where setor_id=$setor_id and tipo_solicitacao = $escola_id");
    return $result;

}

function quantidade_chamada_finalizadas_escola($conexao,$setor_id,$escola_id){
    $result = $conexao->query("SELECT count(*) as 'chamada' FROM chamada where setor_id=$setor_id and status='finalizado' and tipo_solicitacao = $escola_id");
    return $result;

}

function quantidade_chamada_atraso_escola($conexao,$setor_id,$escola_id){
   $result = $conexao->query("SELECT count(*) as 'chamada' FROM chamada where setor_id=$setor_id and status='atrasado' and tipo_solicitacao = $escola_id");
    return $result;

}


function quantidade_chamada_total($conexao,$setor_id){
   $result = $conexao->query("SELECT count(*) as 'chamada' FROM chamada where setor_id=$setor_id");
    return $result;

}

function quantidade_chamada_finalizadas($conexao,$setor_id){
    $result = $conexao->query("SELECT count(*) as 'chamada' FROM chamada where setor_id=$setor_id and status='finalizado'");
    return $result;

}

function quantidade_chamada_andamento($conexao,$setor_id){
   $result = $conexao->query("SELECT count(*) as 'chamada' FROM chamada where setor_id=$setor_id and status='em_andamento'");
    return $result;

}

function quantidade_chamada_atraso($conexao,$setor_id){
   $result = $conexao->query("SELECT count(*) as 'chamada' FROM chamada where setor_id=$setor_id and status='atrasado'");
    return $result;

}

function quantidade_chamada_atraso_vg($conexao){
   $result = $conexao->query("SELECT count(*) as 'chamada' FROM chamada where status='atrasado'");
    return $result;

}

function quantidade_chamada_andamento_vg($conexao){
   $result = $conexao->query("SELECT count(*) as 'chamada' FROM chamada where status='em_andamento'");
    return $result;

}

function quantidade_chamada_finalizadas_vg($conexao){
    $result = $conexao->query("SELECT count(*) as 'chamada' FROM chamada where status='finalizado'");
    return $result;

}

function quantidade_chamada_novas_vg($conexao){
    $result = $conexao->query("SELECT count(*) as 'chamada' FROM chamada where status='esperando_resposta'");
    return $result;

}

function quantidade_chamada_total_vg($conexao){
   $result = $conexao->query("SELECT count(*) as 'chamada' FROM chamada");
    return $result;

}

function buscar_funcionario($conexao,$funcionario){
   $result = $conexao->query("SELECT * FROM funcionario where idfuncionario=$funcionario");
    return $result;

}

function buscar_chat($conexao,$chamada_id){
   $result = $conexao->query("SELECT * FROM chat_chamado where chamada_id=$chamada_id and status='inicial'");
    return $result;

}

function buscar_pessoa_chat($conexao,$chamada_id,$funcionario_id){
   $result = $conexao->query("SELECT * FROM chat_chamado where chamada_id=$chamada_id and funcionario_id=$funcionario_id and status = ''");
    return $result;

}

function buscar_pessoa_chat_retorno($conexao,$chamada_id,$funcionario_id){
   $result = $conexao->query("SELECT * FROM chat_chamado where chamada_id=$chamada_id and funcionario_id=$funcionario_id and status = ''LIMIT 1 ");
    return $result;

}

function buscar_pessoa_retorno($conexao,$chamada_id,$funcionario_id){
   $result = $conexao->query("SELECT * FROM chat_chamado where chamada_id=$chamada_id and funcionario_id=$funcionario_id and status = '' ORDER BY
  id ASC LIMIT 1  ");
    return $result;

}

function verificar_numero_quant($conexao,$chamada_id,$funcionario_id){
   $result = $conexao->query("SELECT count(*) as 'id' FROM chat_chamado where chamada_id=$chamada_id and funcionario_id=$funcionario_id and status = '' ");
    return $result;

}



function buscar_chat_inical($conexao,$chamada_id,$funcionario_id){
   $result = $conexao->query("SELECT * FROM chat_chamado where chamada_id=$chamada_id and funcionario_id=$funcionario_id and status = 'inicial'");
    return $result;

}


function cadastrar_mensagem($conexao,$mensagem,$enviado,$id_chamado,$idFuncionario) {
  $sql = $conexao->prepare("INSERT INTO mensagem_chamado (id_chamado,mensagem,enviado,solicitante,status) VALUES (:id_chamado,:mensagem,:enviado,:idfuncionario,'novo')");
  $sql->execute(array(
     'id_chamado' => $id_chamado,
     'mensagem' => $mensagem,
     'enviado' => $enviado,
     'idfuncionario' => $idFuncionario

  ));
}

function cadastrar_resposta_mensagem($conexao,$mensagem,$id_funcionario,$id_mensagem) {
  $sql = $conexao->prepare("INSERT INTO resposta_mensagem_chamado (id_mensagem,id_funcionario,mensagem) VALUES (:id_mensagem,:id_funcionario,:mensagem)");
  $sql->execute(array(
     'id_mensagem' => $id_mensagem,
     'id_funcionario' => $id_funcionario,
     'mensagem' => $mensagem
  ));
}



function criar_chamada($conexao,$funcionario_id,$setor_id,$status,$tipo_solicitacao,$data) {
  $sql = $conexao->prepare("INSERT INTO chamada (funcionario_id,setor_id,status,tipo_solicitacao,func_respondeu_id,data_previsao,data) VALUES (:funcionario_id,:setor_id,:status,:tipo_solicitacao,0,'0001-01-01 00:00:00',:data)");
  $sql->execute(array(
     'funcionario_id' =>$funcionario_id,
     'setor_id' =>$setor_id,
     'status' =>$status,
     'tipo_solicitacao' =>$tipo_solicitacao,
     'data' =>$data
  ));
}

function conversa_chat($conexao,$chamada_id,$funcionario_id,$mensagem,$data) {
  $sql = $conexao->prepare("INSERT INTO chat_chamado(chamada_id,funcionario_id,mensagem,status,data) VALUES (:chamada_id,:funcionario_id,:mensagem,'inicial',:data)");
  $sql->execute(array(
     'chamada_id' =>$chamada_id,
     'funcionario_id' =>$funcionario_id,
     'mensagem' =>$mensagem,
     'data' =>$data
  ));
}  

function responder_chat($conexao,$chamada_id,$funcionario_id,$mensagem,$data) {
  $sql = $conexao->prepare("INSERT INTO chat_chamado(chamada_id,funcionario_id,mensagem,status,data) VALUES (:chamada_id,:funcionario_id,:mensagem,' ',:data)");
  $sql->execute(array(
     'chamada_id' =>$chamada_id,
     'funcionario_id' =>$funcionario_id,
     'mensagem' =>$mensagem,
     'data' =>$data
  ));
}

function cadastra_arquivos($conexao,$chamado_id,$arquivo) {
  $sql = $conexao->prepare("INSERT INTO arquivos_chamado(chamado_id,arquivo) values (:chamado_id,:arquivo)");
  
  $sql->execute(
    array(
      'chamado_id' => $chamado_id,
      'arquivo' => $arquivo
     ));
}

function responder_chat_sem_arquivo($conexao,$chamada_id,$funcionario_id,$mensagem,$data) {
  $sql = $conexao->prepare("INSERT INTO chat_chamado(chamada_id,funcionario_id,mensagem,status,data) VALUES (:chamada_id,:funcionario_id,:mensagem,' ',:data)");
  $sql->execute(array(
     'chamada_id' =>$chamada_id,
     'funcionario_id' =>$funcionario_id,
     'mensagem' =>$mensagem,
     'data' =>$data
  ));
}  

function responder_chamada($conexao,$chamada_id,$funcionario_id) {
      $conexao->exec("UPDATE chamada SET func_respondeu_id=$funcionario_id, status='em_andamento' where id=$chamada_id");
}

function mudar_status($conexao,$chamada_id) {
      $conexao->exec("UPDATE chamada SET status='em_andamento' where id=$chamada_id");
}
function questionar_chamado($conexao,$chamada_id,$funcionario_id,$data,$mensagem,$id_setor) {
  $sql = $conexao->prepare("INSERT INTO chamada_atraso(id_chamada,id_funcionario,id_setor,mensagem,data_hora) VALUES (:chamada_id,:funcionario_id,:id_setor,:mensagem,:data)");
  $sql->execute(array(
     'chamada_id' =>$chamada_id,
     'funcionario_id' =>$funcionario_id,
     'id_setor' =>$id_setor,
     'mensagem' =>$mensagem,
     'data' =>$data
  ));
} 

function atualizar_chamado($conexao,$chamada_id) {
      $conexao->exec("UPDATE chamada SET status='atrasado'where id=$chamada_id");
}

function atualizar_mensagem($conexao,$id_mensagem) {
      $conexao->exec("UPDATE mensagem_chamado SET status='respondido'where id=$id_mensagem");
}

function atualizar_chamado_data_prevista($conexao,$chamada_id,$data_previsao) {
      $conexao->exec("UPDATE chamada SET data_previsao='$data_previsao' ,status='em_andamento'  where id=$chamada_id");
}

function finalizar_chamada($conexao,$chamada_id) {
      $conexao->exec("UPDATE chamada SET status='finalizado' where id=$chamada_id");
}

function buscar_id_escola($conexao,$funcionario_id){
   $result = $conexao->query("SELECT * FROM relacionamento_funcionario_escola where funcionario_id=$funcionario_id ");
    return $result;

}

function escola_funcionarios($conexao){
   $result = $conexao->query("SELECT * FROM relacionamento_funcionario_escola ");
    return $result;

}

function verificar_atraso($conexao,$idfuncionario){
   $result = $conexao->query("SELECT * FROM chamada_atraso where id_funcionario =$idfuncionario");
    return $result;

}



function verificar_todos_atraso($conexao){
   $result = $conexao->query("SELECT * FROM chamada_atraso order by id_setor asc" );
    return $result;

}

function verificar_todos_atraso_atrasado($conexao){
   $result = $conexao->query("SELECT * FROM chamada_atraso,chamada where chamada.id = chamada_atraso.id_chamada and chamada.status = 'atrasado'");
    return $result;

}

function quant_chamada_atrasada($conexao){
   $result = $conexao->query("SELECT count(*) as 'id' FROM chamada_atraso,chamada where chamada.id = chamada_atraso.id_chamada and chamada.status = 'atrasado'");
    return $result;

}

function quant_chamada_finalizado($conexao){
   $result = $conexao->query("SELECT count(*) as 'id' FROM chamada_atraso,chamada where chamada.id = chamada_atraso.id_chamada and chamada.status = 'finalizado'");
    return $result;

}

function quant_chamada_andamento($conexao){
   $result = $conexao->query("SELECT count(*) as 'id' FROM chamada_atraso,chamada where chamada.id = chamada_atraso.id_chamada and chamada.status = 'em_andamento'");
    return $result;

}



function verificar_todos_atraso_finalizado($conexao){
   $result = $conexao->query("SELECT * FROM chamada_atraso,chamada where chamada.id = chamada_atraso.id_chamada and chamada.status = 'finalizado'");
    return $result;

}

function verificar_todos_atraso_andamento($conexao){
   $result = $conexao->query("SELECT * FROM chamada_atraso,chamada where chamada.id = chamada_atraso.id_chamada and chamada.status = 'em_andamento'");
    return $result;

}

function buscar_id_setor($conexao,$funcionario_id){
   $result = $conexao->query("SELECT * FROM relacao_setor_funcionario where funcionario_id=$funcionario_id ");
    return $result;

}

function buscar_id_seto_2($conexao,$funcionario_id){
   $result = $conexao->query("SELECT * FROM relacao_setor_funcionario where funcionario_id=$funcionario_id order by setor_id asc");
    return $result;

}

function verificar_atraso_setor($conexao,$setor){
   $result = $conexao->query("SELECT * FROM chamada_atraso where id_setor =$setor order by id asc");
    return $result;

}

function pesquisa_questionado($conexao,$chamada){
   $result = $conexao->query("SELECT count(*) as 'id' FROM chamada_atraso where id_chamada =$chamada");
    return $result;

}  
?>