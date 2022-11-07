<?php
session_start();
include_once '../Model/Conexao.php';
include '../Model/Trabalho.php';

try {
	$aluno_id=$_SESSION['idaluno'];
	$comentario = $_POST['comentario'];
	$arquivo = $_FILES['arquivo'];

	$turma_id= $_POST['idturma'];
	$disciplina_id = $_POST['iddisciplina'];
	$idtrabalho = $_POST['idtrabalho'];
	
	$nome_disciplina=$_POST['nome_disciplina'];
	$nome_turma=$_POST['nome_turma'];
	$url_get="idtrabalho=$idtrabalho&iddisciplina=$disciplina_id&idturma=$turma_id&turma=$nome_turma&disciplina=$nome_disciplina";

	//diretório para salvar as imagens
	$diretorio = "../View/trabalho_entregue/";
	//Verificar a existência do diretório para salvar as imagens e informa se o caminho é um diretório
	if(!is_dir($diretorio)){ 
	    echo "Pasta $diretorio nao existe";
	}else{    
	    $arquivo = isset($_FILES['arquivo']) ? $_FILES['arquivo'] : FALSE;
	    //loop para ler as imagens
	    for ($controle = 0; $controle < count($arquivo['name']); $controle++){        
	        //realizar o upload da imagem em php
	        //move_uploaded_file — Move um arquivo enviado para uma nova localização
	        $nome = $arquivo['name'][$controle];
	        // $_FILES[ "arquivo"][ 'name' ];
	        $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
	        $extensao = strtolower ( $extensao );
	        if (strstr ( '.pdf;.docx;.doc;.txt;.odt;.pptx;.jpg;.jpeg;.gif;.png;.PNG', $extensao ) && isset($_FILES['arquivo'])) {

		        $novoNome = uniqid ( time () ) . '.' . $extensao;
		        $destino = $diretorio."/".$novoNome;
		        if(move_uploaded_file($arquivo['tmp_name'][$controle], $destino)){
		        	$conexao->exec("INSERT INTO trabalho_entregue ( caminho,extensao, disciplina_id,turma_id,comentario,aluno_id,trabalho_id) VALUES
			  			('$novoNome','$extensao', $disciplina_id,$turma_id,'$comentario',$aluno_id,$idtrabalho )");
			  			$_SESSION['status']=1;
			  			header("Location:../View/trabalho_individual.php?status=1&$url_get");
		            
		        }       
	    }else if (isset($comentario) && $comentario!="") {
			 	$conexao->exec("INSERT INTO trabalho_entregue
			  	( disciplina_id,turma_id,comentario,aluno_id,trabalho_id) VALUES
			  	(  $disciplina_id,$turma_id,'$comentario',$aluno_id,$idtrabalho )");
			  	$_SESSION['status']=1;
			  	header("Location:../View/trabalho_individual.php?status=1&$url_get");
		}else{
					$_SESSION['status']=0;
				 	header("Location:../View/trabalho_individual.php?status=10&$url_get");
		}
		


	}
  }

} catch (Exception $e) {
	$_SESSION['status']=0;
	header("Location:../View/trabalho_individual.php?status=0&$url_get");
}

?>