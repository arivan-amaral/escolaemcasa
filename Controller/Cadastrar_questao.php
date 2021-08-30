<?php
session_start();
$professor_id=$_SESSION['idfuncionario'];

include '../Model/Conexao.php';
include '../Model/Questionario.php';
include 'Conversao.php';
try {
$nome_descricao =escape_mimic($_POST['nome']);
$origem_questionario_id = $_POST['origem_questionario_id'];
$tipo = $_POST['tipo'];
$pontos = $_POST['pontos'];
$url = $_POST['url_get'];

// $turma_id= $_POST['turma_id'];
// $disciplina_id = $_POST['disciplina_id'];

	//$url=str_replace(PHP_EOL, '', $url);
	$array_idquestao=array();


	if ( isset( $_FILES["imagem"][ 'name' ] ) && $_FILES[ "imagem"][ 'error' ] == 0 ) {
		$arquivo_tmp = $_FILES[ "imagem" ][ 'tmp_name' ];
		$nome = $_FILES[ "imagem"][ 'name' ];
		$extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
		$extensao = strtolower ( $extensao );

		if ( strstr ( '.pdf;.docx;.doc;.txt;.odt;.pptx;.jpg;.jpeg;.gif;.png;.PNG', $extensao ) ) {	    	    

			$novoNome = uniqid ( time () ) . '.' . $extensao;
			$destino = '../View/arquivo/' . $novoNome;
			if(move_uploaded_file($arquivo_tmp, $destino)){
				
				$res_origem_questionario_id=listar_questionario_mesma_origem($conexao,$origem_questionario_id);

				foreach ($_POST['escola_turma_disciplina'] as $key => $value) {

					$questionario_id=$_POST['escola_turma_disciplina'][$key];
					
					$result=cadastrar_questao($conexao,$nome_descricao, $tipo, $pontos,$questionario_id,$origem_questionario_id);
					$questao_id=$result[1];
					$resultado_arquivo=cadastrar_arquivo($conexao,$novoNome, $questao_id, $extensao,$origem_questionario_id);
					
					$array_idquestao[$questao_id]=$questao_id;
				}

			}

		}
	}else{
		//echo "string";

		$res_origem_questionario_id=listar_questionario_mesma_origem($conexao,$origem_questionario_id);

		foreach ($_POST['escola_turma_disciplina'] as $key => $value) {
			$questionario_id=$_POST['escola_turma_disciplina'][$key];
			$result=cadastrar_questao($conexao,$nome_descricao, $tipo, $pontos,$questionario_id,$origem_questionario_id);
			$questao_id=$result[1];
			
			
			$array_idquestao[$questao_id]=$questao_id;
			//echo "t: ".$array_idquestao[$questao_id]."<br>";
		}

	}

	
	
foreach ($array_idquestao as $key => $value) {
	$questao_id=$value;

	if ($tipo=="multipla" || $tipo=="multipla_justificada"){
		for ($i=1; $i < 6 ; $i++) {
			$alternativa = $_POST['alternativa'.$i];
			$alternativa=escape_mimic($alternativa);
			cadastrar_alternativa($conexao, $alternativa, $tipo, $questao_id,$origem_questionario_id);
		}

	}else{
		cadastrar_alternativa($conexao,$nome, $tipo,$questao_id,$origem_questionario_id);
	}


}


	$_SESSION['status']=1;
	header("Location:../View/adicionar_questao.php?$url");
} catch (Exception $e) {
	$_SESSION['status']=0;
	//$_SESSION['mensagem']="".$e;
	echo "$e";
	//header("Location:../View/adicionar_questao.php?$url");
}
?>