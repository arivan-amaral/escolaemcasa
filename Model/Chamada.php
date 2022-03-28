<?php  

function buscar_chamada($conexao,$setor_id,$status){
   $result = $conexao->query("SELECT * FROM chamada where setor_id=$setor_id and status=$status ORDER BY id asc");
    return $result;

}

function pesquisa_chamada($conexao,$chamada_id){
   $result = $conexao->query("SELECT * FROM chamada where id=$chamada_id");
    return $result;

}

function quantidade_chamada_pendente($conexao,$setor_id){
   $result = $conexao->query("SELECT count(*) as 'chamadas' FROM chamada where setor_id=$setor_id and status='esperando_resposta'");
    return $result;

}

function buscar_funcionario($conexao,$funcionario){
   $result = $conexao->query("SELECT * FROM funcionario where id=$funcionario");
    return $result;

}


function criar_chamada($conexao,$funcionario_id,$setor_id,$descricao,$status,$arquivo) {
      $sql = $conexao->prepare("INSERT INTO chamada (funcionario_id,setor_id,descricao,status,func_respondeu_id,resposta,arquivo) VALUES (:funcionario_id,:setor_id,:descricao,:status,0,' ',:arquivo)");
      $sql->execute(array(
         'funcionario_id' =>$funcionario_id,
         'setor_id' =>$setor_id,
         'descricao' =>$descricao,
         'arquivo' =>$arquivo,
         'status' =>$status
      ));
    }

function responder_chamada($conexao,$chamada_id,$funcionario_id,$resposta,$status) {
      $conexao->exec("UPDATE chamada SET resposta=$resposta, func_respondeu_id=$funcionario_id, status=$status where id=$chamada_id");
}

?>