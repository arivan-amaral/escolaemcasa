<?php
require 'vendor/autoload.php';
include "../../Model/Conexao.php";
  use \Mailjet\Resources;
  $mj = new \Mailjet\Client('fb0930913dd858032e6a14bd60933a0c','1bfb6a601b112df1dd1cdfeba591ed6c',true,['version' => 'v3.1']);


try {	 
 $arquivo = file_get_contents('php://input');
 $json= json_decode($arquivo);

        $descr_tipoprocesso =$json->descr_tipoprocesso;
        $id_pro =$json->id_pro;
        $tautor =$json->tautor;
        $descr_situacaoprojeto =$json->descr_situacaoprojeto;
        $descr_situacaoprojeto2 =$json->descr_situacaoprojeto2;
        $obsgerais =$json->obsgerais;
        $tusuario =$json->tusuario;
        $pagina =$json->pagina;
        $telefone =$json->telefone;


$conexao->exec("INSERT INTO xplanejamento(descr_tipoprocesso, id_pro, tautor, descr_situacaoprojeto, descr_situacaoprojeto2, obsgerais, tusuario, pagina,telefone)
 VALUES ('$descr_tipoprocesso', '$id_pro', '$tautor', 
 '$descr_situacaoprojeto', '$descr_situacaoprojeto2', '$obsgerais',
 '$tusuario', '$pagina','$telefone')");


$body = [
        'status' => 'sucesso'
    ];
// $decodificado = json_decode($body);
// $decodificado->status= $mensagem_recebida;
echo json_encode($body);

//******************************************************************************

 $res=$conexao->query("SELECT * from xplanejamento where enviado=0  limit 3");

    foreach ($res as $key => $value) {
        $id=$value['id'];
        $descr_tipoprocesso=$value['descr_tipoprocesso'];
        $id_pro =$value['id_pro'];
        $tautor =$value['tautor'];
        $descr_situacaoprojeto=$value['descr_situacaoprojeto'];
        $descr_situacaoprojeto2 =$value['descr_situacaoprojeto2'];
        $obsgerais=$value['obsgerais'];
        $tusuario =$value['tusuario'];
        $pagina=$value['pagina'];

        $body = [
          'Messages' => [
            [
              'From' => [
                'Email' => "no-reply@valleteclab.com.br",
                'Name' => "Prefeitura de Luís Eduardo Magalhães - XPlanejamento"
              ],
              'To' => [
                [
                  'Email' => "$tusuario",
                  'Name' => "$tautor"
                ]
              ],
              'Subject' => "Análise de Processo [ $descr_tipoprocesso ]",
              'TextPart' => "Análise de Processo [ $descr_tipoprocesso ]",
              'HTMLPart' => "
              [ E-mail resposta, por favor não responda esse e-mail ] <br/>
                            Prezado(a) Senhor(a),<br/>
                            <br/><br/>
                            Status de processo de <strong> $descr_tipoprocesso </strong>, Protocolo: $id_pro <br/> 
                            <strong>Autor da análise:</strong> $tautor<br/>
                            <strong>Situação do projeto:</strong><br/>
                            $descr_situacaoprojeto
                            <br/>
                            $descr_situacaoprojeto2
                            <br/>
                            <strong>Observações</strong><br/>
                            $obsgerais
                            <br/>
                            <br/>
                            www.luiseduardomagalhaes.ba.gov.br/planejamento <br/>
                            <br/><br/>
                            Agradecemos o contato!

              ",
              'CustomID' => "AppGettingStartedTest"
            ]
          ]
        ];




        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success() && var_dump($response->getData());


       $conexao->exec("UPDATE xplanejamento SET enviado=1 WHERE id =$id");
       echo "certo<br>";
    }

//******************************************************************************


} catch (Exception $e) {
     $body = [
        'status' => 'erro'
    ];
    echo json_encode($body);
}

?>