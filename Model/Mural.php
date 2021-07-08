<?php 



function cadastrar_mural($conexao,$titulo, $descricao,$escola_id,$turma_id,$serie_id, $usuario_id,$setor){
   $result = $conexao->exec("INSERT INTO mural(titulo, descricao,escola_id,turma_id, serie_id,usuario_id,setor) VALUES ('$titulo', '$descricao',$escola_id, $turma_id, $serie_id,$usuario_id,'$setor')");
    return $result;

}
function cadastrar_mural_geral($conexao,$titulo, $descricao, $serie_id, $usuario_id,$setor){
   $result = $conexao->exec("INSERT INTO mural(titulo, descricao, serie_id,usuario_id,setor) VALUES ('$titulo', '$descricao',  $serie_id,$usuario_id,'$setor')");
    return $result;

}
function lista_mural_geral($conexao){
   $result = $conexao->query("SELECT * FROM mural  ORDER BY id asc");
    return $result;

}


?>