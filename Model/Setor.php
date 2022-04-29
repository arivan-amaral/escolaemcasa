<?php  

function todos_setores($conexao){
   $result = $conexao->query("SELECT * FROM setor ORDER BY nome asc");
    return $result;

}

function buscar_tipo_solicitacao($conexao,$setor_id){
   $result = $conexao->query("SELECT * FROM tipo_solicitacao_chamada where setor_id =$setor_id ORDER BY nome asc");
    return $result;

}

function cadastrar_setor($conexao,$nome) {
      $sql = $conexao->prepare("INSERT INTO setor (nome) VALUES (:nome)");
      $sql->execute(array('nome' =>$nome));
}

function buscar_setor($conexao){
   $result = $conexao->query("SELECT * FROM setor ORDER BY id asc");
    return $result;

}

function buscar_setor_id($conexao,$setor_id){
   $result = $conexao->query("SELECT * FROM setor where id=$setor_id ");
    return $result;

}

?>