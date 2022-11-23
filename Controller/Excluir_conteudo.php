<?php
session_start();
include_once '../Model/Conexao.php';
include '../Model/Aluno.php';

$idprofessor=$_SESSION['idfuncionario'];
$conteudo_aula_id=$_GET['idconteudo'];

try {

	if (isset($_SESSION['idfuncionario'])) {
		excluir_frequencia_lancada($conexao,$conteudo_aula_id,$idprofessor);
		echo "Ação concluída";
	}else{
		echo "Não logado";

	}
 
} catch (Exception $e) {
echo "Não consta esse conteúdo na base de dados, portanto apenas desmarque a opção da disciplina acima!   ";
	 
	 
}

?>