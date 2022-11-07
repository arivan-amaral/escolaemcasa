<?php
session_start();
include_once '../Model/Conexao.php';
include '../Model/Material_apoio.php';

try {
	$titulo = $_POST['titulo'];
	$arquivo = $_FILES['arquivo'];

	$idturma= $_POST['idturma'];
	$iddisciplina = $_POST['iddisciplina'];
	$idescola = $_POST['idescola'];
	
	//diretório para salvar as imagens
	$diretorio = "../View/material_apoio/";
	//Verificar a existência do diretório para salvar as imagens e informa se o caminho é um diretório
	if(!is_dir($diretorio)){ 
	    echo "Pasta $diretorio nao existe";
	}else{    
	    $arquivo = isset($_FILES['arquivo']) ? $_FILES['arquivo'] : FALSE;
	    //loop para ler as imagens
	    // for ($controle = 0; $controle < count($arquivo['name']); $controle++){        
	        //realizar o upload da imagem em php
	        //move_uploaded_file — Move um arquivo enviado para uma nova localização
	        $nome = $arquivo['name'];
	        
	        // $nome = $arquivo['name'][$controle];

	        // $_FILES[ "arquivo"][ 'name' ];
	        $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
	        $extensao = strtolower ( $extensao );
	        if (strstr ( '.pdf;.docx;.doc;.txt;.odt;.pptx;.jpg;.jpeg;.gif;.png;.PNG', $extensao ) && isset($_FILES['arquivo'])) {

		        $novoNome = uniqid ( time () ) . '.' . $extensao;
		        $destino = $diretorio."/".$novoNome;
		        if(move_uploaded_file($arquivo['tmp_name'], $destino)){

		        	cadastrar_material_apoio($conexao, $titulo,$novoNome, $extensao, $idescola, $idturma, $iddisciplina);
			  		$_SESSION['status']=1;
			  		header("Location:../View/professor.php?status=1");
		        } 

	    }else{
			$_SESSION['status']=0;
			header("Location:../View/professor.php");
		}
		


	// } fim do for
  }

} catch (Exception $e) {
	$_SESSION['status']=0;
	header("Location:../View/professor.php");
}

?>