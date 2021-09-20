<?php 
 $arquivo = file_get_contents('php://input');
  $json= json_decode($arquivo);
  // $phone= $json->phone;
  $mensagem_recebida=$json->Recipients->Email;

$body = [
        'status' => "teste: $mensagem_recebida" 
    ];
echo json_encode($body);

?>