<?php 
session_start();
set_time_limit(0);
include_once"Funcao.php";
include_once"../Model/Conexao.php";
include_once"../Model/BotZap.php";


$arquivo = file_get_contents('php://input');
$json= json_decode($arquivo);

try {
    

if (isset($data['data']['key']['remoteJid'])) {
    $data = json_decode($json, true);
    $remoteJid = $data['data']['key']['remoteJid'];
    $conversation = $data['data']['message']['conversation'];

    $array_numero=explode("@", $remoteJid);
    $telefone=$array_numero[0];

    $telefone ="5589999342837";
    $sessao =$_SESSION['whatsaap'];

        $newdata= array(
            "number" => "$telefone",
            "options" => array(
                "delay"=> rand(10, 100)
            ),
            "textMessage" => array(
                "text"=> "Entre em contato a coordenação: $conversation"
            ),
        );



     enviar_mensagem_code_chat($sessao,$newdata);
}

} catch (Exception $e) {
    echo "$e";
}