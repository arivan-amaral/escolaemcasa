<?php

if (!isset($_COOKIE['notificado_videos_não'])) {
    
  echo "<script type='text/javascript'>
      function modal_video() {
          $(document).ready(function() {
              $('#modal-aviso').modal('show');
            });
      }

      setTimeout('modal_video();',1000);
      
  </script>";
 
  
}
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
date_default_timezone_set('America/Sao_Paulo');

$idaluno=$_SESSION['idaluno'];
$idescola=$_SESSION['escola_id'];
$idturmaGlobal=$_SESSION['turma_id'];
$turma_id=$_SESSION['turma_id'];
$idturma=$_SESSION['turma_id'];
$idserie=$_SESSION['serie_id'];

  $data=date("Y-m-d H:i:s");
  

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
                echo $_SESSION['NOME_APLICACAO']; 
              }
              ?> 

             <?php if (isset($_SESSION['nome'])) {

              echo $_SESSION['nome'];  

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

                    <!-- The time line -->









                    <div class="timeline">

                      <!-- timeline time label -->



                  

                    <?php 



              if ($idserie==16) {
                      

                      $result_turma = $conexao->query("SELECT * FROM turma where idturma=$idturma ");


                    foreach ($result_turma as $key => $value_et) {
                        $etapa=$value_et['etapa'];
                         $array_url=explode('A', $etapa);
                         $inicio_etapa=$array_url[0];
                         $fim_etapa=$array_url[1];
                         for ($i=$inicio_etapa; $i <= $fim_etapa ; $i++) { 
                            $idserie=$i;

                            $result_por_serie=listar_video_aulas_gt_nao_visualisado_aluno($conexao,$idserie,$data);

                            $cont=0;
                            foreach ($result_por_serie as $key => $linha) {

                                $cont++;
                                 $idvideo=$linha['id'];
                                 $link=$linha['link'];

                                 $titulo=$linha['titulo'];

                                 $descricao=$linha['descricao'];
                                 $iddisciplina=$linha['id_disciplina'];

                                 $data_visivel=data($linha['data_visivel']);

                                 echo"
                                 <br>";
                                 $result_assistidos=listar_videos_assistidos_aluno($conexao,$idaluno,$idvideo);
                                
                                 $minutos=0;
                                 
                                 foreach ($result_assistidos as $key => $value) {
                                  
                                    $minutos=($minutos+$value['minuto']);
                            
                                  }
                                  $minutos=$minutos/2;
                                  if ($minutos==0) {
                                
                                 echo"<div class='time-label'>
                                          <span class='bg-red'>$data_visivel esse vídeo NÂO foi visualizado</span>
                                        </div>
                                      <div>
                                            
                                                  <div class='timeline-item'>
                                                   <span class='time'><i class='fas fa-clock'></i>$data_visivel</span>
                                                   <h5 class='timeline-header'>id: $idvideo - <a href='#'>$titulo</a> $descricao</h5>



                                                   <div class='timeline-body'>

                                                    <a  href='video_aula_individual.php?idvideo=$idvideo&idturma=$idturma&iddisciplina=$iddisciplina'>
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
                              }//fim if minutos

                            }




                         }
                    } //fim foreach

                echo"
                  </div>
                </div>
              </div>
            </div>
            ";

          }

                    $result_por_serie= listar_video_aulas_gt_nao_visualisado_aluno($conexao,$idserie,$data);

                    $cont=0;
                    foreach ($result_por_serie as $key => $linha) {

                        $cont++;
                         $idvideo=$linha['id'];
                         $link=$linha['link'];

                         $titulo=$linha['titulo'];

                         $descricao=$linha['descricao'];
                         $disciplina_id=$linha['id_disciplina'];

                         $data_visivel=data($linha['data_visivel']);

                        
                         $result_assistidos=listar_videos_assistidos_aluno($conexao,$idaluno,$idvideo);
                        
                         $minutos=0;
                         
                         foreach ($result_assistidos as $key => $value) {
                          
                            $minutos=($minutos+$value['minuto']);
                    
                          }
                          $minutos=$minutos/2;
                          if ($minutos==0) {
                             echo"
                               <div class='time-label'>";
                            echo"<span class='bg-red'>$data_visivel esse vídeo NÂO foi visualizado</span>";
                            echo"</div>

                                 <div>
                                      <i class='fas fa-video bg-maroon'></i>
                                          <div class='timeline-item'>
                                           <span class='time'><i class='fas fa-clock'></i>$data_visivel</span>
                                           <h3 class='timeline-header'>id: $idvideo - <a href='#'>$titulo</a> $descricao</h3>



                                           <div class='timeline-body'>

                                            <a  href='video_aula_individual.php?idvideo=$idvideo&idturma=$turma_id&iddisciplina=$disciplina_id'>
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



                      $res_pendencia_v=$conexao->query("SELECT * FROM video WHERE escola_id=$idescola and serie_id=$idserie and id_turma=$turma_id and setor !='Secretaria'  order by id desc, data_visivel desc ");
                      $cont_video=0;

                      foreach ($res_pendencia_v as $key => $linha) {
                        $idvideo=$linha['id'];

                        $iddisciplina=$linha['id_disciplina'];
                        $idturma=$linha['id_turma'];
                        $idescola=$linha['escola_id'];

                        $link=$linha['link'];
                        $titulo=$linha['titulo'];
                        $descricao=$linha['descricao'];
                        $data_visivel=data($linha['data_visivel']);

                        $res_v=$conexao->query("SELECT * FROM visualizacao_video WHERE video_id=$idvideo and aluno_id=$idaluno limit 1");
                       
                        $cont_v=0;
                        foreach ($res_v as $key => $value) {
                          $cont_v++;
                          break;
                        }
                        if ($cont_v==0) {
                          echo"

                           <div class='time-label'>
                           <span class='bg-red'>$data_visivel esse vídeo NÂO foi visualizado</span>
                           </div>

                           <div>

                                           <i class='fas fa-video bg-maroon'></i>

                                           <div class='timeline-item'>

                                             <span class='time'><i class='fas fa-clock'></i>$data_visivel</span>



                                             <h3 class='timeline-header'>id: $idvideo - <a href='#'>$titulo</a> $descricao</h3>



                                             <div class='timeline-body'>

                                              <a  href='video_aula_individual.php?idvideo=$idvideo&idturma=$idturma&iddisciplina=$iddisciplina&idescola=$idescola'>
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
                        $cont_video++;
                    }
                      
                                                        

                      
                      if ($cont_video==0 && $cont==0) {
                        echo "
                        <script>
                        Swal.fire(
                          'Nada encontrado!',
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

                    <script type="text/javascript">
                    var player;
                    function onYouTubeIframeAPIReady() {
                        player = new YT.Player( 'player', {
                            events: { 'onStateChange': onPlayerStateChange }
                        });
                    }

                    function onPlayerStateChange(event) {
                        switch(event.data) {
                            case 0:
                                alert('vídeo acabou');
                                break;
                            case 1:
                                alert('começou em '+player.getCurrentTime());
                                break;
                            case 2:
                                alert('pausado em '+player.getCurrentTime());
                                break;
                        }
                    }
                    </script>






               



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


<div class="modal fade" id="modal-aviso">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" style="color: red;">ATENÇÃO</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        

          <div class="modal-body">
              <!-- /corpo -->
          <center>
            <h2 ><b>Esta página contém apenas os vídeos que <span style="color: red;">AINDA NÃO</span> foram visualizados pelo aluno. Após serem visualizados estarão disponíveis para conferência em suas respectivas disciplinas.</b></h2>
           
          </center>
          <br>
           

          <!-- /corpo -->
        </div>
           <br>
      <button type="button" class="btn btn-default" data-dismiss="modal">
        <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Fechar</font></font></button>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


 <?php 

    include_once 'rodape.php';

 ?>