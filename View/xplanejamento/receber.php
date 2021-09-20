<?php 
try {	
 $arquivo = file_get_contents('php://input');
  $json= json_decode($arquivo);
  // $phone= $json->phone;
  $mensagem_recebida=$json->Recipients->Email;

$body = [
        'status' => 'certo: '
    ];


$decodificado = json_decode($body);

if (!$decodificado) {
    die('JSON invalido');
}
 
$decodificado->status= $mensagem_recebida;

echo json_encode($body);

} catch (Exception $e) {
	$body = [
        'status' => 'error'
    ];
	echo json_encode($body);


}

?>