<?php session_start();
include'../Model/Conexao.php';
include'../Model/Escola.php';
include'../Model/Aluno.php';


try {

	$profissional_solicitante=$_SESSION['idfuncionario'];

	$turma_id=$_POST['rematricula_turma'];
	$quantidade_vagas_restante=$_POST['quantidade_vagas_restante'];
	// $quantidade_vaga_turma_total=$_POST['quantidade_vaga_turma_total'];

	// foreach ($_POST as $key => $value) {
	// 	echo "$key - $value <br>";
	// }
	

	$turma_id_anterior=$_POST['idturma'];
	$turma_escola=$_POST['rematricula_escola_id'];
	$turno_nome=$_POST['rematricula_turno'];
	$rematricula_serie_id=$_POST['rematricula_serie_id'];
	$rematricula_nova_serie=$_POST['rematricula_nova_serie'];


	$url_get=$_POST['url_get'];
	$ano_letivo=$_SESSION['ano_letivo'];
	$ano_letivo_vigente=$_SESSION['ano_letivo_vigente'];
	
	$aluno_reprovado = "";
	$vagas_esgotada = "";
	// if ( empty($_POST['escola_id']) ){
	// 	$_SESSION['status']=0;
	// 	$_SESSION['mensagem']='Selecione todos os campos!';
	// 	header("location:../View/listar_alunos_da_turma.php?$url_get");
	// 	exit();

	// }else
	// 
	
// <=======RECRIA PÁGIANAS ESTATICAS =======>
	$pagina_estatica=$_POST['url_get'];
	$pagina_estatica =strtr($pagina_estatica, "&", " ");
	$pagina_estatica =strtr($pagina_estatica, "%", " ");
	$pagina_estatica="listar_alunos_da_turma.php ".$pagina_estatica.".php";
	if (file_exists("../View/pagina_estatica/$pagina_estatica")) {
		unlink("../View/pagina_estatica/$pagina_estatica");
	}
// <=========================================>


  if (isset($_POST['idaluno'])) {


		foreach ($_POST['idaluno'] as $key => $value) {

			if (isset($_POST['idaluno'][$key])) {

				$aluno_id=$_POST['idaluno'][$key];
				$nome_aluno=$_POST["nome_aluno$aluno_id"];
				$matricula_aluno=$_POST["matricula_aluno$aluno_id"];
				$resultado=$_POST["resultado$aluno_id"];

				// echo "$aluno_id - $nome_aluno ;;<br>";

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






			// echo "$aluno_id - $nome_aluno <br>";

				if ($rematriculado==0 && $quantidade_vagas_restante> 0 && $rematricula_serie_id ==$rematricula_nova_serie && ($resultado !="Apc" || $resultado !="Apr" ) ) {
					rematricular_aluno($conexao,$aluno_id,$turma_id,$turma_id_anterior,$matricula_situacao,$matricula_concluida,$matricula_datamatricula,$matricula_ativa,$matricula_tipo,$calendario_ano,$turma_escola,$turno_nome);

					mudar_situacao_rematricular_aluno($conexao,$matricula_aluno);
					$quantidade_vagas_restante--;


				}elseif ($rematriculado==0 && $quantidade_vagas_restante> 0 && ($resultado=="Apc" || $resultado=="Apr") ) {

				rematricular_aluno($conexao,$aluno_id,$turma_id,$turma_id_anterior,$matricula_situacao,$matricula_concluida,$matricula_datamatricula,$matricula_ativa,$matricula_tipo,$calendario_ano,$turma_escola,$turno_nome);

				mudar_situacao_rematricular_aluno($conexao,$matricula_aluno);
				$quantidade_vagas_restante--;


				}else if($quantidade_vagas_restante==0){
					$vagas_esgotada.=" | $aluno_id - $nome_aluno";
				}else{
					$aluno_reprovado.=" | $aluno_id - $nome_aluno";
				// echo "$aluno_reprovado";
				}

			}
		}//foreach ($_POST['idaluno'] as $key => $value) {

		}

		if (!isset($_POST['idaluno'])) {
			$_SESSION['status']=0;
			$_SESSION['mensagem']='Nenhum aluno selecionado!';
			header("location:../View/listar_alunos_da_turma.php?$url_get");
			exit();
		}	

		if ($vagas_esgotada!="") {
			$_SESSION['status']=2;
			$vagas_esgotada="Não foi possível realizar ação motivo (VAGAS ESGOTADAS) para: ".$vagas_esgotada;
			$_SESSION['mensagem']=$vagas_esgotada;
			header("location:../View/listar_alunos_da_turma.php?$url_get");	
			exit();

		}

		if ($aluno_reprovado!="") {
			$_SESSION['status']=2;

			$aluno_reprovado="Não foi possível realizar ação ".$aluno_reprovado;

			$_SESSION['mensagem']=$aluno_reprovado."".$vagas_esgotada;
			header("location:../View/listar_alunos_da_turma.php?$url_get");	
			exit();

		}else{
			$_SESSION['status']=1;
			header("location:../View/listar_alunos_da_turma.php?$url_get");	
			exit();
		}	
		




	} catch (Exception $e) {
		$_SESSION['status']=0;
		$_SESSION['mensagem']='Alguma coisa deu errado, tente novamente!';
		header("location:../View/listar_alunos_da_turma.php?$url_get");
	// echo "$e";

	}

?>