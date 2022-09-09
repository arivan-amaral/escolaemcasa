<?php 
	function login_funcionario($conexao,$usuario,$senha){
		$result=$conexao->query("SELECT * FROM funcionario where email='$usuario' and senha='$senha'  and funcionario.status=1  ");
		return $result;
	}

	function login_aluno($conexao,$usuario,$senha,$ano_letivo){

 
		$result=$conexao->query("SELECT * FROM aluno,ecidade_matricula,turma,escola where
			 
escola.idescola=ecidade_matricula.turma_escola and
ecidade_matricula.aluno_id=idaluno and
ecidade_matricula.turma_id=turma.idturma AND
ecidade_matricula.matricula_ativa='S' AND
ecidade_matricula.matricula_concluida='N' AND
 

aluno.email='$usuario' and aluno.senha='$senha' and ecidade_matricula.calendario_ano=$ano_letivo and aluno.status='Ativo' order by matricula_codigo desc ");


		return $result;
	}
?>