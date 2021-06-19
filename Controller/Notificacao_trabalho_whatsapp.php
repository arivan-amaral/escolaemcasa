<?php
session_start();
include'../Model/Conexao.php';
include'Conversao.php';
function configuracao_api($conexao) {
      $result=$conexao->query("SELECT * FROM whatsapp_configuracao order by id desc limit 1");
      $api="";
      foreach ($result as $key => $value) {
        $api=$value['api'];
      }
    return $api;
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


 function restaurar_conexao_api($conexao){
  $url = configuracao_api($conexao)."/restore-session";

   $curl = curl_init($url);
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   $data = curl_exec($curl);

   $resposta_json = json_decode($data);
    
   // $status_api=$resposta_json->connected;
        

   curl_close($curl);
   
 }




 function obter_status_api($conexao){
  $url = configuracao_api($conexao)."status";

   $curl = curl_init($url);
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   $data = curl_exec($curl);

   $resposta_json = json_decode($data);
    
   $status_api=$resposta_json->connected;
        

   curl_close($curl);
   return $status_api;    
 }


// *******************************************************************************************************************************
 try {
   
 
 $status_api= obter_status_api($conexao);
 if ($status_api) {//só ira atualizar no banco e enviar as mensagens se o status da api estives true
                

              $data_inicio_hoje="2021-02-26"." 00:00:00";
              $data_fim_hoje=date("Y-m-d")." 23:59:59";
              
              // $turma_id=1;
              // $serie_id=3;
              // $escola_id=14;
              $turma_id=$_GET['turma_id'];
              $serie_id=$_GET['serie_id'];
              $escola_id=$_GET['escola_id'];

              $lista_trabalhos="";

              $result_trabalho=$conexao->query("SELECT * FROM trabalho WHERE  turma_id=$turma_id and escola_id=$escola_id and data_hora_visivel BETWEEN '$data_inicio_hoje' AND '$data_fim_hoje' and notificado=0 order BY data_entrega ASC ");
              $cont_tra=0;


              foreach ($result_trabalho as $key2 => $value2) {
                  $trabalho_id=$value2['id'];
                  $nome_trabalho=$value2['titulo'];
                  $disciplina_id=$value2['disciplina_id'];
                  $data_entrega=$value2['data_entrega'];
                  $nome_disciplina="";
                        
                  

                  $result_disciplina=$conexao->query("SELECT * FROM disciplina where iddisciplina =$disciplina_id ");
                  foreach ($result_disciplina as $key2 => $value2) {
                    $nome_disciplina=$value2['nome_disciplina'];
                  }

                  $lista_trabalhos.="*DISCIPLINA:* $nome_disciplina\n*TÍTULO:* $nome_trabalho\n*DATA DE ENTREGA:* ".data($data_entrega)."\n";
                  $lista_trabalhos.="\n*_______________________________________*\n";
                  
                  $conexao->exec("UPDATE trabalho set notificado=1 where id =$trabalho_id ");
                  $cont_tra=$cont_tra+1;
              }


              if ($cont_tra>0) {
                
                    $result_aluno=$conexao->query("SELECT * FROM ano_letivo, aluno WHERE aluno.idaluno=ano_letivo.aluno_id AND ano_letivo.turma_id=$turma_id and escola_id=$escola_id AND aluno.status ='Ativo' AND aluno.whatsapp!='55' AND aluno.whatsapp!='' ");

                    foreach ($result_aluno as $key4 => $value4) {
                        $numero=$value4['whatsapp'];
                        $nome_aluno=$value4['nome'];
                        $mensagem_titulo="*_____________ATIVIDADES_____________*\n";
                        $mensagem=saudacao().", *".$nome_aluno."*, confira abaixo as últimas *atividades* que foram postadas:\n\n$lista_trabalhos\nAcesse: https://escolaemcasalem.com.br/ e fique em dia com suas atividades 😉";
                        

                        // if ($numero=='5589999342837') {
                            enviar_mensagem($conexao,$numero,$mensagem_titulo);
                            enviar_mensagem($conexao,$numero,$mensagem);

                       // }
                    }


              } else
                echo "$data_fim_hoje";
  }else {
    restaurar_conexao_api($conexao);
  }
    // *********************************************************************************************************************************
  } catch (Exception $e) {
    echo "$e"; 
 }
?>