<?php
session_start();
include_once '../Model/Conexao.php';
include '../Model/Chamada.php';

try {

	$funcionario_id = $_POST['id_funcionario'];
	$descricao = $_POST['resposta'];
	$data = date('Y-m-d H:i');
	$id_chamada = $_POST['id_chamado'];
	//$url_get = $_POST['url_get'];
	if(!empty(array_filter($_FILES['arquivo']['name']))) {
		
		responder_chat($conexao,$id_chamada,$funcionario_id,$descricao,$data);
        foreach ($_FILES['arquivo']['tmp_name'] as $key => $value) {
        $arquivo_tmp = $_FILES[ "arquivo" ][ 'tmp_name' ][$key];
        $nome = $_FILES[ "arquivo"][ 'name' ][$key];
        $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
        $extensao = strtolower ( $extensao );

            if ( strstr ( '.pdf;.docx;.doc;.txt;.odt;.pptx;.jpg;.jpeg;.gif;.png;.PNG', $extensao ) ) {
                $novoNome = uniqid ( time () ) . '.' . $extensao;
                $destino = '../View/chamados/' . $novoNome;
                if(move_uploaded_file($arquivo_tmp, $destino)){
                        
                    cadastra_arquivos($conexao,$id_chamada,$novoNome);
                   
                    $_SESSION['status'] = 1;
                    header("Location:../View/lista_minhas_chamadas.php");

                }else{
                    $_SESSION['status']=0;
                    header("Location:../View/lista_minhas_chamadas.php");


                }
            }else{
                $_SESSION['status']=0;
                header("Location:../View/lista_minhas_chamadas.php");
            }
    
        }

    }else{

    	responder_chat_sem_arquivo($conexao,$id_chamada,$funcionario_id,$descricao,$data);
		$_SESSION['status']=1;
		header("Location:../View/lista_minhas_chamadas.php");
    }

	

} catch (Exception $e) {
	//$_SESSION['status']=0;
		//header("Location:../View/cadastro_trabalho.php?$url_get");
	echo $e;
	
}






	?>