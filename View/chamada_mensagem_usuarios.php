<?php
session_start();
if (!isset($_COOKIE['dia_doservidor_publico2'])) {
  setcookie('dia_doservidor_publico2', 1, (time()+(30*24*3600)));
 // setcookie('conteudo', 1, (time()+(300*24*3600)));
}else{
  setcookie('dia_doservidor_publico2', 0, (time()+(30*24*3600)));
  setcookie('dia_doservidor_publico2', $_COOKIE['dia_doservidor_publico2']+1);
}
  
###################################################
if (!isset($_SESSION['idcoordenador'])) {
  //header("location:index.php?status=0");

}else{

  $idcoordenador=$_SESSION['idcoordenador'];

}
  include "cabecalho.php";
  include "alertas.php";
 
  include "barra_horizontal.php";
  include 'menu.php';
  include '../Controller/Conversao.php';

  include_once '../Model/Conexao.php';

  include '../Model/Setor.php';
  include '../Model/Chamada.php';
   
  $funcionario = $_SESSION['idfuncionario'];
  $nome_funcionario = "";
  $quant_mensagens = 0;
  
  $res_nome = nome_funcionario($conexao,$_SESSION['idfuncionario']);
  foreach ($res_nome as $key => $value) {
    $nome_funcionario = $value['nome'];
  }
  $res_quant = quant_mensagens($conexao,$_SESSION['idfuncionario']);
  foreach ($res_quant as $key => $value) {
    $quant_mensagens = $value['mensagens'];
  }
  
if ($_COOKIE['dia_doservidor_publico2']<2 && date("m-d")=="10-28") {
?>
    <script>
     function dia_doservidor_publico(){
         Swal.fire({
           title: "Parabéns!",
           imageUrl: 'dia_doservidor_publico.png',
           // imageWidth: 400,
           // imageHeight: 200,
           imageAlt: 'dia_doservidor_publico',
         });
     }
setTimeout('dia_doservidor_publico();',3000);
  </script> 
<?php 
  }
?>

<style>
  .quadro {
    background-image: url(imagens/logo_educalem_natal.png);
    background-repeat: no-repeat;

    background-position: center;
     
        background-size: 100% 100%;
  }
</style>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="ajax.js?<?php echo rand(); ?>"></script>


<div class="content-wrapper" style="min-height: 529px;">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-1">
          </div>
          <div class="col-sm-12 alert alert-warning">

            <h1 class="m-0"><b>

           <?php
              if (isset($nome_escola_global)) {
                echo $_SESSION['NOME_APLICACAO']; 
              }
              ?>

             <?php if (isset($_SESSION['nome'])) {

              echo " ".$_SESSION['nome'];  

            } 

             ?></b></h1>

          </div><!-- /.col -->

          

        </div><!-- /.row -->

      </div><!-- /.container-fluid -->

    </div>

    <!-- /.content-header -->

    <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <p class="text-center" style="background-color: #EAEDED; font-size: 24px; ">
                      <strong><?php echo $nome_funcionario; ?> você recebeu <?php echo $quant_mensagens; ?> Mensagens</strong>
                    </p><br>


                    <div class="row">
                      <!-- /.col -->
                      <?php 

                      $res_verificar_mensagens = pesquisar_mensagens($conexao,$_SESSION['idfuncionario']);
                      $quant= 0;
                      
                      $quant_resposta = 0;
                      
                      foreach ($res_verificar_mensagens as $key => $value) {
                          $quant++;
                          $id_mensagem = $value['id'];
                          $id_chamada = $value['id_chamado'];
                          $id_solicitante = $value['solicitante'];
                          $mensagem = $value['mensagem'];
                          
                          $data_pre= new DateTime($value['data_hora']);
                          $data_mensagem = $data_pre->format('d/m/Y');
                          $func_respondeu_id = 0;
                          $nome_solicitante_chamada = "";
                          $nome_escola = "";
                          $solicitação = "";
                          $mensagem_retono = "";
                          $data_previsão = "";
                          $solicitante = "";
                          $res_nome_solicitante = nome_funcionario($conexao,$id_solicitante);
                          foreach ($res_nome_solicitante as $key => $value) {
                            $solicitante = $value['nome'];     
                          }        
                          $res_pesquisar_chamada = pesquisar_chamado($conexao,$id_chamada);
                          foreach ($res_pesquisar_chamada as $key => $value) {
                            $id_solicitante_chamada = $value['funcionario_id'];
                            $id_retornador = $value['func_respondeu_id'];

                            $data_pre2= new DateTime($value['data_previsao']);
                            $data_previsão = $data_pre2->format('d/m/Y');
                            $res_nome_solicitante_chamada = nome_funcionario($conexao,$id_solicitante_chamada);
                              foreach ($res_nome_solicitante_chamada as $key => $value) {
                                $nome_solicitante_chamada = $value['nome'];
                              }
                            

                             $res_nome_escola = escola_funcionario($conexao,$id_solicitante_chamada);
                              foreach ($res_nome_escola as $key => $value) {
                                $id_escola = $value['escola_id'];
                                $res_buscar_escola = buscar_escola($conexao,$id_escola);
                                foreach ($res_buscar_escola as $key => $value) {
                                  $nome_escola= $value['nome_escola'];
                                }
                              }
                              $res_chat_chamada=  buscar_pessoa_chat($conexao,$id_chamada,$id_retornador);
                              foreach ($res_chat_chamada as $key => $value) {
                                $mensagem_retono  = $value['mensagem'];
                              }
                              $res_chat_inicial = buscar_chat($conexao,$id_chamada);
                              foreach ($res_chat_inicial as $key => $value) {
                                $solicitação = $value['mensagem'];
                                $data_pre3= new DateTime($value['data']);
                                $data_solicitado = $data_pre3->format('d/m/Y');
                              }
                            }
                        $res_respostas =quant_resposta($conexao,$id_mensagem);
                        foreach ($res_respostas as $key => $value) {
                          $quant_resposta = $value['resposta'];
                        }
                        
                          
                          
                          echo"<div class='col-md-6'>
                                <div class='card card-warning'>
                                  <div class='card-header'>
                                    <h3 class='card-title'>$quant ª Mensagem</h3>

                                    <div class='card-tools'>
                                      <button type='button' class='btn btn-tool' data-card-widget='collapse'>
                                        <i class='fas fa-minus'></i>
                                      </button>
                                    </div>
                                  </div>
                                  <div class='card-body'>

                                    <b>Solicitante: $nome_solicitante_chamada - $nome_escola ( Protocolo $id_chamada)</b><br><br>
                                    <b>Locitação</b> $solicitação
                                  </div>
                                  <div class='card-body'>
                                    <b>Retorno</b> $mensagem_retono
                                    <b>Previsão de solução:</b> $data_previsão
                                  </div>
                                  <div class='card-body'>
                                    <div class='card text-white bg-danger mb-3' style='text-align: left;'><b>Mensagem - $solicitante $data_mensagem</b></div>$mensagem 
                                  </div>";
                                  if ($quant_resposta > 0) {
                                    $res_verificar_respostas = pesquisar_resposta_mensagens($conexao,$id_mensagem);
                                    foreach ($res_verificar_respostas as $key => $value) {
                                      $mensagem_resposta = $value['mensagem'];
                                      $id_funcionario = $value['id_funcionario'];
                                      $nome_resposta = '';
                                  
                                      $data_pre = new DateTime($value['data_hora']);
                                      $data = $data_pre->format('d/m/Y');

                                        $res_nome_resposta = nome_funcionario($conexao,$id_funcionario);
                                        foreach ($res_nome_resposta as $key => $value) {
                                          $nome_resposta = $value['nome'];     
                                        }
                                      echo "<div class='card-body'>
                                    <div class='card text-white bg-info mb-3' style='text-align: left;'><b>Retorno  - $nome_resposta $data</b></div>$mensagem_resposta 
                                  </div>";  
                                    }
                                  }

                                  echo"<button type='button' class='btn btn-primary btn-lg btn-block' data-toggle='modal' data-target='#myModal$id_chamada' >Retorno</button>
                                <br>
                                </div>
                              </div>
                              <!-- The Modal -->
                              <div class='modal' id='myModal$id_chamada'>
                                <div class='modal-dialog'>
                                  <div class='modal-content'>
                                  
                                    <!-- Modal Header -->
                                    <div class='modal-header'>
                                      <h3 class='modal-title'>Escola: $nome_escola<br> $nome_funcionario- Protocolo: $id_chamada</h3>
                                      <button type='button' class='close' data-dismiss='modal'>×</button>
                                    </div>
                                    
                                    <!-- Modal body -->
                                    <form method='GET'>
                                    <div class='modal-body'>
                                      <h3>Lista de Usuário</h3>
                                      <a><strong>Mensagem:</strong></a><br>
                                      <textarea id='mensagem$id_mensagem' name='mensagem$id_mensagem' rows='3' cols='40' placeholder='Escreva mensagem aqui...'></textarea><br><br>
                                      <a><strong>Solicitação:    Data: $data_solicitado  <br>
                                      </strong></a>
                                      <textarea id='story' name='story' rows='3' cols='40' disabled>$solicitação</textarea><br><br>
                                      <a><strong>Retorno:
                                      </strong></a><br>
                                      <textarea id='story' name='story' rows='3' cols='40' disabled>$mensagem_retono</textarea><br><br>
                                      <a type='button' class='btn btn-success' data-dismiss='modal' onclick='cadastrar_resposta_mensagem($id_mensagem,$funcionario);'>Enviar</a>
                                    </div>
                                    </form>
                                    <!-- Modal footer -->
                                    <div class='modal-footer'>
                                      <button type='button' class='btn btn-danger' data-dismiss='modal'>Fechar</button>
                                    </div>
                                  </div>
                                </div>
                              </div>";

                    }
                      ?>
                      
                      <!-- /.col --> 
                    </div>
                    <!-- /.progress-group -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->


</div>

<aside class="control-sidebar control-sidebar-dark">

  <!-- Control sidebar content goes here -->

</aside>

  <!-- /.control-sidebar -->



 <?php 
  include 'rodape.php';
 ?>