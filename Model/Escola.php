<?php 



function lista_escola($conexao){
   $result = $conexao->query("SELECT * FROM escola  ORDER BY nome_escola asc");
    return $result;

}


?>