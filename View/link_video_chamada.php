<?php
  include 'seguranca_aluno.php';

  include "cabecalho.php";
  include "alertas.php";

  include "barra_horizontal.php";

  include 'menu.php';

  include_once '../Model/Conexao.php';

  include '../Model/Aluno.php';

  include '../Controller/Conversao.php';

  include '../Model/Trabalho.php';

  $idaluno=$_SESSION['idaluno'];
  $idescola=$_SESSION['escola_id'];
  $idturma=$_SESSION['turma_id'];


?>



<script src="ajax.js"></script>



<div class="content-wrapper" style="min-height: 529px;">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-12 alert alert-warning">

            <h1 class="m-0"><b>

               <?php
              if (isset($nome_escola_global)) {
                echo $nome_escola_global; 
              }
              ?>

             <?php if (isset($_SESSION['nome'])) {

              echo " - ".$_SESSION['nome'];  

            } 

             ?></b></h1>

          </div><!-- /.col -->

 <!-- /.col -->

        </div><!-- /.row -->

      </div><!-- /.container-fluid -->

    </div>

    <!-- /.content-header -->

            <!-- Main content -->

            <section class="content">

              <div class="container-fluid">

                <div class="row">

                  <div class="col-md-12">
                    
                   
                    
                                <div class="card card-default">
                                  <div class="card-header">
                                    <h3 class="card-title">
                                      <i class="fas fa-bullhorn"></i>
                                      Link de vídeo chamadas
                                    </h3>
                                  </div>

                                  <?php
                                    $res_pendencia=$conexao->query("SELECT * FROM trabalho WHERE escola_id=$idescola and turma_id=$idturma");
                                    // foreach ($res_pendencia as $key => $value) {
                                    //   $idtrabalho=$value['id'];
                                    //   $titulo=$value['titulo'];
                                    //   $descricao=$value['descricao'];
                                    //   $res=$conexao->query("SELECT * FROM trabalho_entregue WHERE trabalho_id=$idtrabalho limit 1");
                                    //   $cont=0;
                                    //   foreach ($res as $key => $value) {
                                    //     $cont++;
                                    //   }
                                    // }                                  

                                  ?>
                                     <div class="callout callout-info">
                                      <h5>Em breve!</h5>

                                      <p><a href="">Em breve link da vídeo chamada aqui</a>.</p>
                                    </div>
                                   <!-- <div class="callout callout-warning">
                                      <h5>I am a warning callout!</h5>

                                      <p>This is a yellow callout.</p>
                                    </div>
                                    <div class="callout callout-success">
                                      <h5>I am a success callout!</h5>

                                      <p>This is a green callout.</p>
                                    </div> -->
                                  </div>
                                  <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                              





                  </div>        

                </div>

              </div>

            </section>

</div>

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

    include 'rodape_pesquisas.php';

 ?>