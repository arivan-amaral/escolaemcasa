<?php 
try {	
 $arquivo = file_get_contents('php://input');
  $json= json_decode($arquivo);
  // $phone= $json->phone;
  $mensagem_recebida=$json->Recipients->Email;

$body = [
        'status' => 'certo'
    ];


$decodificado = json_decode($body);
 
$decodificado->status= $mensagem_recebida;

echo json_encode($decodificado);

} catch (Exception $e) {
	$body = [
        'status' => 'error'
    ];
	echo json_encode($body);


}

?>