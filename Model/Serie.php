<?php 

function lista_todas_series($conexao){
   $result = $conexao->query("SELECT * FROM serie  ORDER BY id asc");
    return $result;

}
function pesquisar_serie_por_id($conexao,$idserie){
   $result = $conexao->query("SELECT * FROM serie where id =$idserie  ORDER BY id asc");
    return $result;

}

function pesquisar_serie_por_intervalo($conexao,$serie_inicial, $serie_final){
   $result = $conexao->query("SELECT * FROM serie where id >=$serie_inicial and id <=$serie_final  ORDER BY id asc");
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
   $result = $conexao->query("SELECT serie.id, serie.nome,possivel_destino FROM associar_serie_rematricula, serie
      where serie.id= associar_serie_rematricula.possivel_destino and 
      associar_serie_rematricula.serie_origem = $idserie");
    return $result;

}


?>