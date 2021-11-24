<?php
session_start();
include '../Model/Conexao.php';
include '../Model/Turma.php';



try {
	$idserie=$_GET['idserie'];

	$result="<label for='exampleInputEmail1'>Turma</label>
	<select class='form-control' name='turma' id='idturma'  onchange='listar_etapas_cad_aluno()'>
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