<?php

  include 'seguranca_aluno.php';

  include "cabecalho.php";
  include "alertas.php";
  include "barra_horizontal.php";
  include 'menu.php';

  include '../Model/Conexao.php';

  include '../Model/Aluno.php';
  include '../Model/Video.php';

  include '../Controller/Conversao.php';
 date_default_timezone_set('America/Sao_Paulo');

  $idturma=$_GET['turm'];
  $iddisciplina=$_GET['disc'];


  
  $turma=$_GET['turma'];
  $disciplina=$_GET['disciplina'];

  $data=date("Y-m-d H:i:s");
  $idserie=$_SESSION['serie_id'];
  $escola_id=$_SESSION['escola_id'];

  $cont=0;
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



        



            <!-- Main content -->

            <section class="content">

              <div class="container-fluid">



                <!-- Timelime example  -->

                <div class="row">

                  <div class="col-md-12">

                    <!-- The time line -->

                    <div class="timeline">

                    <?php 



                    // abaixo videos postado pelo gt

                    echo "

                    <div class='row'>
                    <div class='col-sm-1'></div>
                    <div class='col-sm-8'>
                      <div class='card card-info'>
                        <div class='card-header' data-card-widget='collapse'>
                          <h3 class='card-title'>VER VÍDEOS DO GT </h3>

                          <div class='card-tools'>
                            <button type='button' class='btn btn-tool' data-card-widget='collapse'>
                              <i class='fas fa-plus'></i>
                            </button>
                          </div>
                          <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class='card-body' style='display: block;;'>

                    ";


              if ($idserie==16) {
                      

                      $result_turma = $conexao->query("SELECT * FROM turma where idturma=$idturma ");


                    foreach ($result_turma as $key => $value_et) {
                        $etapa=$value_et['etapa'];
                         $array_url=explode('A', $etapa);
                         $inicio_etapa=$array_url[0];
                         $fim_etapa=$array_url[1];
                         for ($i=$inicio_etapa; $i <= $fim_etapa ; $i++) { 
                            $idserie=$i;

                            $result_por_serie= listar_video_aulas_gt_aluno($conexao,$idserie,$iddisciplina,$data);

                            foreach ($result_por_serie as $key => $linha) {

                                $cont++;
                                 $idvideo=$linha['id'];
                                 $link=$linha['link'];

                                 $titulo=$linha['titulo'];

                                 $descricao=$linha['descricao'];

                                 $data_visivel=data($linha['data_visivel']);

                                 echo"
                                 <br>
                                 <div class='time-label'>";

                                 $result_assistidos=listar_videos_assistidos_aluno($conexao,$idaluno,$idvideo);
                                 $minutos=0;  
                                 foreach ($result_assistidos as $key => $value) {
                                    $minutos=($minutos+$value['minuto']);
                                  }
                                  $minutos=$minutos/2;
                                  if ($minutos>0) {
                                    echo"<span class='bg-success'>$data_visivel esse vídeo foi visualizado: $minutos min </span>";

                                  }else{
                                    echo"<span class='bg-red'>$data_visivel esse vídeo NÂO foi visualizado</span>";

                                  }


                                 echo"</div>

                                 <div>
                                            
                                                  <div class='timeline-item'>
                                                   <span class='time'><i class='fas fa-clock'></i>$data_visivel</span>
                                                   <h5 class='timeline-header'>id: $idvideo - <a href='#'>$titulo</a> $descricao</h5>



                                                   <div class='timeline-body'>

                                                    <a  href='video_aula_individual.php?idvideo=$idvideo&idturma=$idturma&iddisciplina=$iddisciplina&turma=$turma&disciplina=$disciplina'>
                                                     <img src='imagens/assista-video.gif' width='200' classe='img-fluid'>
                                                    </a>

                                                   </div>

                                                   <div class='timeline-footer'>



                                                      <!--<a class='btn btn-sm bg-maroon'>Comentar</a>-->

                                                   </div>

                                                 </div>

                                               </div>

                                               <!-- END timeline item -->

                                 ";

                            }




                         }
                    } //fim foreach

                echo"
                  </div>
                </div>
              </div>
            </div>
            ";

              }else{

                    $result_por_serie= listar_video_aulas_gt_aluno($conexao,$idserie,$iddisciplina,$data);

                    // $cont=0;
                    foreach ($result_por_serie as $key => $linha) {

                        $cont++;
                         $idvideo=$linha['id'];
                         $link=$linha['link'];

                         $titulo=$linha['titulo'];

                         $descricao=$linha['descricao'];

                         $data_visivel=data($linha['data_visivel']);

                         echo"
                         <div class='time-label'>";
                         $result_assistidos=listar_videos_assistidos_aluno($conexao,$idaluno,$idvideo);
                        
                         $minutos=0;
                         
                         foreach ($result_assistidos as $key => $value) {
                          
                            $minutos=($minutos+$value['minuto']);
                  
                          }
                          $minutos=$minutos/2;
                          if ($minutos>0) {
                            echo"<span class='bg-success'>$data_visivel esse vídeo foi visualizado: $minutos min </span>";

                          }else{
                            echo"<span class='bg-red'>$data_visivel esse vídeo NÂO foi visualizado</span>";

                          }


                         echo"</div>

                         <div>
                                      <i class='fas fa-video bg-maroon'></i>
                                          <div class='timeline-item'>
                                           <span class='time'><i class='fas fa-clock'></i>$data_visivel</span>
                                           <h3 class='timeline-header'>id: $idvideo - <a href='#'>$titulo</a> $descricao</h3>



                                           <div class='timeline-body'>

                                            <a  href='video_aula_individual.php?idvideo=$idvideo&idturma=$idturma&iddisciplina=$iddisciplina&turma=$turma&disciplina=$disciplina'>
                                             <img src='imagens/assista-video.gif' width='200' classe='img-fluid'>
                                            </a>

                                           </div>

                                           <div class='timeline-footer'>



                                              <!--<a class='btn btn-sm bg-maroon'>Comentar</a>-->

                                           </div>

                                         </div>

                                       </div>

                                       <!-- END timeline item -->

                         ";

                    }
            }//fim else videos do gt




            echo"
                  </div>
                </div>
              </div>
            </div>
            ";







                      $result=listar_video_aulas_aluno($conexao,$escola_id,$idturma,$iddisciplina,$data);
                      foreach ($result as $key => $linha) {

                          $cont++;
                           $idvideo=$linha['id'];
                           $link=$linha['link'];

                           $titulo=$linha['titulo'];

                           $descricao=$linha['descricao'];

                           $data_visivel=data($linha['data_visivel']);

                           echo"

                           <div class='time-label'>";
                           $result_assis=listar_videos_assistidos_aluno($conexao,$idaluno,$idvideo);
                          
                           $minutos=0;
                           
                    
                               
                         foreach ($result_assis as $key => $value) {
                          
                            $minutos=($minutos+$value['minuto']);
                  
                          }

                          $minutos=$minutos/2;
                            if ($minutos>0) {
                              echo"<span class='bg-success'>$data_visivel esse vídeo foi visualizado: $minutos min </span>";

                            }else{
                              echo"<span class='bg-red'>$data_visivel esse vídeo NÂO foi visualizado</span>";

                            }


                           echo"</div>

                           <div>

                                           <i class='fas fa-video bg-maroon'></i>



                                           <div class='timeline-item'>

                                             <span class='time'><i class='fas fa-clock'></i>$data_visivel</span>


                                             <h3 class='timeline-header'>id: $idvideo - <a href='#'>$titulo</a> $descricao</h3>



                                             <div class='timeline-body'>

                                              <a  href='video_aula_individual.php?idvideo=$idvideo&idturma=$idturma&iddisciplina=$iddisciplina&turma=$turma&disciplina=$disciplina'>
                                               <img src='imagens/assista-video.gif' width='200' classe='img-fluid'>


                                             </div>

                                             <div class='timeline-footer'>



                                                <!--<a class='btn btn-sm bg-maroon'>Comentar</a>-->

                                             </div>

                                           </div>

                                         </div>

                                         <!-- END timeline item -->

                           ";

                      }
                      if ($cont==0) {
                        echo "
                        <script>
                        Swal.fire(
                          'Nenhuma aula postada por enquanto!',
                          '',
                          'warning'
                        )
                        </script>

                        ";
                      }

                    ?>

                      <div>

                        <i class='fas fa-clock bg-gray'></i>

                      </div>

                    </div>

                      






                    <script type="text/javascript" src="https://www.youtube.com/iframe_api"></script>

                    




               



            <!-- /.content -->

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

    include 'rodape.php';

 ?>