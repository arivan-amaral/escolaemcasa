<?php 
 
 function enviar_contato_code_chat($sessao,$newdata) {

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://back.lemgastronomia.com.br/message/sendContact/$sessao",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>json_encode($newdata),
      CURLOPT_HTTPHEADER => array(
        'apikey: ZdGt8OOEeISKzpmcZdG3jjcMqBWYSaJsafdZdGeferZdG',
        'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    // echo $response;
}


  function enviar_mensagem_code_chat($sessao,$newdata) {

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://back.lemgastronomia.com.br/message/sendText/$sessao",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>json_encode($newdata),
      CURLOPT_HTTPHEADER => array(
        'apikey: ZdGt8OOEeISKzpmcZdG3jjcMqBWYSaJsafdZdGeferZdG',
        'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    // echo $response;

}
