<?php
  include'../../Model/Conexao.php';
  $arquivo = file_get_contents('php://input');
  $json= json_decode($arquivo);
  $phone= $json->phone;
  $mensagem_recebida=$json->text->message;



  function saudacao() {
  		date_default_timezone_set('America/Sao_Paulo');
  		$hora = date('H');

  		if( $hora >= 6 && $hora <= 12 )
  			return 'Bom dia';
  		else if ( $hora > 12 && $hora <=18  )
  			return 'Boa tarde';
  		else
  			return 'Boa noite';
 }

function enviar_mensagem($phone,$mensagem){

	 $url = "https://api.z-api.io/instances/3952C8A33DA390E387D6820A37F96A5F/token/5FA1BB29856F2F0540BB2012/send-messages";

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

function enviar_imagem($phone,$imagem){
	 $url = "https://api.z-api.io/instances/3952C8A33DA390E387D6820A37F96A5F/token/5FA1BB29856F2F0540BB2012/send-image";

	 $ch = curl_init($url);

	  $data = array(
	      'phone' => $phone,
	      'image' => $imagem,
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


function obter_imagem($phone){
	 $url = "https://api.z-api.io/instances/3952C8A33DA390E387D6820A37F96A5F/token/5FA1BB29856F2F0540BB2012/profile-picture?phone=$phone";
	 $curl = curl_init($url);
	 curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	 $data = curl_exec($curl);

	 $resposta_json = json_decode($data);
	  
	  	if ($resposta_json->link !="") {
	  		$imagem=$resposta_json->link;
	  		enviar_mensagem($phone,"Sua foto de perfil é essa abaixo 😛");
	 		enviar_imagem($phone,$imagem);
	  	}else{
	 		enviar_mensagem($phone,"Sua foto de não esta pública 😛");
 			$imagem="https://pirilampoobjetivo.com.br/blog/View/whatsapp/logobti.png";
	  	}

	 curl_close($curl);
	
}


//  $mensagem=saudacao()." esse é nosso atendimento automático, agora é só você clicar no link abaixo e escolher seus pedidos, é rapidinho 😄 👇 http://correntepi.com/agendacorrente/View/index.php?numero=$phone ";

//  $imagem="https://pirilampoobjetivo.com.br/blog/View/whatsapp/logobti.png";

// enviar_imagem($phone,$imagem);
// enviar_mensagem($phone,$mensagem);

if ($phone=='557799919774') {
	# code...
 	if ($mensagem_recebida !='1' && $mensagem_recebida !='2' && $mensagem_recebida !='3'  ) {
 		$mensagem="DIGITE A OPÇÃO DESEJADA ABAIXO:\n\n *1-VER SUA FOTO DO PERFIL*\n*2-OPÇÃO 2*\n*3-OPÇÃO 3*\n";
 	 enviar_mensagem($phone,$mensagem);
	}else{
		if($mensagem_recebida==1){
 			obter_imagem($phone);
		}else if($mensagem_recebida==2){
			enviar_mensagem($phone,'VOCÊ ESCOLHEU A OPÇÃO 2');

		}else{
			enviar_mensagem($phone,'VOCÊ ESCOLHEU A OPÇÃO 3');

		}

	}


}






?>