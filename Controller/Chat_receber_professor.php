<?php
	session_start();
    include("../Model/Conexao.php");
    
    

try {
  $idfuncionario=$_SESSION['idfuncionario'];
  $idturma=$_GET['turma_id'];
  $idescola=$_GET['escola_id'];

  $result="";
  $idmensagem="";


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

      }else{
          $res_a=$conexao->query("SELECT * FROM funcionario where idfuncionario=$funcionario_id ");
          foreach ($res_a as $key => $value) {
            $nome=$value['nome'];
          }



          if ($idfuncionario==$funcionario_id) {
               $result.="
                <div class='direct-chat-msg right'>
                  <div class='direct-chat-infos clearfix'>
                    <span class='direct-chat-name float-right'> <font color='red'>$nome</font> </span>
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

      }

            
       
  }




  echo $result."#§".$idmensagem."#§".$minha;


} catch (Exception $e) {
  echo "$e";
}
?>