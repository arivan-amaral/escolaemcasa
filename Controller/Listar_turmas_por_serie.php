<?php
session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Turma.php';



try {
	$idserie=$_GET['idserie'];

	$result="<label for='exampleInputEmail1'>Turma</label>
	<select class='form-control' name='idturma' id='idturma'  onchange='listar_etapas_cad_aluno()'>
	<option></option>";
	$res=lista_de_turmas($conexao,$idserie);
	foreach ($res as $key => $value) {
		$idturma=$value['idturma'];
		$nome_turma=$value['nome_turma'];
		$result.="
		<option value='$idturma'>$nome_turma</option>
		";
	}

	$result.="</select>";


echo "$result";
} catch (Exception $e) {
	echo 'Erro ao carregar, verifique sua conexão com a internet';
}

?>