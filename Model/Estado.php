<?php 
	function listar_estado($conexao){
		$result=$conexao->query("SELECT * FROM estado order by nome asc");
		return $result;
	}	

	function listar_cidade_por_idestado($conexao,$idestado){
		$result=$conexao->query("SELECT * FROM cidade where id_estado = $idestado  order by nome asc");
		return $result;
	}


?>