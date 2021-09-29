<?php
session_start();
include'../Model/Conexao.php';
include'Conversao.php';



function configuracao_api($conexao) {
      $result=$conexao->query("SELECT * FROM whatsapp_configuracao order by id desc limit 1");
      $api="";
      foreach ($result as $key => $value) {
        $api=$value['api'];
      }
    return $api;
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


// ***************************************************************************************************************************
         
  $arquivo = file_get_contents('php://input');
  $json= json_decode($arquivo);

  $phone= $json->phone;
  $resposta_id= $json->referenceMessageId;
  $mensagem_recebida=$json->text->message;

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

  $conexao->exec("UPDATE mensagem_enviada SET status='$mensagem_recebida' where mensagem_id='$resposta_id' ");
  $mensagem="Agradecemos o contato";
  enviar_mensagem($conexao,$phone,$mensagem);


// ***************************************************************************************************************************
?>