<?php
session_start();
include'../Model/Conexao.php';

  $arquivo = file_get_contents('php://input');
  $json= json_decode($arquivo);

  $phone= $json->phone;
    $mensagem_recebida=$json->text->message;


  $endereco=$json->address;
  $latitude=$json->longitude;
  $longitude=$json->longitude;


function configuracao_api($conexao) {
      $result=$conexao->query("SELECT * FROM whatsapp_configuracao order by id desc limit 1");
      $api="";
      foreach ($result as $key => $value) {
        $api=$value['api'];
      }
    return $api;
 }




function enviar_botao($conexao,$phone,$mensagem){
   $url = configuracao_api($conexao)."send-button-list";
   
   $ch = curl_init($url);




 $body = '{
  "phone": "numero_aqui",
  "message": "Arivan, conseguiu isso através da API do whatsapp? caraca ele é foda mesmo, né?!",

  "buttonList": {
    "buttons": [
      {
        "id": "1",
        "label": "SIM"
      },
      {
        "id": "2",
        "label": "NÃO"
      }
    ]
  }
}';


// $body = '{
//   "phone": "5511912341234",
//   "message": "Selecione e melhor opção:",
//   "optionList": {
//     "title": "Opções disponíveis",
//     "buttonLabel": "Abrir lista de opções",
//     "options": [
//       {
//         "id": "1",
//         "description": "Arivan é foda",
//         "title": "Resposta 1"
//       },
//       {
//         "id": "2",
//         "description": "Arivan é o cara",
//         "title": "Resposta 2"
//       },
//       {
//         "id": "3",
//         "description": "Arivan é o bicho da goiaba branca",
//         "title": "Resposta 4"
//       }
//     ]
//   }
// }';

$decodificado = json_decode($body);
if (!$decodificado) {
    die('JSON invalido');
}
 
$decodificado->phone= $phone;
$decodificado->message= $mensagem;

$body = json_encode($decodificado);

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_AUTOREFERER, false);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_HEADER, 0);        
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);        
    curl_setopt($ch, CURLOPT_POST,true);        
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json; charset=utf-8')); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    
    $result = curl_exec($ch);
    try {

      print_r($result);

    } catch (HttpException $ex) {
      echo"erro". $ex;
    }

    curl_close($ch);
}


function enviar_mensagem($conexao,$phone,$mensagem){
   $url = configuracao_api($conexao)."send-messages";
   
   $ch = curl_init($url);

    $data = array(
        'phone' => $phone,
        'message' => $mensagem
    );

    $body = json_encode($data);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_AUTOREFERER, false);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_HEADER, 0);        
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);        
    curl_setopt($ch, CURLOPT_POST,true);        
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json; charset=utf-8')); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    
    $result = curl_exec($ch);

    curl_close($ch);
}




function saudacao() {
      date_default_timezone_set('America/Sao_Paulo');
      $hora = date('H');

      if( $hora >= 6 && $hora < 12 )
        return 'Bom dia';
      else if ( $hora > 11 && $hora <18  )
        return 'Boa tarde';
      else
        return 'Boa noite';
}


function restaurar_conexao_api($conexao){
 $url = configuracao_api($conexao)."/restore-session";

  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  $data = curl_exec($curl);

  $resposta_json = json_decode($data);
   
  // $status_api=$resposta_json->connected;
       

  curl_close($curl);
  
}



 function obter_status_api($conexao){
  $url = configuracao_api($conexao)."status";

   $curl = curl_init($url);
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   $data = curl_exec($curl);

   $resposta_json = json_decode($data);
    
   $status_api=$resposta_json->connected;
        

   curl_close($curl);
   return $status_api;    
 }


// *******************************************************************************************************************************
// $phone="557799323906";

// $mensagem="Olá, clique nesse link e faça seu pedido https://educalem.com.br/escolaemcasa/View/index.php?phone=$phone";
// if ($phone=="557799323906" || $phone=="558999714032" || $phone=="557799919774") {
//    enviar_mensagem($conexao,$phone,$mensagem);
// }


 // $mensagem="⚠Sua localização foi recebida:\nENDEREÇO:$endereco\nLatitude:$latitude\nLongitude:$longitude";
 $mensagem="";
 $phone="5589999342837";
 enviar_botao($conexao,$phone,$mensagem);
 


 // $status_api= obter_status_api($conexao);
 // if ($status_api) {//só ira atualizar no banco e enviar as mensagens se o status da api estives true
                              
       

 //  }else {
 //    restaurar_conexao_api($conexao);
 //  }
    // *********************************************************************************************************************************
?>