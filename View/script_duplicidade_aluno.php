<?php 
	include_once '../Model/Conexao.php';
	include_once '../Controller/Conversao.php';

	$res=$conexao->query("SELECT idano_letivo, COUNT(*) AS quantidade, aluno_id, escola_id, turma_id FROM ano_letivo GROUP BY aluno_id");
	$cor='green';
		$conta=1;
	foreach ($res as $key => $value) {
		$aluno_id=$value['aluno_id'];
		$quantidade=$value['quantidade'];

		if ($conta%2==0) {
			$cor='green';
		}else{
			$cor='red';
		}

		if ($quantidade>1) {
			$res_duplicatas=$conexao->query("SELECT * FROM ano_letivo where aluno_id=$aluno_id");
			$conta2=0;
			foreach ($res_duplicatas as $key_d => $value2) {
				$idano_letivo=$value2['idano_letivo'];
				$aluno_id=$value2['aluno_id'];
				$turma_id=$value2['turma_id'];
				$escola_id=$value2['escola_id'];
				if ($conta2==0) {
					echo"<a href='excluir_duplicata_aluno.php?id=$idano_letivo'>
										<font color='$cor'> 
											EXCLUIdoooooo -idaluno: $aluno_id - turma:$turma_id -escola: $escola_id
										</font>
									</a> <br>";
					$conexao->exec("DELETE FROM ano_letivo where idano_letivo=$idano_letivo");


				}else{
					echo"<a href='excluir_duplicata_aluno.php?id=$idano_letivo'>
						<font color='$cor'> 
							EXCLUIR -idaluno: $aluno_id - turma:$turma_id -escola: $escola_id
						</font>
					</a> <br>";
				}
				$conta2++;
			}


		echo"<br>";
		echo"<br>";
		echo"<br>";
		}
		$conta++;
	}

?>