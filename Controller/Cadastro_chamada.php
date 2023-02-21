<?php
session_start();
include_once '../Model/Conexao.php';
include_once '../Model/Chamada.php';

try {

	$funcionario_id = $_POST['funcionario'];
	$descricao = $_POST['descricao'];
	$tipo_solicitacao = $_POST['tipo_solicitacao'];
	$setor_id = $_POST['setor'];
	$data = date('Y-m-d H:i');
	$novoNome= '';
	//$url_get = $_POST['url_get'];

	if(!empty(array_filter($_FILES['arquivo']['name']))) {
		if ($tipo_solicitacao == "") {
			criar_chamada($conexao,$funcionario_id,$setor_id,'esperando_resposta','',$data);

		}else{
			criar_chamada($conexao,$funcionario_id,$setor_id,'esperando_resposta',$tipo_solicitacao,$data);

		}
		$id_chamada = $conexao->lastInsertId();
		conversa_chat($conexao,$id_chamada,$funcionario_id,$descricao,$data);
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
                    header("Location:../View/cadastrar_chamada.php");

                }else{
                    $_SESSION['status']=0;
                   header("Location:../View/cadastrar_chamada.php");


                }
            }else{
            	$_SESSION['mensagem'] = "imagem não é suportado";
                $_SESSION['status']=0;

                header("Location:../View/cadastrar_chamada.php");
            }
    
        }

    }else{

    	if ($tipo_solicitacao == "") {
			criar_chamada($conexao,$funcionario_id,$setor_id,'esperando_resposta','',$data);

		}else{
			criar_chamada($conexao,$funcionario_id,$setor_id,'esperando_resposta',$tipo_solicitacao,$data);

		}
		$id_chamada = $conexao->lastInsertId();
    	conversa_chat($conexao,$id_chamada,$funcionario_id,$descricao,$data);
		$_SESSION['status']=1;
		header("Location:../View/cadastrar_chamada.php");
    }

} catch (Exception $e) {
	//$_SESSION['status']=0;
		//header("Location:../View/cadastro_trabalho.php?$url_get");
	echo $e;
	
}






	?>