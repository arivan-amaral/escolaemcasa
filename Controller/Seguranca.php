<?php 
	function remover_mysql_inject($texto){
		$texto= preg_replace('/[\'\"]/', '',$texto);
		$texto= preg_replace('/[\=]/', '',$texto);
		return $texto;	
	}
?>