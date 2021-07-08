<?php 
	function login_funcionario($conexao,$usuario,$senha){
		$result=$conexao->query("SELECT * FROM funcionario where email='$usuario' and senha='$senha'  and funcionario.status=1  ");
		return $result;
	}

	function login_aluno($conexao,$usuario,$senha){
		$result=$conexao->query("SELECT * FROM aluno,ano_letivo,turma where
ano_letivo.aluno_id=idaluno and
ano_letivo.turma_id=turma.idturma AND
 email='$usuario' and senha='$senha' and status='Ativo' ");
		return $result;
	}
?>