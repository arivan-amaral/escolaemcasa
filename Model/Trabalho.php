<?php

	function listar_trabalho($conexao, $id_funcionario,$id_turma,$id_disciplina,$idescola) {

	    $result = $conexao->query("SELECT * FROM trabalho where  turma_id=$id_turma and disciplina_id=$id_disciplina and escola_id=$idescola order by id  desc   ");

// $result = $conexao->query("SELECT * FROM trabalho where professor_id=$id_funcionario and turma_id=$id_turma and disciplina_id=$id_disciplina and escola_id=$idescola order by id  desc   ");

	    return $result;

	}



	function listar_trabalho_aluno_por_idtrabalho($conexao,$idtrabalho) {

	    $result = $conexao->query("SELECT * FROM trabalho where id=$idtrabalho ");

	    return $result;

	}

	function listar_trabalho_aluno($conexao,$id_turma,$id_disciplina,$data_hora_visivel) {

	    $result = $conexao->query("SELECT * FROM trabalho where turma_id=$id_turma and disciplina_id=$id_disciplina and data_hora_visivel <='$data_hora_visivel' order by id  desc   ");

	    return $result;

	}





	function excluir_trabalho($conexao,$id) {

	    $result = $conexao->exec("DELETE FROM trabalho where id=$id");

	    return $result;

	}




	function pesquisar_trabalho_entregue_aluno($conexao,$idtrabalho) {
	    $result = $conexao->query("SELECT * FROM trabalho_entregue where id=$idtrabalho ");
	    return $result;

	}


	function excluir_trabalho_aluno($conexao,$id) {

	    $result = $conexao->exec("DELETE FROM trabalho_entregue where id=$id");

	    return $result;

	}





	function listar_trabalho_recebido($conexao, $idtrabalho) {

	    $result = $conexao->query("SELECT * FROM trabalho,trabalho_entregue,aluno where

	     idaluno=trabalho_entregue.aluno_id and

	     trabalho_entregue.trabalho_id=trabalho.id and

		trabalho_entregue.trabalho_id=$idtrabalho   GROUP BY aluno.nome  ");

	    return $result;

	}





	function ver_trabalhos_entregues($conexao,$idaluno, $idtrabalho) {

	    $result = $conexao->query("SELECT * FROM trabalho,trabalho_entregue,aluno where

	     idaluno=trabalho_entregue.aluno_id and

	     trabalho_entregue.trabalho_id=trabalho.id and

		trabalho_entregue.trabalho_id=$idtrabalho  and aluno_id=$idaluno ");

	    return $result;

	}

	

?>