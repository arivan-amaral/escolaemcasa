<?php session_start();
include'../Model/Conexao.php';
include'../Model/Escola.php';
include'../Model/Aluno.php';


try {

	$profissional_solicitante=$_SESSION['idfuncionario'];

	$quantidade_vagas_restante=$_POST['quantidade_vagas_restante_troca_turma'];
	$turma_id=$_POST['lista_de_turmas_troca_turma'];
	$turma_id_anterior=$_POST['idturma'];
	
	$turno=$_POST['troca_turma_turno'];
	$escola_id=$_POST['rematricula_escola_id'];
	$serie_id=$_POST['troca_turma_serie_id'];
	

	$url_get=$_POST['url_get'];
	$ano_letivo=$_SESSION['ano_letivo'];
	$ano_letivo_vigente=$_SESSION['ano_letivo_vigente'];
	
	$aluno_reprovado = "";
	$vagas_esgotada = "";
	
	if (isset($_POST['idaluno'])) {

	
		foreach ($_POST['idaluno'] as $key => $value) {
			$aluno_id=$_POST['idaluno'][$key];
			$nome_aluno=$_POST["nome_aluno$aluno_id"];
			$matricula_aluno=$_POST["matricula$aluno_id"];
			$resultado=$_POST["resultado$aluno_id"];
		 	$calendario_ano=$_SESSION['ano_letivo_vigente'];
			
			##################################################################
			$verificar_aluno_na_turna_rematricula=verificar_aluno_na_turna_rematricula($conexao,$aluno_id,$calendario_ano);
			$rematriculado=0;
			foreach ($verificar_aluno_na_turna_rematricula as $key => $value) {
			 	$rematriculado++;
			}
			##################################################################
			

		
			$verificar_frequencia=$conexao->query("SELECT * FROM frequencia WHERE aluno_id=$aluno_id and ano_frequencia='$ano_letivo_vigente' ");
			$verificar_frequencia=$verificar_frequencia->fetchAll();
			// $existe_frequencia=0;
			
		
			$verificar_nota=$conexao->query("SELECT * FROM nota_parecer WHERE aluno_id=$aluno_id and ano_nota='$ano_letivo_vigente' ");
			$verificar_nota=$verificar_nota->fetchAll();
			// $existe_nota=0;
			
			##################################################################


			
			//echo "$aluno_id - $nome_aluno <br>";
			
		if(count($existe_nota)==0 && count($existe_frequencia)==0 && $quantidade_vagas_restante> 0 && $turma_id>0) {
			 	// ecidade_matricula
			 	// ecidade_movimentacao
			 	// frequencia
			 	// nota
			 	

			 	// echo "$matricula_aluno turma id: $turma_id <br>";
			 	// echo "turma id: $turma_id <br>";
			 	// echo "turma id: $turma_id <br>";
			 	// echo "UPDATE ecidade_matricula set turma_id=$turma_id and turno_nome=$turno WHERE matricula_codigo=$matricula_aluno<br>";

			 	$conexao->exec("UPDATE ecidade_matricula set turma_id=$turma_id, turno_nome='$turno' WHERE matricula_codigo=$matricula_aluno ");

			 	// $conexao->exec("UPDATE nota set turma_id=$turma_id

			 	//  where    aluno_id=$aluno_id and ano_nota=$_SESSION['ano_letivo_vigente'] ");

 

				 
				$quantidade_vagas_restante--;
			}else if($quantidade_vagas_restante==0){
				$vagas_esgotada.=" | $aluno_id - $nome_aluno";
			}

		}//foreach ($_POST['idaluno'] as $key => $value) {

	
	}//fim if (isset($_POST['idaluno'])) {


	if (!isset($_POST['idaluno'])) {
		$_SESSION['status']=0;
		$_SESSION['mensagem']='Nenhum aluno selecionado!';
		
		 header("location:../View/listar_alunos_da_turma.php?$url_get");
		exit();
	}elseif ($vagas_esgotada!="") {
		$_SESSION['status']=2;
		$vagas_esgotada="Não foi possível realizar ação motivo (VAGAS ESGOTADAS) para: ".$vagas_esgotada;
		$_SESSION['mensagem']=$vagas_esgotada;
		header("location:../View/listar_alunos_da_turma.php?$url_get");	
		exit();

	}else{
		$_SESSION['status']=1;
		header("location:../View/listar_alunos_da_turma.php?$url_get");	
		exit();
	}	
		
	



} catch (Exception $e) {
	$_SESSION['status']=0;
	$_SESSION['mensagem']='Alguma coisa deu errado, tente novamente!!';
	//header("location:../View/listar_alunos_da_turma.php?$url_get");
	 echo "$e";
 
}

?>