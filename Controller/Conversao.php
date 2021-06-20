<?php 
date_default_timezone_set('America/Bahia');

	function converter_utf8($texto){

	  $texto=str_replace('Ã¡', 'á', $texto);

	  $texto= str_replace('Ã§', 'ç', $texto); 

	  $texto= str_replace('Ã£', 'ã', $texto); 

	  $texto= str_replace('Ã©', 'é', $texto);

	  $texto= str_replace('Ã³', 'Ó', $texto);

	  $texto= str_replace('ÃŠ', 'Ê', $texto);

	  $texto= str_replace('Ã', 'Á', $texto);

	  $texto= str_replace('Ã‡', 'Ç', $texto);

	  $texto= str_replace('Âº', 'º', $texto);

	  $texto= str_replace('Ã', 'Í', $texto);

	  return $texto;

	}
function hora($data){
   	return date("H:i", strtotime($data));
} 

function data($data){
    return date("d/m/Y H:i", strtotime($data));

}

function data_simples($data){
    return date("Y-m-d", strtotime($data));
}
function converte_data($data){
    return date("d/m/Y", strtotime($data));
}
	

?>