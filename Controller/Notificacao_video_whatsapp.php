<?php
session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once 'Conversao.php';
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


              $lista_videos="";
              $result_videos=$conexao->query("SELECT * FROM video WHERE  id_turma=$turma_id and data_visivel BETWEEN '$data_inicio_hoje' AND '$data_fim_hoje' and notificado=0 and status='Ativo'  order BY data_visivel ASC ");
              $cont_video=0;


              foreach ($result_videos as $key2 => $value2) {
                  $video_id=$value2['id'];
                  $nome_video=$value2['titulo'];
                  $disciplina_id=$value2['id_disciplina'];
                  $data_visivel=$value2['data_visivel'];

                  $nome_disciplina="";
                  
                  $result_disciplina=$conexao->query("SELECT * FROM disciplina where iddisciplina =$disciplina_id ");
                  foreach ($result_disciplina as $key2 => $value2) {
                    $nome_disciplina=$value2['nome_disciplina'];
                  }


                  $lista_videos.="DISCIPLINA: $nome_disciplina\nTÍTULO: $nome_video\nDATA DO VÍDEO: ".data($data_visivel)." \n";
                  
                  $conexao->exec("UPDATE video set notificado=1 where id =$video_id ");
                  $cont_video=$cont_video+1;
              }
              

// ********************************************************************************************************************




              $result_videos=$conexao->query("SELECT * FROM video WHERE  serie_id=$serie_id and data_visivel BETWEEN '$data_inicio_hoje' AND '$data_fim_hoje' and notificado=0 and status='Ativo'  order BY data_visivel ASC ");
              foreach ($result_videos as $key2 => $value2) {
                  $video_id=$value2['id'];
                  $nome_video=$value2['titulo'];
                  $disciplina_id=$value2['id_disciplina'];
                  $data_visivel=$value2['data_visivel'];

                  $nome_disciplina="";
                  
                  $result_disciplina=$conexao->query("SELECT * FROM disciplina where iddisciplina =$disciplina_id ");
                  foreach ($result_disciplina as $key2 => $value2) {
                    $nome_disciplina=$value2['nome_disciplina'];
                  }


                  $lista_videos.="*DISCIPLINA:* $nome_disciplina\n*TÍTULO:* $nome_video\n*DATA DO VÍDEO:* ".data($data_visivel)." \n";                  
                  $conexao->exec("UPDATE video set notificado=1 where id =$video_id ");
                  $cont_video=$cont_video+1;
              }


                  $lista_videos.="\n_______________________________________\n";


// ********************************************************************************************************************


              if ($cont_video>0) {
                
                    $result_aluno=$conexao->query("SELECT * FROM ano_letivo, aluno WHERE ano_letivo.status_letivo=1 AND aluno.idaluno=ano_letivo.aluno_id AND ano_letivo.turma_id=$turma_id and escola_id=$escola_id AND aluno.status ='Ativo' AND aluno.whatsapp!='55' AND aluno.whatsapp!='' ");

                    foreach ($result_aluno as $key4 => $value4) {
                        $numero=$value4['whatsapp'];
                        $nome_aluno=$value4['nome'];
                         $mensagem_titulo="*________________VÍDEOS________________*\n";
                         $mensagem=saudacao().", *".$nome_aluno."*, confira abaixo as últimas *videoaulas* que foram postadas:\n\n$lista_videos\nAcesse: https://escolaemcasalem.com.br/ e fique em dia com suas atividades 😉";
                        
                        //if ($numero=='5589999342837') {
                            enviar_mensagem($conexao,$numero,$mensagem_titulo);
                            enviar_mensagem($conexao,$numero,$mensagem);

                        //}
                    }


            }




  }else {
    restaurar_conexao_api($conexao);
  }
    // *********************************************************************************************************************************
?>