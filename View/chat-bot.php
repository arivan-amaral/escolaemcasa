<?php
include'../Model/Conexao.php';
include'../Controller/Conversao.php';

$indice=$_GET['indice'];

function configuracao_api($conexao) {
      $result=$conexao->query("SELECT * FROM whatsapp_configuracao order by id asc limit 1");
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
        "label": "SOU EU MESMO!"
      },
      {
        "id": "2",
        "label": "FOI ENGANO!"
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
     return $result;

    } catch (HttpException $ex) {
      echo"erro". $ex;
     return $result;

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

try {
    

// *******************************************************************************************************************************
// $phone="557799323906";

// $mensagem="Olá, clique nesse link e faça seu pedido https://educalem.com.br/escolaemcasa/View/index.php?phone=$phone";
// if ($phone=="557799323906" || $phone=="558999714032" || $phone=="557799919774") {
//    enviar_mensagem($conexao,$phone,$mensagem);
// }


// {
//   "phone": "554499999999",
//   "participantPhone": "",
//   "messageId": "FAED4759731983BEAED6",
//   "status": "RECEIVED",
//   "referenceMessageId": "",
//   "momment": 1580164366,
//   "type": "ReceivedCallback",
//   "photo": "", 
//   "location": {
//     "longitude": -51.9375,
//     "latitude": -23.4273,
//     "url": "",
//     "name": "",
//     "address": "",
//     "thumbnailUrl": ""
//   },
// }


// $conexao->exec("INSERT into whatsapp_configuracao (campo) values ('$json')");
 //$mensagem="⚠Sua localização foi recebida:\nENDEREÇO:$endereco\nLatitude:$latitude\nLongitude:$longitude";

$res=$conexao->query("SELECT * FROM aluno where status='Ativo' limit $indice ,20 ");
foreach ($res as $key => $value) {
        $aluno_id=$value['idaluno'];
        $nome_aluno=$value['nome'];
        $whatsapp='55'.trim($value['whatsapp']);
        $whatsapp_responsavel='55'.trim($value['whatsapp_responsavel']);
        
        $whatsapp='5589999342837';
        $whatsapp_responsavel='5589999342837';
        
        $mensagem="Olá $nome_aluno!
        Esperamos que todos estejam bem! 😊

        Esse número enviará mensagens automáticas com informativos importantes para você ou para seu responsável sobre seus estudos na plataforma de ensino EDUCALEM (educalem.com.br) neste período remoto! 👩‍💻👨‍💻

        Lembrete: são mensagens automáticas do sistema, portanto, qualquer dúvida entre em contato com seu professor pelo grupo do Whatsapp de sua turma! 

        A equipe da Secretaria de Educação de Luis Eduardo Magalhães deseja a você bons estudos!
        📖📚";
        $conexao->exec("UPDATE aluno set enviado =1 where idaluno = $aluno_id");

         $resultado_mensagem= enviar_botao($conexao,$whatsapp,$mensagem);
         $decodificado = json_decode($resultado_mensagem);
        if (!$decodificado) {
            die('JSON invalido');
        }
        $zaapId=$decodificado->zaapId;
        $messageId=$decodificado->messageId;

        $conexao->exec("INSERT INTO mensagem_enviada(aluno_id, zap_id, mensagem_id) VALUES ($aluno_id,'$zaapId','$messageId')"); 


        $resultado_mensagem= enviar_botao($conexao,$whatsapp_responsavel,$mensagem);
         $decodificado = json_decode($resultado_mensagem);
        if (!$decodificado) {
            die('JSON invalido');
        }
        $zaapId=$decodificado->zaapId;
        $messageId=$decodificado->messageId;

        $conexao->exec("INSERT INTO mensagem_enviada(aluno_id, zap_id, mensagem_id) VALUES ($aluno_id,'$zaapId','$messageId')");

}
 //print_r($json);


 // $status_api= obter_status_api($conexao);
 // if ($status_api) {//só ira atualizar no banco e enviar as mensagens se o status da api estives true
      $novo_indice=$indice + 20;        
       echo"<a href='https://educalem.com.br/escolaemcasa/View/chat-bot.php?indice=$novo_indice' target='_blank'>Carregar mais $indice + $novo_indice</a>";

 //  }else {
 //    restaurar_conexao_api($conexao);
 //  }
    // *********************************************************************************************************************************

 } catch (Exception $e) {
    echo "$e";
}

?>