<?php session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Professor.php';

if (isset($_SESSION['idcoordenador'])) {
    $idprofessor=$_SESSION['idcoordenador'];

}else {
  $idprofessor=$_SESSION['idprofessor'];
}

	try {
		$res_pes_img = pesquisar_imagem_professor($conexao,$idprofessor);
		$cont=0;
		foreach ($res_pes_img as $key => $value) {
			$cont++;
		}
		if ($cont==0) {
			inserir_imagem_padrao_professor($conexao, $idprofessor);
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

					alterar_foto_professor($conexao, $novoNome, $idprofessor);
					
					$_SESSION['status']=1;

					if (isset($_SESSION['idcoordenador'])) {
		 				header("Location:../View/coordenador.php?status=1");
					}else {
		 				header("Location:../View/professor.php?status=1");
					  
					}
		 		}
			}
		}


	} catch (Exception $e) {
		$_SESSION['status']=0;
		header("Location:../View/professor.php?status=0");

	}

?>