<?php
session_start();
include '../Model/Conexao.php';
include '../Model/Chamada.php';

try {

	$funcionario_id = $_POST['funcionario'];
	$descricao = $_POST['descricao'];
	$setor_id = $_POST['setor'];
	$arquivo = $_FILES['arquivo'];
	$data = date('Y-m-d H:i');
	$novoNome= '';
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
		    		
		    	criar_chamada($conexao,$funcionario_id,$setor_id,'esperando_resposta');
		    	$id_chamada = $conexao->lastInsertId();
		    	conversa_chat($conexao,$id_chamada,$funcionario_id,$descricao, $novoNome,$data);

				$_SESSION['status']=1;
				header("Location:../View/cadastrar_chamada.php");

	 		}else{
				$_SESSION['status']=0;
						header("Location:../View/cadastrar_chamada.php");


	 		}
	    }else{
				$_SESSION['status']=0;
				header("Location:../View/cadastrar_chamada.php");


	 	}

	}else{
		criar_chamada($conexao,$funcionario_id,$setor_id,$descricao,'esperando_resposta');
		$id_chamada = $conexao->lastInsertId();
    	conversa_chat($conexao,$id_chamada,$funcionario_id,$descricao,'',$data);
		$_SESSION['status']=1;
		header("Location:../View/cadastrar_chamada.php");
		 
	}


} catch (Exception $e) {
	//$_SESSION['status']=0;
		//header("Location:../View/cadastro_trabalho.php?$url_get");
	echo $e;
	
}






	?>