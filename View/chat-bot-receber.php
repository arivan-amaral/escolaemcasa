<?php
session_start();
include_once '../Model/Conexao.php';
include_once '../Controller/Conversao.php';


function configuracao_api($conexao) {
      // $result=$conexao->query("SELECT * FROM whatsapp_configuracao order by id desc limit 1");
      // $api="";
      // foreach ($result as $key => $value) {
      //   $api=$value['api'];
      // }
    return "https://api.z-api.io/instances/3A2EC867CCA5E06B760AD6B4039C5465/token/362A03F940A28C5AE32AF9C4/";
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


function enviar_link($conexao,$phone,$mensagem){
   $url = configuracao_api($conexao)."send-link";
   
   $ch = curl_init($url);

    $data = array(
        'phone' => $phone,
        'message' => $mensagem,
        "image" => "",
        "linkUrl" => "https://youtu.be/ub_1CMDrb8Q",
        "title" => "Melhorias na forma de registro dos conteúdos das aulas.",
        "linkDescription"  => "Melhorias na forma de registro dos conteúdos das aulas."
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




function enviar_botao($conexao,$phone,$mensagem){
   $url = configuracao_api($conexao)."send-button-list";
   
   $ch = curl_init($url);




//  $body = '{
//   "phone": "numero_aqui",
//   "message": "Arivan, conseguiu isso através da API do whatsapp? caraca ele é foda mesmo, né?!",

//   "buttonList": {
//     "buttons": [
//       {
//         "id": "1",
//         "label": "SOU EU!"
//       },{
//         "id": "1",
//         "label": "NÃO SOU EU!"
//       }
//     ]
//   }
// }';




$body = '{
  "phone": "5511912341234",
  "message": "Selecione e melhor opção:",
  "optionList": {
    "title": "Opções disponíveis",
    "buttonLabel": "Abrir lista de opções",
    "options": [
      {
        "id": "1",
        "description": "Arivan é foda",
        "title": "Resposta 1"
      },
      {
        "id": "2",
        "description": "Arivan é o cara",
        "title": "Resposta 2"
      },
      {
        "id": "3",
        "description": "Arivan é o bicho da goiaba branca",
        "title": "Resposta 4"
      }
    ]
  }
}';



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
     return $result;

    } catch (HttpException $ex) {
      echo"erro". $ex;
     return $result;

    }

    curl_close($ch);
}

// ***************************************************************************************************************************
         
  $arquivo = file_get_contents('php://input');
  $json= json_decode($arquivo);


//   {
//   "instanceId": "A20DA9C0183A2D35A260F53F5D2B9244",
//   "messageId": "A20DA9C0183A2D35A260F53F5D2B9244",
//   "phone": "5544999999999",
//   "fromMe": false,
//   "momment": 1632228638000,
//   "status": "RECEIVED",
//   "chatName": "name",
//   "senderPhoto": "https://",
//   "senderName": "name",
//   "participantPhone": null,
//   "photo": "https://",
//   "broadcast": false,
//   "type": "ReceivedCallback",
//   "text": {
//     "message": "teste"
//   }
// }
// 
// "location": {
//     "longitude": -51.9375,
//     "latitude": -23.4273,
//     "url": "",
//     "name": "",
//     "address": "",
//     "thumbnailUrl": ""
//   },
// }

  $phone= $json->phone;
  $resposta_id= $json->referenceMessageId;

  $latitude=$json->location->latitude;
  $longitude=$json->location->longitude;

    $url=$json->location->url;
    $name=$json->location->name;
    $address=$json->location->address;
    $thumbnailUrl=$json->location->thumbnailUrl;




  $conexao->exec("INSERT into mensagem_enviada (status,mensagem_id) VALUES ('$resposta_id','$mensagem_id')");
 $mensagem="⚠Sua localização foi recebida:\nENDEREÇO:$endereco\nLatitude:$latitude\nLongitude:$longitude";

  //$mensagem="vc enviou : ". $mensagem_recebida;
  //enviar_mensagem($conexao,'558999342837',$mensagem);
   enviar_mensagem($conexao,$phone,$mensagem);


// ***************************************************************************************************************************
?>