<?php 
session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Escola.php';
include_once '../Model/Aluno.php';


try {

	$profissional_solicitante=$_SESSION['idfuncionario'];

	$quantidade_vagas_restante=$_POST['quantidade_vagas_restante_troca_turma'];
	$turma_id=$_POST['lista_de_turmas_troca_turma'];
	$turma_id_anterior=$_POST['idturma'];
	
	$turno=$_POST['troca_turma_turno'];
	$escola_id=$_POST['rematricula_escola_id'];
	$serie_id=$_POST['troca_turma_serie_id'];
	if (isset($_POST['etapa'])) {
	    $etapa=$_POST['etapa'];
	  }else{
	    $etapa=NULL;

	  }

	$url_get=$_POST['url_get'];
	$ano_letivo=$_SESSION['ano_letivo'];
	$ano_letivo_vigente=$_SESSION['ano_letivo_vigente'];
	
	$aluno_reprovado = "";
	$vagas_esgotada = "";

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
			 $existe_nota=0;
			
			##################################################################


			
			//echo "$aluno_id - $nome_aluno <br>";
			
		if($existe_nota==0  && $quantidade_vagas_restante> 0 && $turma_id>0) {
	

 					$procedimento="TROCA DE TURMA";
			 		$data_saida=date("Y-m-d");
			  		mudar_situacao_transferencia_aluno($conexao,$matricula_aluno,$procedimento,$data_saida);
				 
				 
				 $matricula_situacao="MATRICULADO";
				 $matricula_concluida="N";
				 $matricula_datamatricula=date("Y-m-d");
				 $matricula_ativa="S";
				 $matricula_tipo="N";
				 $calendario_ano=$ano_letivo_vigente;
				 $turma_escola=$escola_id;
				 $turno_nome=$turno;

				 rematricular_aluno($conexao,$aluno_id,$turma_id,$turma_id_anterior,$matricula_situacao,$matricula_concluida,$matricula_datamatricula,$matricula_ativa,$matricula_tipo,$calendario_ano,$turma_escola,$turno_nome,$etapa);

				 $conexao->exec("UPDATE nota_parecer set turma_id=$turma_id WHERE turma_id=$turma_id_anterior and aluno_id=$aluno_id ");

			  $acao="Troca de turma efetuada pelo usuário $idfuncionario dados: $matricula_aluno,$procedimento,$data_saida";
    			registrarLog($conexao, $idfuncionario, $acao);

				 
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