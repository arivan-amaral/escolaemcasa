<?php
  include "seguranca_aluno.php";
  include "cabecalho.php";
  include "alertas.php";
  include "barra_horizontal.php";
  include 'menu.php';
  include '../Model/Conexao.php';
  include '../Model/Video.php';
  include '../Controller/Conversao.php';




  $idturma=$_SESSION['turma_id'];
  $idescola=$_SESSION['escola_id'];
  $idserie=$_SESSION['serie_id'];
  $diasemana_get=$_GET['diasemana'];
  $turma=$_GET['turma'];
  $disciplina=$_GET['disciplina'];
  $diasemana_array = array('Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feirs', 'Sexta-feira', 'Sábado');


  

?>



<script src="ajax.js?<?php echo rand(); ?>"></script>



<div class="content-wrapper" style="min-height: 529px;">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-1 "></div>
          <div class="col-sm-10 alert alert-secondary">

            <h1 class="m-0"><b>

               <?php
      echo "$turma - $disciplina";

            

             ?></b></h1>

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
                    <div class="col-md-1"></div>
                    <div class="col-md-8">
                    <!-- The time line -->
                <div class="timeline">

                      <!-- timeline time label -->



                  

                    <?php 

                          // echo $diasemana[$diasemana_numero];
                    $result=$conexao->query("SELECT * FROM video where  serie_id=$idserie  order by data_visivel desc   ");
                    foreach ($result as $key => $linha) {

                         $idvideo=$linha['id'];
                         $iddisciplina=$linha['id_disciplina'];
                         $idturma=$linha['id_turma'];
                    

                         $link=$linha['link'];

                         $titulo=$linha['titulo'];

                         $descricao=$linha['descricao'];

                         $data_visivel=data($linha['data_visivel']);
                          
                          $data_visivel_simples=data_simples($linha['data_visivel']);
                          $diasemana_bd= date('w', strtotime($data_visivel_simples));



                        if ($diasemana_get== $diasemana_bd) {


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
                                                    <a  href='video_aula_individual.php?idvideo=$idvideo&idturma=$idturma&iddisciplina=$iddisciplina&turma=$turma&disciplina=$disciplina'>
                                                     <img src='imagens/assista-video.gif' width='200' classe='img-fluid'>
                                                    </a>
                                              </div>

                                           <div class='timeline-footer'>

                                              <!--<a href='#' class='btn btn-sm bg-maroon'>Comentar</a>-->

                                           </div>

                                         </div>

                                       </div>

                                       <!-- END timeline item -->";
                    }

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