<?php
  include 'seguranca_aluno.php';

  include "cabecalho.php";
  include "alertas.php";
  include "barra_horizontal.php";
  include 'menu.php';

  include_once '../Model/Conexao.php';

  include '../Model/Video.php';

  include '../Controller/Conversao.php';


  $idturma=$_GET['idturma'];
  $iddisciplina=$_GET['iddisciplina'];

  
  if (isset($_GET['turma'])) {
    $turma=$_GET['turma'];
    $disciplina=$_GET['disciplina'];
  }  # code...
  $idvideo=$_GET['idvideo'];

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
                echo NOME_APLICACAO; 
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

                      $result=listar_video_individual($conexao, $idvideo);


                      $cont=0;
                      foreach ($result as $key => $linha) {

                          $cont++;
                           $idvideo=$linha['id'];
                           $link=trim($linha['link']);
                           $video_local=$linha['video_local'];
                           $titulo=$linha['titulo'];
                           $descricao=$linha['descricao'];
                           $data_visivel=data($linha['data_visivel']);

                           echo"

                           <div class='time-label'>

                             <span class='bg-red'>$data_visivel</span>

                           </div>

                           <div>

                                           <i class='fas fa-video bg-maroon'></i>



                                           <div class='timeline-item'>

                                             <span class='time'><i class='fas fa-clock'></i>$data_visivel</span>



                                             <h3 class='timeline-header'>id: $idvideo - <a href='#'>$titulo</a> $descricao</h3>



                                             <div class='timeline-body'>

                                              <div class='embed-responsive embed-responsive-16by9'>";
                                              if($link!=""){
                                                echo"
                                                 <iframe width='360' height='315' class='embed-responsive-item' src='https://www.youtube.com/embed/$link' allowfullscreen ></iframe>";
                                                }else{
                                                echo"<video width='320' height='240' controls>
                                                  <source src='video/$video_local' type='video/mp4'>";
                                                }

                                              
                                              echo" </div>

                                             </div>

                                             <div class='timeline-footer'>



                                                <!--<a class='btn btn-sm bg-maroon'>Comentar</a>-->

                                             </div>

                                           </div>

                                         </div>

                                        <script>
                                          setInterval('visualizacao_video($idvideo,$idaluno)', 30000);
                                        </script>

                           ";

                      }
                    

                    ?>


                    
<!-- 
                        <script>
                          

                          // 3. This function creates an <iframe> (and YouTube player)
                          //    after the API code downloads.
                          var player;
                          function onYouTubeIframeAPIReady() {
                            player = new YT.Player('player', {
                            
                              
                              events: {
                                'onReady': onPlayerReady,
                                'onStateChange': onPlayerStateChange
                              }
                            });
                          }

                          // 4. A API chamará esta função quando o player de vídeo estiver pronto.
                          function onPlayerReady(event) {
                            event.target.playVideo();
                          }

                          // 5. A API chama essa função quando o estado do player muda.
                          // A função indica que ao reproduzir um vídeo (estado = 1),
                          // o jogador deve jogar por seis segundos e então parar.
                          var done = false;
                          var duracao=0;
                          function onPlayerStateChange(event) {
                            if (event.data == YT.PlayerState.PLAYING && !done) {
                              //setTimeout(stopVideo, 6000);
                              done = true;
                            }

                           



                             switch(event.data) {
                                case 0:
                                   // alert('vídeo acabou ');
                                    break;
                                case 1:
                                duracao= player.getDuration();
                                //alert("Duração desse vídeo:"+duracao/60);
                                      setInterval('visualizacao_video($idvideo,$idaluno)', 30000);
                                   
                                    break;
                                case 2:
                                   // alert('pausado em '+player.getCurrentTime());
                                    break;
                            }
                          }

                          function stopVideo() {
                            player.stopVideo();
                          }
                        </script> -->


                    <button class="btn btn-danger btn-block" onclick="goBack()">Voltar</button>
                    

                    <script type="text/javascript">
                    // var player;
                    // function onYouTubeIframeAPIReady() {
                    //     player = new YT.Player( 'player', {
                    //         events: { 'onStateChange': onPlayerStateChange }
                    //     });
                    // }

                    // function onPlayerStateChange(event) {
                    //     switch(event.data) {
                    //         case 0:
                    //             alert('vídeo acabou');
                    //             break;
                    //         case 1:
                    //             alert('começou em '+player.getCurrentTime());
                    //             break;
                    //         case 2:
                    //             alert('pausado em '+player.getCurrentTime());
                    //             break;
                    //     }
                    // }
                    </script>

                    <script>
                     

                      function goBack() {
                          window.history.back();
                      }
                   
                    </script>
                    
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
