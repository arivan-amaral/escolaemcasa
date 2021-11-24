<?php 

function lista_todas_series($conexao){
   $result = $conexao->query("SELECT * FROM serie  ORDER BY id asc");
    return $result;

}
function pesquisar_serie_por_id($conexao,$idserie){
   $result = $conexao->query("SELECT * FROM serie where id =$idserie  ORDER BY id asc");
    return $result;

}


?>