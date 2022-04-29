<?php 

function lista_todas_series($conexao){
   $result = $conexao->query("SELECT * FROM serie  ORDER BY id asc");
    return $result;

}
function pesquisar_serie_por_id($conexao,$idserie){
   $result = $conexao->query("SELECT * FROM serie where id =$idserie  ORDER BY id asc");
    return $result;

}
function lista_serie_rematricula($conexao,$idserie){
   $result = $conexao->query("SELECT * FROM serie where id >=$idserie  ORDER BY id asc");
    return $result;

}
function pesquisar_ordem_proxima_serie($conexao,$idserie){
   $result = $conexao->query("SELECT * FROM serie where $idserie  ORDER BY id asc");
    return $result;

}

function lista_ordem_serie_rematricula($conexao,$idserie){
   $result = $conexao->query("SELECT * FROM associar_serie_rematricula 
      where 
      associar_serie_rematricula.serie_origem = $idserie");
    return $result;

}


?>