<?php  

function buscar_chamada($conexao,$setor_id){
   $result = $conexao->query("SELECT * FROM chamada where setor_id=$setor_id and (status ='em_andamento' or status='esperando_resposta')  ORDER BY id asc");
    return $result;

}

function buscar_chamada2($conexao,$setor_id){
   $result = $conexao->query("SELECT * FROM chamada where setor_id=$setor_id and (status ='em_andamento' or status='esperando_resposta' or status ='atrasado')  ORDER BY id asc");
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

function buscar_escola($conexao,$id_escola){
   $result = $conexao->query("SELECT * FROM escola where idescola=$id_escola");
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

function pesquisa_chamada($conexao,$chamada_id){
   $result = $conexao->query("SELECT * FROM chamada where id=$chamada_id");
    return $result;

}


function validar_funcionario($conexao,$chamada_id,$idfuncionario){
   $result = $conexao->query("SELECT count(*) as 'id' FROM chamada where id=$chamada_id and func_respondeu_id=$idfuncionario");
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

function buscar_chat_inical($conexao,$chamada_id,$funcionario_id){
   $result = $conexao->query("SELECT * FROM chat_chamado where chamada_id=$chamada_id and funcionario_id=$funcionario_id and status = 'inicial'");
    return $result;

}



function criar_chamada($conexao,$funcionario_id,$setor_id,$status,$tipo_solicitacao) {
  $sql = $conexao->prepare("INSERT INTO chamada (funcionario_id,setor_id,status,tipo_solicitacao,func_respondeu_id,data_retorno,data_previsao) VALUES (:funcionario_id,:setor_id,:status,:tipo_solicitacao,0,'0001-01-01 00:00:00','0001-01-01 00:00:00')");
  $sql->execute(array(
     'funcionario_id' =>$funcionario_id,
     'setor_id' =>$setor_id,
     'status' =>$status,
     'tipo_solicitacao' =>$tipo_solicitacao
  ));
}

function conversa_chat($conexao,$chamada_id,$funcionario_id,$mensagem,$arquivo,$data) {
  $sql = $conexao->prepare("INSERT INTO chat_chamado(chamada_id,funcionario_id,mensagem,arquivo,status,data) VALUES (:chamada_id,:funcionario_id,:mensagem,:arquivo,'inicial',:data)");
  $sql->execute(array(
     'chamada_id' =>$chamada_id,
     'funcionario_id' =>$funcionario_id,
     'mensagem' =>$mensagem,
     'arquivo' =>$arquivo,
     'data' =>$data
  ));
}  

function responder_chat($conexao,$chamada_id,$funcionario_id,$mensagem,$arquivo,$data) {
  $sql = $conexao->prepare("INSERT INTO chat_chamado(chamada_id,funcionario_id,mensagem,arquivo,status,data) VALUES (:chamada_id,:funcionario_id,:mensagem,:arquivo,' ',:data)");
  $sql->execute(array(
     'chamada_id' =>$chamada_id,
     'funcionario_id' =>$funcionario_id,
     'mensagem' =>$mensagem,
     'arquivo' =>$arquivo,
     'data' =>$data
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

function responder_chamada($conexao,$chamada_id,$funcionario_id,$data_retorno) {
      $conexao->exec("UPDATE chamada SET func_respondeu_id=$funcionario_id, status='em_andamento',data_retorno='$data_retorno' where id=$chamada_id");
}

function atualizar_chamado($conexao,$chamada_id) {
      $conexao->exec("UPDATE chamada SET status='atrasado'where id=$chamada_id");
}

function atualizar_chamado_data_prevista($conexao,$chamada_id,$data_previsao) {
      $conexao->exec("UPDATE chamada SET data_previsao='$data_previsao' where id=$chamada_id");
}

function finalizar_chamada($conexao,$chamada_id) {
      $conexao->exec("UPDATE chamada SET status='finalizado' where id=$chamada_id");
}

?>