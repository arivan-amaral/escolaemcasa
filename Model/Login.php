<?php 
	function login_funcionario($conexao,$usuario,$senha){
		$result=$conexao->query("SELECT * FROM funcionario where email='$usuario' and senha='$senha'  and funcionario.status=1  ");
		return $result;
	}

	function login_aluno($conexao,$usuario,$senha,$ano_letivo){


		$result=$conexao->query("SELECT * FROM aluno,ano_letivo,turma,escola where
			 ano_letivo.status_letivo=1 AND 
escola.idescola=escola_id and
ano_letivo.aluno_id=idaluno and
ano_letivo.turma_id=turma.idturma AND
ano_letivo.status_letivo=1 AND

aluno.email='$usuario' and aluno.senha='$senha' and ano='$ano_letivo' and status='Ativo' ");
		return $result;
	}
?>