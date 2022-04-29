<?php
  include'../Model/Conexao.php';
  // $arquivo = file_get_contents('php://input');
  // $json= json_decode($arquivo);
  
  function configuracao_api($conexao) {
        $result=$conexao->query("SELECT * FROM whatsapp_configuracao order by id desc limit 1");
        $api="";
        foreach ($result as $key => $value) {
          $api=$value['api'];
        }
      return $api;
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

   $status_api= obter_status_api($conexao);
   if ($status_api) {
  	$conexao->exec("UPDATE whatsapp_configuracao SET conectado='true' WHERE 1");
   	
   }else {
  	$conexao->exec("UPDATE whatsapp_configuracao SET conectado='false' WHERE 1");
   	# code...
   }

  
  // $phone= $json->phone;
  // $mensagem_recebida=$json->text->message;




?>