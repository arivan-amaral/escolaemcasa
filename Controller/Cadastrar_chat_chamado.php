<?php
session_start();
include '../Model/Conexao.php';
include '../Model/Chamada.php';

try {

	$funcionario_id = $_POST['id_funcionario'];
	$descricao = $_POST['resposta'];
	$data_previsao = $_POST['data_previsao'];
	$arquivo = $_FILES['arquivo'];
	$data = date('Y-m-d H:i');
	$id_chamada = $_POST['id_chamado'];
	//$url_get = $_POST['url_get'];

	if ( isset( $_FILES["arquivo"][ 'name' ] ) && $_FILES[ "arquivo"][ 'error' ] == 0 ) {
		$arquivo_tmp = $_FILES[ "arquivo" ][ 'tmp_name' ];
		$nome = $_FILES[ "arquivo"][ 'name' ];
		$extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
		$extensao = strtolower ( $extensao );

		if ( strstr ( '.pdf;.docx;.doc;.txt;.odt;.pptx;.jpg;.jpeg;.gif;.png;.PNG', $extensao ) ) {
		    $novoNome = uniqid ( time () ) . '.' . $extensao;
		    $destino = '../View/chamadas/' . $novoNome;
		    if(move_uploaded_file($arquivo_tmp, $destino)){
		    		
		    	responder_chat($conexao,$id_chamada,$funcionario_id,$descricao,$novoNome,$data);
		    	atualizar_chamado_data_prevista($conexao,$id_chamada,$data_previsao);
				$_SESSION['status']=1;
				header("Location:../View/chamada.php");

	 		}else{
				$_SESSION['status']=0;
						header("Location:../View/chamada.php");


	 		}
	    }else{
				$_SESSION['status']=0;
				header("Location:../View/chamada.php");


	 	}

	}else{
		responder_chat_sem_arquivo($conexao,$id_chamada,$funcionario_id,$descricao,$data);
		atualizar_chamado_data_prevista($conexao,$id_chamada,$data_previsao);
		$_SESSION['status']=1;
		header("Location:../View/chamada.php");
		 
	}


} catch (Exception $e) {
	//$_SESSION['status']=0;
		//header("Location:../View/cadastro_trabalho.php?$url_get");
	echo $e;
	
}






	?>