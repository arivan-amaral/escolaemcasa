<?php  

function buscar_chamada($conexao,$setor_id){
   $result = $conexao->query("SELECT * FROM chamada where setor_id=$setor_id ORDER BY id asc");
    return $result;

}

function pesquisa_tipo_solicitacao($conexao,$id){
   $result = $conexao->query("SELECT * FROM tipo_solicitacao_chamada where id=$id");
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

function pesquisa_chat($conexao,$chamada_id){
   $result = $conexao->query("SELECT * FROM chat_chamado where chamada_id=$chamada_id");
    return $result;

}


function quantidade_chamada_pendente($conexao,$setor_id){
   $result = $conexao->query("SELECT count(*) as 'chamada' FROM chamada where setor_id=$setor_id and status='esperando_resposta'");
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

function criar_chamada($conexao,$funcionario_id,$setor_id,$status,$tipo_solicitacao) {
  $sql = $conexao->prepare("INSERT INTO chamada (funcionario_id,setor_id,status,tipo_solicitacao,func_respondeu_id) VALUES (:funcionario_id,:setor_id,:status,:tipo_solicitacao,0)");
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

function responder_chamada($conexao,$chamada_id,$funcionario_id) {
      $conexao->exec("UPDATE chamada SET func_respondeu_id=$funcionario_id, status='em_andamento' where id=$chamada_id");
}

function finalizar_chamada($conexao,$chamada_id) {
      $conexao->exec("UPDATE chamada SET status='finalizado' where id=$chamada_id");
}

?>