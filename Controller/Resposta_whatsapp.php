<?php 
session_start();
set_time_limit(0);
include_once"Api_code_chat.php";
include_once"../Model/Conexao.php";
$sessao = 'educalem';




try {
   
$arquivo = file_get_contents('php://input');
 $data = json_decode($arquivo, true);
 

if (isset($data['data']['message']['conversation'])) {
    $remoteJid = $data['data']['key']['remoteJid'];
    $conversation = $data['data']['message']['conversation'];

    $array_numero=explode("@", $remoteJid);
    $telefone_resposta=$array_numero[0];

    $telefone ="5589999342837";

        $newdata= array(
            "number" => "$telefone",
            "options" => array(
                "delay"=> rand(10, 100)
            ),
            "textMessage" => array(
                "text"=> "Mensagem pode ser ( LICITALEM, EDUCALEM , XPLANEJAMENTO): $conversation - $telefone_resposta"
            ),
        );



     enviar_mensagem_code_chat($sessao,$newdata);
}else{
    echo "Funcionado ";
}

} catch (Exception $e) {
    echo "$e";
}