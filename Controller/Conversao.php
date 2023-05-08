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

function data_minima_para_idade($idade) {
 $today = new DateTime();
  $earliestBirthdate = $today->sub(new DateInterval('P' . ($idade + 1) . 'Y'))->add(new DateInterval('P1D'));
  return $earliestBirthdate->format('Y-m-d');
}
function data_maxima_para_idade($idade) {
 $today = new DateTime(); // data atual
  $latestBirthdate = $today->sub(new DateInterval('P' . $idade . 'Y')); // subtrai a idade da data atual
  return $latestBirthdate->format('Y-m-d'); // formata a data no formato desejado
}


function converte_idade($data){

           list($ano, $mes, $dia) = explode('-', $data);

        // data atual
        $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        // Descobre a unix timestamp da data de nascimento do fulano
        $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);

        // cálculo
        $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
     return $idade;
     }

     function converte_idade_data_corte($data){

           list($ano, $mes, $dia) = explode('-', $data);

        // data atual
        $hoje = mktime(0, 0, 0, 03, 31, date('Y'));
        // Descobre a unix timestamp da data de nascimento do fulano
        $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);

        // cálculo
        $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
     return $idade;
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
}
function converte_data_hora($data){
    return date("d/m/Y H:i", strtotime($data));
}

function incrementar_dia_data($data_atual){

    $d1 = new DateTime($data_atual); // Data e hora que o atendimento começou
    //$d2 = "+$dia day"; // Tempo esperado para finalizar o atendimento
    $d1->modify('+1day');
    //$data_atual= date($data_atual, $teste);

    return $d1;
}

function verifica_seguimento($conexao,$idturma){
    $res_seg=$conexao->query("SELECT * FROM turma WHERE idturma=$idturma LIMIT 1");
    
    $serie_seguimento = array();
    foreach ($res_seg as $key => $value) {
      $serie_seguimento['serie_id']=$value['serie_id'];
      $serie_seguimento['seguimento']=$value['seguimento'];

    }

    return $serie_seguimento;
}

// 
    // $diferenca=(strtotime($data_atual) - strtotime($data_banco));


function verificarNome($nome) {
    $partesNome = explode(" ", $nome); // Divide o nome em partes separadas por espaços
    
    // Verifica se o nome tem mais de duas partes (nome próprio, sobrenome do meio e sobrenome)
    if (count($partesNome) > 2) {
        $sobrenomeMeio = $partesNome[1]; // Obtém o sobrenome do meio
        $sobrenomeMeio2 = $partesNome[2]; // Obtém o sobrenome do meio
        
        // Verifica se o sobrenome do meio é muito longo (mais de 10 caracteres)
        if (strlen($nome) > 20) {
            // Abrevia o sobrenome do meio para a primeira letra e adiciona um ponto final
            $partesNome[1] = substr($sobrenomeMeio, 0, 1) . ".";
        }else if (strlen($nome) > 20){
            $partesNome[1] = substr($sobrenomeMeio, 0, 1) . ".";
            $partesNome[2] = substr($sobrenomeMeio2, 0, 1) . ".";

        }
        
        // Reconstroi o nome com a abreviação do sobrenome do meio
        $nomeAbreviado = implode(" ", $partesNome);
        
        return $nomeAbreviado;
    }
    
    return $nome; // Retorna o nome original se não precisar ser abreviado
}

// Exemplo de uso
$nomeCompleto = "João da Silva Oliveira";
$nomeAbreviado = verificarNome($nomeCompleto);
return $nomeAbreviado; // Saída: João S. Oliveira

  
?>