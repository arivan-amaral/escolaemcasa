<?php 

function lista_todas_series($conexao){
   $result = $conexao->query("SELECT * FROM serie  ORDER BY id asc");
    return $result;

}


?>