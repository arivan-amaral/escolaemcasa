<?php
session_start();
$professor_id=$_SESSION['idfuncionario'];

include '../Model/Conexao.php';
include '../Model/Questionario.php';
$nome = $_POST['nome'];
$nome=str_replace("'", '^;', $nome);

$questionario_id = $_POST['questionario_id'];
$tipo = $_POST['tipo'];
$pontos = $_POST['pontos'];
$turma_id= $_POST['turma_id'];
$disciplina_id = $_POST['disciplina_id'];
try {
$url="id=$questionario_id&turm=$turma_id&disc=$disciplina_id&nome=$nome";
$url=str_replace(PHP_EOL, '', $url);
	$result=cadastrar_questao($conexao,$nome, $tipo, $pontos,$questionario_id);
	$questao_id=$result[1];
				if ( isset( $_FILES["imagem"][ 'name' ] ) && $_FILES[ "imagem"][ 'error' ] == 0 ) {
		    	    $arquivo_tmp = $_FILES[ "imagem" ][ 'tmp_name' ];
		    	    $nome = $_FILES[ "imagem"][ 'name' ];
		    	    $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
		    	    $extensao = strtolower ( $extensao );

					if ( strstr ( '.pdf;.docx;.doc;.txt;.odt;.pptx;.jpg;.jpeg;.gif;.png;.PNG', $extensao ) ) {	    	    
		    	    
		    	        $novoNome = uniqid ( time () ) . '.' . $extensao;
		    	        $destino = '../View/arquivo/' . $novoNome;
		    	        if(move_uploaded_file($arquivo_tmp, $destino)){
							$resultado_arquivo=cadastrar_arquivo($conexao,$novoNome, $questao_id, $extensao);
		    	        }
	 					
		    	    }
		    	}

	if ($tipo=="multipla" || $tipo=="multipla_justificada"){
		for ($i=1; $i < 6 ; $i++) {
			$alternativa = $_POST['alternativa'.$i];
			
			$alternativa=str_replace("'", '^;', $alternativa);

			cadastrar_alternativa($conexao, $alternativa, $tipo, $questao_id);
		}

	}else{
		cadastrar_alternativa($conexao,$nome, $tipo,$questao_id);
	}
$_SESSION['status']=1;
header("Location:../View/adicionar_questao.php?$url");
} catch (Exception $e) {
	$_SESSION['status']=0;
    header("Location:../View/adicionar_questao.php?id=$questionario_id&turm=$turma_id&disc=$disciplina_id&status=0");
}
?>