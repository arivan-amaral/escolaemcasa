<?php 
session_start();
set_time_limit(0);
include_once"Api_code_chat.php";
include_once"../Model/Conexao.php";
$sessao = 'educalem';




try {
   
$arquivo = file_get_contents('php://input');
 $data = json_decode($arquivo, true);
 

if (isset($data['data']['key']['remoteJid'])) {
    $remoteJid = $data['data']['key']['remoteJid'];
    $conversation = $data['data']['message']['conversation'];

    $array_numero=explode("@", $remoteJid);
    $telefone=$array_numero[0];

    $telefone ="5589999342837";

        $newdata= array(
            "number" => "$telefone",
            "options" => array(
                "delay"=> rand(10, 100)
            ),
            "textMessage" => array(
                "text"=> "Entre em contato a coordenação: $conversation"
            ),
        );



     //enviar_mensagem_code_chat($sessao,$newdata);
}else{
    echo "Funcionado ";
}

} catch (Exception $e) {
    echo "$e";
}