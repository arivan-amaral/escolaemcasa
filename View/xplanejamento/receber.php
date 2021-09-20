<?php 
include "../../Model/Conexao.php";

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


$conexao->exec("INSERT INTO xplanejamento(descr_tipoprocesso, id_pro, tautor, descr_situacaoprojeto, descr_situacaoprojeto2, obsgerais, tusuario, pagina)
 VALUES ('$descr_tipoprocesso', '$id_pro', '$tautor', 
 '$descr_situacaoprojeto', '$descr_situacaoprojeto2', '$obsgerais',
 '$tusuario', '$pagina')")


$body = [
        'status' => 'sucesso'
    ];
// $decodificado = json_decode($body);
// $decodificado->status= $mensagem_recebida;
echo json_encode($body);
} catch (Exception $e) {
     $body = [
        'status' => 'erro'
    ];
    echo json_encode($body);
}

?>