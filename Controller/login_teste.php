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
// *******************************************************************************************************************************
$ano_letivo=$_SESSION['ano_letivo'];

$data_inicio_hoje="$ano_letivo"."-01-01"." 00:00:00";
$data_fim_hoje=date("Y-m-d")." 23:59:59";

$turma_id=$_GET['idturma'];

$lista_trabalhos="";

$result_trabalho=$conexao->query("SELECT * FROM trabalho WHERE  turma_id=$turma_id and data_hora_visivel BETWEEN '$data_inicio_hoje' AND '$data_fim_hoje' and notificado=0 ");
$cont_tra=0;
$array_trabalhos=array();

foreach ($result_trabalho as $key2 => $value2) {
    $trabalho_id=$value2['id'];
    $nome_trabalho=$value2['titulo'];
    $disciplina_id=$value2['disciplina_id'];
    $data_entrega=$value2['data_entrega'];
    $nome_disciplina="";
    
    $array_trabalhos[$cont_tra]=$trabalho_id;

    $result_disciplina=$conexao->query("SELECT * FROM disciplina where iddisciplina =$disciplina_id ");
    foreach ($result_disciplina as $keyS => $valueS) {
      $nome_disciplina=$value2['nome_disciplina'];
    }

    $lista_trabalhos.="DISCIPLINA: *| $nome_disciplina |*\nTÍTULO: *| $nome_trabalho |*\nDATA DE ENTREGA: *| ".data($data_entrega)." |*\n";
    $lista_trabalhos.="\n*|******************************|*\n";

    $cont_tra++;
}
if ($cont_tra>0) {
  
      $result_aluno=$conexao->query("SELECT * FROM ano_letivo, aluno WHERE  ano_letivo.status_letivo=1 AND aluno.idaluno=ano_letivo.aluno_id AND ano_letivo.turma_id=$turma_id AND aluno.status ='Ativo' AND aluno.whatsapp!='55' AND aluno.whatsapp!='' ");

      foreach ($result_aluno as $key4 => $value4) {
        $numero=$value4['whatsapp'];
        $nome_aluno=$value4['nome'];
        $mensagem=saudacao()." *| $nome_aluno |*, confira abaixo os trabalhos a serem resolvidos na sua turma:\n$lista_trabalhos\n acesse: https://pirilampoobjetivo.com.br/ e fique em dia com suas atividade 😉";

        if ($numero=='5589999342837') {
         enviar_mensagem($conexao,$numero,$mensagem);

       }
   }

}


    // *********************************************************************************************************************************
?>