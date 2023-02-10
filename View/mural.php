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
  $serie_id=$_SESSION['serie_id'];
  $ano_letivo= $_SESSION['ano_letivo_vigente'];



?>



<script src="ajax.js?<?php echo rand(); ?>"></script>



<div class="content-wrapper" style="min-height: 529px;">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-12 alert alert-warning">

            <h1 class="m-0"><b>

               <?php
              if (isset($nome_escola_global)) {
                echo NOME_APLICACAO; 
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

            <section class="content">

              <div class="container-fluid">

                <div class="row">

                  <div class="col-md-12">
                    
                   
                    
                                <div class="card card-default">
                                  <div class="card-header">
                                    <h3 class="card-title">
                                      <i class="fas fa-bullhorn"></i>
                                      Mural
                                    </h3>
                                  </div>

                                  <?php
                                    $res_mural_secret=$conexao->query("SELECT * FROM mural where serie_id=$serie_id and setor='Secretaria' and ano_mural =$ano_letivo order by id desc");

                                    foreach ($res_mural_secret as $key => $value) {
                                      $idtrabalho=$value['id'];
                                      $titulo=$value['titulo'];
                                      $descricao=$value['descricao'];
                                    
                                  
                                        echo"<div class='card-body'>
                                          <div class='callout callout-danger'>
                                            <h5>$titulo</h5>
                                            <p>$descricao</p>
                                            <span class='text-info'> Postado pela secretaria.</span>
                                          </div>
                                          </div>";
                               

                                  }

                                   $res_mural=$conexao->query("SELECT * FROM mural where serie_id=$serie_id and turma_id=$idturma and escola_id=$idescola and setor='Escola' order by id desc");
                                    foreach ($res_mural as $key => $value) {
                                      $idtrabalho=$value['id'];
                                      $titulo=$value['titulo'];
                                      $descricao=$value['descricao'];
                                    
                                  
                                        echo"<div class='card-body'>
                                          <div class='callout callout-danger'>
                                            <h5>$titulo</h5>
                                            <p>$descricao</p>

                                            <span class='text-info'> Postado pelo professor(a).</span>

                                          </div>
                                          </div>";
                               

                                  }                                  

                                  ?>
                                   <!--  <div class="callout callout-info">
                                      <h5>I am an info callout!</h5>

                                      <p>Follow the steps to continue to payment.</p>
                                    </div>
                                    <div class="callout callout-warning">
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


<script type="text/javascript">

 function carregando(){
        let timerInterval
        Swal.fire({
          title: 'Aguarde, sua atividade está sendo enviada!',
          html: ' <b></b> ',
          timer: 100000,
          timerProgressBar: true,
          didOpen: () => {
            Swal.showLoading()
            timerInterval = setInterval(() => {
              const content = Swal.getContent()
              if (content) {
                const b = content.querySelector('b')
                if (b) {
                  b.textContent = Swal.getTimerLeft()
                }
              }
            }, 100)
          },
          willClose: () => {
            clearInterval(timerInterval)
          }
        }).then((result) => {
          /* Read more about handling dismissals below */
          if (result.dismiss === Swal.DismissReason.timer) {
            console.log('I was closed by the timer')
          }
        })
  }

</script>




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