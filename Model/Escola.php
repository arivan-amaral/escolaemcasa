<?php 


function desassociar_coordenador($conexao, $id){
   $result = $conexao->exec("DELETE FROM relacionamento_funcionario_escola where idrelacionamento_funcionario_escola=$id");
}

function lista_escola($conexao){
   $result = $conexao->query("SELECT * FROM escola  ORDER BY nome_escola asc");
    return $result;
  
}
function buscar_escola_por_id($conexao,$id){
   $result = $conexao->query("SELECT * FROM escola  where idescola=$id");
    return $result;
  
}


?>