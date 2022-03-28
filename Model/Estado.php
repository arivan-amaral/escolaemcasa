<?php 
	function listar_estado($conexao){
		$result=$conexao->query("SELECT * FROM estado order by nome asc");
		return $result;
	}	
 	

	function listar_cidade_por_idestado($conexao,$idestado){
		$result=$conexao->query("SELECT * FROM cidade where id_estado = $idestado  order by nome asc");
		return $result;
	}	
	function listar_estado_por_id($conexao,$idestado){
		$result=$conexao->query("SELECT * FROM estado where id = $idestado  order by nome asc");
		return $result;
	}


?>