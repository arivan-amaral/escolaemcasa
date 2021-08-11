<?php 
	include '../Model/Conexao.php';
	include '../Controller/Conversao.php';

	$res=$conexao->exec("SELECT idano_letivo,COUNT(*) AS quantidade, aluno_id, escola_id, turma_id FROM `ano_letivo` GROUP BY aluno_id");
	$cor='green';
	foreach ($res as $key => $value) {
		$aluno_id=$value['quantidade'];
		if ($conta%2==0) {
				$cor='green';

		}else{
			$cor='red';
		}

		if ($value['quantidade']>1) {
			$res_duplicatas=$conexao->exec("SELECT * FROM `ano_letivo` where aluno_id=$aluno_id");
			foreach ($res_duplicatas as $key_d => $value2) {
				$idano_letivo=$value2['idano_letivo'];
				$aluno_id=$value2['aluno_id'];
				$turma_id=$value2['turma_id'];
				$escola_id=$value2['escola_id'];

				echo"<a href='excluir_duplicata_aluno.php?id=$idano_letivo'>
						<font color='$cor'> 
							EXCLUIR -idaluno: $aluno_id - turma:$turma_id -escola: $escola_id
						</font>
					</a>";
			}

		}
		echo"<br>";
		echo"<br>";
		echo"<br>";
	}

?>