<?php
session_start();
include_once 'ImageResize.php';
include_once '../Model/Conexao.php';
include_once '../Model/Trabalho.php';
$ds = DIRECTORY_SEPARATOR;  //1

	

		$storeFolder = "../View/teste_drop";
		 
		if (!empty($_FILES)) {
		     
		    $tempFile = $_FILES['file']['tmp_name'];          //3             
		      
		    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
		     
		    $targetFile =  $targetPath. $_FILES['file']['name'];  //5

			

			// $nome = $arquivo['name']['tmp_name'];
			// $_FILES[ "file"][ 'name' ];
	         $extensao = pathinfo ( $targetFile, PATHINFO_EXTENSION );
	         $extensao = strtolower ( $extensao );
			// if ($extensao =="jpg") {
				$image = new \Gumlet\ImageResize("$tempFile");
				$image->quality_jpg = 10;
				$image->save("$targetFile");
			// }else {
   //  			//move_uploaded_file($tempFile,$targetFile); 
			// }
			

		}


	//     $arquivo = isset($_FILES['arquivo']) ? $_FILES['arquivo'] : FALSE;
	//     //loop para ler as imagens
	//     for ($controle = 0; $controle < count($arquivo['name']); $controle++){   


	//         //realizar o upload da imagem em php
	//         //move_uploaded_file — Move um arquivo enviado para uma nova localização
	//         $nome = $arquivo['name'][$controle];
	//         // $_FILES[ "arquivo"][ 'name' ];
	//         $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
	//         $extensao = strtolower ( $extensao );
	//         if (strstr ( '.pdf;.docx;.doc;.txt;.odt;.pptx;.jpg;.jpeg;.gif;.png;.PNG', $extensao ) && isset($_FILES['arquivo'])) {

	// 	        $novoNome = uniqid ( time () ) . '.' . $extensao;
	// 	        $destino = $diretorio."/".$novoNome;


	// 	        if(move_uploaded_file($arquivo['tmp_name'][$controle], $destino)){

	// 	        	$conexao->exec("INSERT INTO trabalho_entregue ( caminho,extensao, disciplina_id,turma_id,comentario,aluno_id,trabalho_id) VALUES
	// 		  			('$novoNome','$extensao', $disciplina_id,$turma_id,'$comentario',$aluno_id,$idtrabalho )");

	// 		  			$_SESSION['status']=1;
	// 		  			header("Location:../View/trabalhos.php?status=1&$url_get");
	// 	        }    


	// 	    }else if (isset($comentario) && $comentario!="") {
	// 			 	$conexao->exec("INSERT INTO trabalho_entregue
	// 			  	( disciplina_id,turma_id,comentario,aluno_id,trabalho_id) VALUES
	// 			  	(  $disciplina_id,$turma_id,'$comentario',$aluno_id,$idtrabalho )");
	// 			  	$_SESSION['status']=1;
	// 			  	header("Location:../View/trabalhos.php?status=1&$url_get");
	// 		}else{
	// 					$_SESSION['status']=0;
	// 				 	header("Location:../View/trabalhos.php?status=10&$url_get");
	// 		}
		


	

	// }

  // }


?>