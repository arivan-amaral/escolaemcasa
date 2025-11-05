<?php
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Controller/Conversao.php';

function configuracao_api($conexao) {
      $result=$conexao->query("SELECT * FROM whatsapp_configuracao order by id asc limit 1");
      $api="";
      foreach ($result as $key => $value) {
        $api=$value['api'];
      }


    return "https://api.z-api.io/instances/3A036715DA70501F405E9AEB8FDE9CC7/token/D447038A1C7AE2D4E2BF9771/";
    // return $api;
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
        "label": "ESSE NÚMERO NÃO PERTENCE A ESSA PESSOA!"
      },
      
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

try {
    

// *******************************************************************************************************************************
// $phone="77998228710";

// $mensagem="Olá, clique nesse link e faça seu pedido https://educalem.com.br/escolaemcasa/View/index.php?phone=$phone";
// if ($phone=="77998228710" || $phone=="558999714032" || $phone=="557799919774") {
//    enviar_mensagem($conexao,$phone,$mensagem);
// }


// $conexao->exec("INSERT into whatsapp_configuracao (campo) values ('$json')");
 //$mensagem="⚠Sua localização foi recebida:\nENDEREÇO:$endereco\nLatitude:$latitude\nLongitude:$longitude";

$phone="5577999323906";
$mensagem="Olá aluno!
Esperamos que todos estejam bem! 😊

Esse número enviará mensagens automáticas com informativos importantes para você ou para seu responsável sobre seus estudos na plataforma de ensino EDUCALEM (educalem.com.br) neste período remoto! 👩‍💻👨‍💻

Lembrete: são mensagens automáticas do sistema, portanto, qualquer dúvida entre em contato com seu professor pelo grupo do Whatsapp de sua turma! 

A equipe da Secretaria de Educação de Luis Eduardo Magalhães deseja a você bons estudos!
📖📚";

 enviar_botao($conexao,$phone,$mensagem);



 } catch (Exception $e) {
    echo "$e";
}

?>