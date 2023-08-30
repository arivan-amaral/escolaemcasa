<?php
  session_start();
    if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
try {

  $trabalho_entregue_id=$_GET['trabalho_entregue_id'];

  $aluno_id=$_GET['aluno_id'];


  $res=$conexao->query("SELECT * from  resenha_trabalho_entregue where aluno_id=$aluno_id and trabalho_entregue_id=$trabalho_entregue_id ");
  $result="";

  foreach ($res as $key => $value) {
    $resposta=$value['resposta'];
    $data=$value['data'];
  
          if ($value['funcionario_id']=="") {
            $remetente="ALUNO";
             $result.="<div class='card-comment'>
                        <div class='comment-text'>
                          <span class='username'>
                              $remetente
                            <span class='text-muted float-right'>$data</span>
                          </span>
                          $resposta
                        </div>
                      </div>";
        }else{
            $remetente="PROFESSOR";
             $result.="<div class='card-comment' style='background-color:#DCDCDC'>
                        <div class='comment-text'>
                          <span class='username'>
                              $remetente
                            <span class='text-muted float-right'>$data</span>
                          </span>
                          $resposta
                        </div>
                      </div>";
        }

    }
   

 echo "$result";
} catch (Exception $e) {
  echo "$e";
}
?>