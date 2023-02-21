<?php
include_once '../Model/Conexao.php';

	try {
		$res=$conexao->query("SELECT * from questionario where origem_questionario_id='muda' ");
		foreach ($res as $key => $value) {
			$id=$value['id'];
			$res=$conexao->exec("UPDATE questionario set origem_questionario_id='$id' where origem_questionario_id ='muda' AND id=$id   ");
		echo"Questionario <br>";

		}
		
		$res_q=$conexao->query("SELECT * from questao where origem_questionario_id='muda' ");
		foreach ($res_q as $key => $value) {
			$id=$value['questionario_id'];
			$res=$conexao->exec("UPDATE questao set origem_questionario_id='$id' where origem_questionario_id ='muda' AND questionario_id=$id   ");
			echo"Questão <br>";


		}
		echo"Deu certo...";
		 
	} catch (Exception $e) {
		$_SESSION['status']=0;
		echo"$e";
		//header("location:../View/alterar_dados_aluno.php?status=0");
	}

?>