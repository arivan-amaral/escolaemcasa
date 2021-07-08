<?php
session_start();
if (!isset($_SESSION['idcoordenador'])) {
  header("location:index.php?status=0");

}else{

  $idcoordenador=$_SESSION['idcoordenador'];

}

  include "cabecalho.php";
  include "alertas.php";
  include "barra_horizontal.php";
  include 'menu.php';
  include '../Model/Conexao.php';
  include '../Model/Video.php';
  include '../Controller/Conversao.php';




  $idturma=$_GET['turm'];

  $iddisciplina=$_GET['disc'];
  $idescola=$_GET['idescola'];
  $idserie=$_GET['idserie'];

  

?>



<script src="ajax.js?<?php echo rand(); ?>"></script>



<div class="content-wrapper" style="min-height: 529px;">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-10 alert alert-warning">

            <h1 class="m-0"><b>

               <?php
              if (isset($nome_escola_global)) {
                echo $nome_escola_global; 
              }
              ?>

             <?php if (isset($_SESSION['nome'])) {

              echo $_SESSION['nome'];  

            } 

             ?></b></h1>

          </div><!-- /.col -->

          <div class="col-sm-2">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Home</a></li>

              <li class="breadcrumb-item active">Início</li>

            </ol>

          </div><!-- /.col -->

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
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                    <!-- The time line -->









                    <div class="timeline">

                      <!-- timeline time label -->



                  

                    <?php 

                      $result=listar_video_coordenador_por_serie($conexao,$iddisciplina,$idserie);



                      foreach ($result as $key => $linha) {

                           $idvideo=$linha['id'];

                           $link=$linha['link'];

                           $titulo=$linha['titulo'];

                           $descricao=$linha['descricao'];

                           $data_visivel=data($linha['data_visivel']);

                           echo"

                           <div class='time-label'>

                             <span class='bg-blue'>$data_visivel</span>

                           </div>

                           <div>

                                           <i class='fas fa-video bg-maroon'></i>



                                           <div class='timeline-item'>

                                             <span class='time'><i class='fas fa-clock'></i>$data_visivel</span>



                                             <h3 class='timeline-header'>id: $idvideo - <a href='#'> $titulo</a> $descricao</h3>



                                             <div class='timeline-body'>

                                               <div class='embed-responsive embed-responsive-16by9'>

                                                 <iframe class='embed-responsive-item' src='https://www.youtube.com/embed/$link' allowfullscreen></iframe>

                                               </div>

                                             </div>

                                             <div class='timeline-footer'>

                                                <!--<a href='#' class='btn btn-sm bg-maroon'>Comentar</a>-->

                                             </div>

                                           </div>

                                         </div>

                                         <!-- END timeline item -->

                                         



                           ";

                      }

               

                      $result_normal=listar_video_coordenador($conexao, $idturma,$iddisciplina,$idescola);



                      foreach ($result_normal as $key => $linha) {

                           $idvideo=$linha['id'];

                           $link=$linha['link'];

                           $titulo=$linha['titulo'];

                           $descricao=$linha['descricao'];

                           $data_visivel=data($linha['data_visivel']);

                           echo"

                           <div class='time-label'>

                             <span class='bg-blue'>$data_visivel</span>

                           </div>

                           <div>

                                           <i class='fas fa-video bg-maroon'></i>



                                           <div class='timeline-item'>

                                             <span class='time'><i class='fas fa-clock'></i>$data_visivel</span>



                                             <h3 class='timeline-header'>id: $idvideo - <a href='#'> $titulo</a> $descricao</h3>



                                             <div class='timeline-body'>

                                               <div class='embed-responsive embed-responsive-16by9'>

                                                 <iframe class='embed-responsive-item' src='https://www.youtube.com/embed/$link' allowfullscreen></iframe>

                                               </div>

                                             </div>

                                             <div class='timeline-footer'>

                                                <!--<a href='#' class='btn btn-sm bg-maroon'>Comentar</a>-->

                                             </div>

                                           </div>

                                         </div>

                                         <!-- END timeline item -->

                                         



                           ";

                      }

                    ?>

                      <div>
                        <i class='fas fa-clock bg-gray'></i>
                      </div>
                    </div>

                      



            <!-- /.content -->

          </div>        

      </div>

    </div>

  </section>

</div>

<?php 

    include 'rodape.php';

 ?>