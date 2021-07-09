<?php
session_start();
include'../Model/Conexao.php';
include'../Controller/Conversao.php';
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

function enviar_link($conexao,$phone,$mensagem,$linkUrl){
   $url = configuracao_api($conexao)."send-link";
   
   $ch = curl_init($url);

    $data = array(
        'phone' => $phone,
        'message' => $mensagem,
        'linkUrl' => $linkUrl
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
 $status_api= obter_status_api($conexao);
 if ($status_api) {//só ira atualizar no banco e enviar as mensagens se o status da api estives true
  
  $limite=300;
  $indice=0;

  if (isset($_GET['limite'])) {
      $limite=$_GET['limite'];
  }  
  if (isset($_GET['indice'])) {
      $indice=$_GET['indice'];
  }
                    $result=$conexao->query("SELECT * FROM funcionario where
                     descricao_funcao like 'Coordenador' or 
                     descricao_funcao like 'Coordenadora' limit $indice , $limite ");

                    foreach ($result as $key4 => $value4) {
                        $numero=$value4['whatsapp'];
                        $nome=$value4['nome'];
                       
                         $mensagem="⚠AVISO IMPORTANTE⚠ ".saudacao().", *".$nome."*, ⚠️ATENÇÃO⚠️ COMUNICADO SOBRE A AUSÊNCIA DOS ALUNOS NAS TURMAS  MULTISSERIADAS , VEJA O VÍDEO DO LINK ➡ https://youtu.be/SL7t3UFrGOs \n\nESSA MENSAGEM FOI ENVIADA DE FORMA AUTOMÁTICA, POR FAVOR NÃO RESPONDER.
                         ";
                         $linkUrl="https://youtu.be/SL7t3UFrGOs";
                        
                        if ($numero=='558999342837') {
                        
                            enviar_mensagem($conexao,$numero,$mensagem);
                            enviar_link($conexao,$numero,$linkUrl);
                            echo "$nome - $numero <br>";

                        }
                       
                    }

  }else {
    restaurar_conexao_api($conexao);
  }
    // *********************************************************************************************************************************
?>