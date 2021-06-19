<?php
  include'../Model/Conexao.php';
  $arquivo = file_get_contents('php://input');
  $json= json_decode($arquivo);
  $phone= $json->phone;
  $mensagem_recebida=$json->text->message;



  function configuracao_api($conexao) {
  		$result=$conexao->query("SELECT * FROM whatsapp_configuracao order by id desc limit 1");
  		$api="";
  		foreach ($result as $key => $value) {
  			$api=$value['api'];
  		}
 		return $api;
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

function enviar_imagem($conexao,$phone,$imagem){
	 $url = configuracao_api($conexao)."send-image";

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

$mensagem="";
$imagem="https://pirilampoobjetivo.com.br/blog/View/imagens/logo_pirilampo.png";


$resultado=$conexao->query("SELECT * FROM ano_letivo, aluno WHERE aluno.idaluno=ano_letivo.aluno_id and aluno.status ='Ativo' AND aluno.whatsapp!='55' AND aluno.whatsapp!='' ORDER BY turma_id ASC");

foreach ($resultado as $key => $value) {
	$numero=$value['whatsapp'];
	$nome=$value['nome'];
	$aluno_id=$value['aluno_id'];

	$mensagem=saudacao()." *$nome*, agora a nossa plataforma está integrada com o whatsapp e você receberá avisos de novas videoaulas postada e trabalho também 😉. Em breve mais novidades virão, *PIRILAMPO EAD* sempre inovando por você!";
	
	

		enviar_imagem($conexao,$numero,$imagem);
		enviar_mensagem($conexao,$numero,$mensagem);
		$conexao->exec("INSERT INTO whatsapp_primeira_mensagem (aluno_id,numero)  values ($aluno_id,'$numero')");

	
	
}




?>