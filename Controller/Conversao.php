<?php 
date_default_timezone_set('America/Bahia');

function escape_mimic($inp) { 
    if(is_array($inp)) 
        return array_map(__METHOD__, $inp); 

    if(!empty($inp) && is_string($inp)) { 
        return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp); 
    } 

    return $inp; 
} 

 function converte_telefone($whatsapp){
      $whatsapp= trim($whatsapp);
	 $whatsapp= str_replace(' ', '', $whatsapp);
 	 $whatsapp= str_replace('(', '', $whatsapp);
 	 $whatsapp= str_replace(')', '', $whatsapp);
 	 $whatsapp= str_replace('-', '', $whatsapp);
   
     $whatsapp= str_replace('.', '', $whatsapp);
     $whatsapp= str_replace(',', '', $whatsapp);
     $whatsapp= str_replace('_', '', $whatsapp);
     $whatsapp= str_replace("'", '', $whatsapp);
     
 	 return $whatsapp;
}

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
}function converte_data_hora($data){
    return date("d/m/Y H:i", strtotime($data));
}
	

?>