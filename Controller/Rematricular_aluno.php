<?php session_start();
include'../Model/Conexao.php';
include'../Model/Escola.php';


try {

	$profissional_solicitante=$_SESSION['idfuncionario'];

	// $turma_id=$_POST['rematricula_turma'];
	foreach ($_POST as $key => $value) {
		echo " $key - $value <br>";
	}
	

	// $turma_id_anterior=$_POST['idturma'];
	// $turma_escola=$_POST['rematricula_escola_id'];
	// $turno_nome=$_POST['rematricula_turno'];
	// $rematricula_serie_id=$_POST['rematricula_serie_id'];
	// $rematricula_nova_serie=$_POST['rematricula_nova_serie'];


	// $url_get=$_POST['url_get'];
	// $ano_letivo=$_SESSION['ano_letivo'];
	// $ano_letivo_vigente=$_SESSION['ano_letivo_vigente'];
	
	// $aluno_reprovado = "";
	// // if ( empty($_POST['escola_id']) ){
	// // 	$_SESSION['status']=0;
	// // 	$_SESSION['mensagem']='Selecione todos os campos!';
	// // 	header("location:../View/listar_alunos_da_turma.php?$url_get");
	// // 	exit();

	// // }else
	
	// if (isset($_POST['idaluno'])) {
	// 	foreach ($_POST['idaluno'] as $key => $value) {
	// 		$aluno_id=$_POST['idaluno'][$key];
	// 		$nome_aluno=$_POST['nome_aluno'][$key];
	// 		$matricula_aluno=$_POST['matricula_aluno'][$key];
	// 		$resultado=$_POST['resultado'][$key];
				
	// 			$matricula_situacao='MATRICULADO';
	// 		 	$matricula_concluida='N';
	// 		 	$matricula_datamatricula=date("Y-m-d");
	// 		 	$matricula_ativa='S';
	// 		 	$matricula_tipo='R';
	// 		 	$calendario_ano=$_SESSION['ano_letivo_vigente'];

	// 		 if ( $rematricula_serie_id ==$rematricula_nova_serie ) {
	// 			rematricular_aluno($conexao,$aluno_id,$turma_id,$turma_id_anterior,$matricula_situacao,$matricula_concluida,$matricula_datamatricula,$matricula_ativa,$matricula_tipo,$calendario_ano,$turma_escola,$turno_nome);
				
	// 			mudar_situacao_rematricular_aluno($conexao,$matricula_aluno);

	// 		}elseif ($resultado=="Apc" || $resultado=="Apr" ) {
	// 		  	rematricular_aluno($conexao,$aluno_id,$turma_id,$turma_id_anterior,$matricula_situacao,$matricula_concluida,$matricula_datamatricula,$matricula_ativa,$matricula_tipo,$calendario_ano,$turma_escola,$turno_nome);
				
	// 			mudar_situacao_rematricular_aluno($conexao,$matricula_aluno);


	// 		}else{
	// 			$aluno_reprovado.=" | $aluno_id - $nome_aluno";
	// 			// echo "$aluno_reprovado";
	// 		}

	// 	}

	// }

	// if (!isset($_POST['idaluno'])) {
	// 	$_SESSION['status']=0;
	// 	$_SESSION['mensagem']='Nenhum aluno selecionado!';
	// 	header("location:../View/listar_alunos_da_turma.php?$url_get");
	// 	exit();
	// }	
	
	// if ($aluno_reprovado!="") {
	// 	$_SESSION['status']=2;
	// 	$_SESSION['mensagem']="Não é possível transferir aluno com reprovação".$aluno_reprovado;

	// }else{
	// 	$_SESSION['status']=1;
	// 	header("location:../View/listar_alunos_da_turma.php?$url_get");	
	// }
	
	



} catch (Exception $e) {
	$_SESSION['status']=0;
	$_SESSION['mensagem']='Alguma coisa deu errado, tente novamente!';
	header("location:../View/listar_alunos_da_turma.php?$url_get");
 
}

?>