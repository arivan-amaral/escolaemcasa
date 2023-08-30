<?php
	session_start();
    if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
    
    

try {
  $idaluno=$_SESSION['idaluno'];
  $idturma=$_SESSION['turma_id'];
  $idescola=$_SESSION['escola_id'];

  $result="";
  $idmensagem="";
  $res=$conexao->query("SELECT * FROM chat where turma_id=$idturma and escola_id=$idescola ");
  $minha=0;
  foreach ($res as $key => $value) {
      $aluno_id=$value['aluno_id'];
      $funcionario_id=$value['funcionario_id'];
      $nome='';
      $data=$value['data'];
      $mensagem=$value['mensagem'];
      $idmensagem=$value['id'];

      if ($aluno_id!='') {
          $res_a=$conexao->query("SELECT * FROM aluno where idaluno=$aluno_id ");
          foreach ($res_a as $key => $value) {
            $nome=$value['nome'];
          }


          if ($idaluno==$aluno_id) {
               $result.="
                <div class='direct-chat-msg right'>
                  <div class='direct-chat-infos clearfix'>
                    <span class='direct-chat-name float-right'>$nome</span>
                    <span class='direct-chat-timestamp float-left'>$data</span>
                  </div>
                  <div class='direct-chat-text'>
                    $mensagem <ion-icon name='checkmark-done-outline'></ion-icon>
                  </div>
                </div>";
                $minha=1;

            }else{
              $result.="
              <div class='direct-chat-msg'>
                <div class='direct-chat-infos clearfix'>
                  <span class='direct-chat-name float-left'>$nome</span>
                  <span class='direct-chat-timestamp float-right'>$data</span>
                </div>    
                <div class='direct-chat-text'>
                  $mensagem 
                </div>
              </div>";
              $minha=0;
            }

      }else{

          $res_f=$conexao->query("SELECT * FROM funcionario where idfuncionario=$funcionario_id ");
          foreach ($res_f as $key => $value) {
            $nome=$value['nome'];
          }



              $result.="
              <div class='direct-chat-msg'>
                <div class='direct-chat-infos clearfix'>
                  <span class='direct-chat-name float-left'><font color='red'>$nome</font> </span>
                  <span class='direct-chat-timestamp float-right'>$data</span>
                </div>    
                <div class='direct-chat-text'>
                  $mensagem 
                </div>
              </div>";
              $minha=0;
            
      }

      
  }




  echo $result."#§".$idmensagem."#§".$minha;


} catch (Exception $e) {
  echo "$e";
}
?>