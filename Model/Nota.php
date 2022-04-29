<?php 
	function pesquisa_nota_por_periodo($conexao,$idescola,$idturma,$iddisciplina,$idaluno,$periodo_id){
		$result=$conexao->query("
        SELECT
        avaliacao,periodo_id,escola_id,nota
         FROM nota_parecer WHERE
        escola_id=$idescola and
        turma_id=$idturma and
        disciplina_id=$iddisciplina and 
        periodo_id=$periodo_id and aluno_id=$idaluno  group by avaliacao,periodo_id,nota ");

		return $result;
	}

 
?>