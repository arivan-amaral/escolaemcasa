<?php
  include_once 'seguranca_aluno.php';

  include_once "cabecalho.php";
  include_once "alertas.php";
  include_once "barra_horizontal.php";
  include_once 'menu.php';

  if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";

  include_once '../Model/Aluno.php';
  include_once '../Model/Video.php';

  include_once '../Controller/Conversao.php';

$idaluno=$_SESSION['idaluno'];
$idescola=$_SESSION['escola_id'];
$idturma=$_SESSION['turma_id'];
$res=$conexao->query("SELECT * from turma where idturma=$idturma ");
$nome_turma="";
foreach ($res as $key => $value) {
  $nome_turma=$value['nome_turma'];
}
  $data=date("Y-m-d H:i:s");
  

?>



<script src="ajax.js?<?php echo rand(); ?>"></script>
<audio id="myAudio" src="alerta.wav"></audio>
<!-- <audio id="myAudio" src="alerta_enviado.wav"></audio> -->



<div class="content-wrapper" style="min-height: 529px;">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-12 alert alert-warning">

            <h1 class="m-0"><b>
              <?php
              if (isset($nome_escola_global)) {
                echo $_SESSION['NOME_APLICACAO']; 
              }
              ?>

             <?php if (isset($_SESSION['nome'])) {

              echo "  ".$_SESSION['nome'];  

            } 

             ?></b></h1>

          </div><!-- /.col -->

 <!-- /.col -->

        </div><!-- /.row -->

      </div><!-- /.container-fluid -->

    </div>

    <!-- /.content-header -->



    <!-- Main content -->



            </section>



            <!-- Main content -->

            <section class="content">

              <div class="container-fluid">



                <!-- Timelime example  -->

                <div class="row">

                  <div class="col-md-12">

                  
            <!-- DIRECT CHAT primary -->
            <div class="card card-primary direct-chat direct-chat-primary"> 


              <div class="card-header">
                <h3 class="card-title">Bate papo da turma: <?php echo $nome_turma; ?></h3>

                <div class="card-tools">
                  
                  
                 <!--  <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="widgets.html" data-source-selector="#card-refresh-content" data-load-on-init="false">
                    <i class="fas fa-sync-alt"></i>
                  </button> -->

                  <button type="button" class="btn btn-tool" data-card-widget="maximize">
                    <i class="fas fa-expand"></i>
                  </button>
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button> -->
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button> -->
                


                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body overflow" >
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages" id="messages">
                  <!-- h-100 d-inline-block -->
                  <!-- Message. Default to the left -->
                

                    
                  
                





                </div>
                <!-- /.direct-chat-pane -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                
                  <div class="input-group">
                    <input type="text" value="" id="mensagem_enviar" placeholder="Digite sua mensagem ..." class="form-control">
                    <span class="input-group-append" >
                      <input type="hidden" id="id_mensagem" value="">
                      <a class="btn btn-primary" onclick="chat_enviar();">Enviar</a>
                    </span>
                  </div>
                
              </div>
              <!-- /.card-footer-->
            </div>
            <!--/.direct-chat -->
       

             </div>

           <!-- /.content -->

          </div>        

      </div>

    </div>

  </section>

</div>

<script>

</script>

<aside class="control-sidebar control-sidebar-dark">

  <!-- Control sidebar content goes here -->

</aside>

  <!-- /.control-sidebar -->

  <script type="text/javascript">

    /* Máscaras ER */

    function mascara(o,f){

        v_obj=o

        v_fun=f

        setTimeout("execmascara()",1)

    }

    function execmascara(){

        v_obj.value=v_fun(v_obj.value)

    }

    function mtel(v){

        v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito

        v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos

        v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos

        return v;

    }



  </script>



 <?php 

    include_once 'rodape_pesquisas.php';

 ?>