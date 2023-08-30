<?php session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Aluno.php';

$idaluno=$_SESSION['idaluno'];

	try {
		$res_pes_img = pesquisar_imagem_aluno($conexao,$idaluno);
		$cont=0;
		foreach ($res_pes_img as $key => $value) {
			$cont++;
		}
		if ($cont==0) {
			inserir_imagem_padrao_aluno($conexao, $idaluno);
		}

		if ( isset( $_FILES["imagem"][ 'name' ] ) && $_FILES[ "imagem"][ 'error' ] == 0 ) {
			$arquivo_tmp = $_FILES[ "imagem".$i ][ 'tmp_name' ];
			$nome = $_FILES[ "imagem"][ 'name' ];
			$extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
			$extensao = strtolower ( $extensao );
			if ( strstr ( '.jpg;.jpeg;.gif;.png;.PNG', $extensao ) ) {
			    $novoNome = uniqid ( time () ) . '.' . $extensao;
			    $destino = '../View/fotos/' . $novoNome;
			    if(move_uploaded_file($arquivo_tmp, $destino)){
					alterar_foto_aluno($conexao, $novoNome, $idaluno);
					$_SESSION['status']=1;
		 			header("Location:../View/aluno.php?status=1");
		 		}
			}
		}


	} catch (Exception $e) {
		$_SESSION['status']=0;
		header("Location:../View/aluno.php?status=0");

	}

?>