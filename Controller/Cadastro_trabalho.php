<?php
session_start();
include '../Model/Conexao.php';

try {
	$professor_id=$_SESSION['idprofessor'];

	$titulo = $_POST['titulo'];
	$arquivo = $_FILES['arquivo'];
	$descricao = $_POST['descricao'];
	$data_entrega = $_POST['data_entrega']." 23:59:59";

	$data_visivel = $_POST['data_visivel'];
	$hora_visivel = $_POST['hora_visivel'];

	$data_hora_visivel=$data_visivel." ".$hora_visivel.":00";

	$idescola= $_POST['idescola'];
	
	$turma_id= $_POST['turma_id'];
	$disciplina_id = $_POST['disciplina_id'];
	$url_get = $_POST['url_get'];

	if ( isset( $_FILES["arquivo"][ 'name' ] ) && $_FILES[ "arquivo"][ 'error' ] == 0 ) {
		$arquivo_tmp = $_FILES[ "arquivo".$i ][ 'tmp_name' ];
		$nome = $_FILES[ "arquivo"][ 'name' ];
		$extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
		$extensao = strtolower ( $extensao );

		if ( strstr ( '.pdf;.docx;.doc;.txt;.odt;.pptx;.jpg;.jpeg;.gif;.png;.PNG', $extensao ) ) {
		    $novoNome = uniqid ( time () ) . '.' . $extensao;
		    $destino = '../View/trabalho/' . $novoNome;
		    if(move_uploaded_file($arquivo_tmp, $destino)){
		    		foreach ($_POST['idturma'] as $key => $value) {
		    			$turma_id=$_POST['idturma'][$key];
		    			$conexao->exec("INSERT INTO trabalho(titulo,caminho,descricao, turma_id, disciplina_id, professor_id,data_entrega,extensao,data_hora_visivel,escola_id) VALUES ('$titulo','$novoNome', '$descricao',$turma_id,$disciplina_id,    $professor_id,'$data_entrega','$extensao','$data_hora_visivel',$idescola )");
				
		    		}


						// $_SESSION['status']=1;
	 				// 	header("Location:../View/cadastro_trabalho.php?$url_get");

	 		}

	 		// else{
				// $_SESSION['status']=0;
				// 		header("Location:../View/cadastro_trabalho.php?$url_get");
	 		// }
	 	}
	  		//else{
			// 	$_SESSION['status']=0;
			// 			header("Location:../View/cadastro_trabalho.php?$url_get");
	 		// }

	}else{
		foreach ($_POST['idturma'] as $key => $value) {
		    $turma_id=$_POST['idturma'][$key];
			$res_t=$conexao->exec("INSERT INTO trabalho(titulo,descricao, turma_id, disciplina_id, professor_id,data_entrega,extensao,data_hora_visivel,escola_id) VALUES ('$titulo', '$descricao',    $turma_id,$disciplina_id,    $professor_id,'$data_entrega','$extensao' ,'$data_hora_visivel',$idescola)");
		}
		 	
		// $_SESSION['status']=1;
		// 		header("Location:../View/cadastro_trabalho.php?$url_get");

		 
	}

$_SESSION['status']=1;
header("Location:../View/cadastro_trabalho.php?$url_get"); 
} catch (Exception $e) {
	$_SESSION['status']=0;
	echo "$e";
		//header("Location:../View/cadastro_trabalho.php?$url_get");

	
}






	?>