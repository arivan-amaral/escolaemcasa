<?php session_start();
include'../Model/Conexao.php';
include'../Model/Escola.php';
include'../Model/Aluno.php';


try {

	$profissional_solicitante=$_SESSION['idfuncionario'];

	$turma_id=$_GET['turma_id'];
	$turma_id_anterior=$_GET['turma_id_anterior'];
	$quantidade_vagas_restante=$_GET['quantidade_vagas_restante'];
	$turma_escola=$_GET['turma_escola'];
	$turno_nome=$_GET['turno_nome'];
	$rematricula_serie_id=$_GET['rematricula_serie_id'];
	$rematricula_nova_serie=$_GET['rematricula_nova_serie'];
	$aluno_id=$_GET['idaluno'];


	
	$ano_letivo=$_SESSION['ano_letivo'];
	$ano_letivo_vigente=$_SESSION['ano_letivo_vigente'];
	
	$aluno_reprovado = "";
	$vagas_esgotada = "";
	// if ( empty($_GET['escola_id']) ){
	// 	$_SESSION['status']=0;
	// 	$_SESSION['mensagem']='Selecione todos os campos!';
	// 	header("location:../View/listar_alunos_da_turma.php?$url_get");
	// 	exit();

	// }else
	
	if (isset($_GET['idaluno'])) {


		// foreach ($_GET['idaluno'] as $key => $value) {

		$nome_aluno='' ;
		$matricula_aluno=$_GET['matricula'] ;
		$resultado='Apr';
			// $nome_aluno=$_GET['nome_aluno'] ;
			// $resultado=$_GET['resultado'] ;

		$matricula_situacao='MATRICULADO';
		$matricula_concluida='N';
		$matricula_datamatricula=date("Y-m-d");
		$matricula_ativa='S';
		$matricula_tipo='R';
		$calendario_ano=$_SESSION['ano_letivo_vigente'];

		$verificar_aluno_na_turna_rematricula=verificar_aluno_na_turna_rematricula($conexao,$aluno_id,$calendario_ano);

		$rematriculado=0;
		foreach ($verificar_aluno_na_turna_rematricula as $key => $value) {
			$rematriculado++;
		}


		if ($rematriculado==0 && $quantidade_vagas_restante> 0 && $rematricula_serie_id ==$rematricula_nova_serie ) {

			rematricular_aluno($conexao,$aluno_id,$turma_id,$turma_id_anterior,$matricula_situacao,$matricula_concluida,$matricula_datamatricula,$matricula_ativa,$matricula_tipo,$calendario_ano,$turma_escola,$turno_nome);

			mudar_situacao_rematricular_aluno($conexao,$matricula_aluno);
			$quantidade_vagas_restante--;


		}elseif ($rematriculado==0 && $quantidade_vagas_restante> 0  ) {

			rematricular_aluno($conexao,$aluno_id,$turma_id,$turma_id_anterior,$matricula_situacao,$matricula_concluida,$matricula_datamatricula,$matricula_ativa,$matricula_tipo,$calendario_ano,$turma_escola,$turno_nome);

			mudar_situacao_rematricular_aluno($conexao,$matricula_aluno);
			$quantidade_vagas_restante--;


		}else if($quantidade_vagas_restante==0){
			$vagas_esgotada.=" | $aluno_id - $nome_aluno";
		}else{
			$aluno_reprovado.=" | $aluno_id - $nome_aluno";
				// echo "$aluno_reprovado";
		}

		//}foreach ($_GET['idaluno'] as $key => $value) {

	}

	
	
	if ($vagas_esgotada!="") {

		$vagas_esgotada="Não foi possível realizar ação  motivo (VAGAS ESGOTADAS) para: ".$vagas_esgotada;
		echo $vagas_esgotada;


	}

	if ($aluno_reprovado!="") {

		$aluno_reprovado="Não foi possível realizar ação ".$aluno_reprovado;

		echo $aluno_reprovado."".$vagas_esgotada;
		

	}else{
		echo "Ação concluida";
	}	

	



} catch (Exception $e) {

	echo"Alguma coisa deu errado, tente novamente!".$e;

}

?>