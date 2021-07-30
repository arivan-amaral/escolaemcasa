<?php
session_start();
if (!isset($_SESSION['idprofessor'])) {

       header("location:index.php?status=0");

}else{

  $idprofessor=$_SESSION['idprofessor'];

}
include "cabecalho.php";
include "alertas.php";

  include "barra_horizontal.php";
  include 'menu.php';
  include '../Model/Conexao.php';
  include '../Controller/Conversao.php';

  include '../Model/Video.php';







  $idescola=$_GET['idescola'];
  $idserie=$_GET['idserie'];
  $idturma=$_GET['turm'];
  $iddisciplina=$_GET['disc'];

  

?>



<script src="ajax.js"></script>



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

              <li class="breadcrumb-item active">Aulas</li>

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


                <div class="row">
                  <div class="col-md-12">
                                              
                                              <button type="button" class="btn btn-block btn-success"><?php echo $_GET['turma']."  - ".$_GET['disciplina']; ?></button>
                                              <br>
                                          <form class="mt-12" action="../Controller/Cadastro_video.php" method="post">
                                              
                                              <h4 class="card-title">Link do vídeo no youtube</h4>
                                              <div class="form-group">
                                                  <input type="text" name="link" class="form-control" autocomplete="off" required="">
                                              </div>

                                              <h4 class="card-title">Título do vídeo</h4>
                                              <div class="form-group">
                                                  <input type="text" name="titulo" class="form-control" autocomplete="off"  required="">
                                              </div>

                                             
                                          <h4 class="card-title">Vídeo visível a partir da data:</h4>
                                          <div class="form-group">
                                                  <input type="date" name="data_visivel" class="form-control"   required="">
                                              </div>
                                          <h4 class="card-title">Vídeo visível a partir da hora:</h4>
                                              <div class="form-group">
                                                  <input type="time" name="hora" class="form-control" required=""  >
                                              </div>
                              
                                              <h4 class="card-title">Descrição do Vídeo</h4>
                                              <div class="form-group">
                                                  <textarea class="form-control" rows="3" name="descricao" placeholder="Descrição do Video" required=""></textarea>
                                              </div>

                                                 <input type="hidden" name="idturma" value="<?php echo $_GET['turm']; ?>" class="form-control" required="">

                                                 <input type="hidden" name="idescola" value="<?php echo $idescola; ?>" class="form-control" required="">
     <input type="hidden" name="idserie" value="<?php echo $idserie; ?>" class="form-control" required="">

                   <input type="hidden" name="origem" value="professor" class="form-control" required="">

                                                 <input type="hidden" name="turma" value="<?php echo $_GET['turma']; ?>" class="form-control" required="">

                                                 <input type="hidden" name="disciplina" value="<?php echo $_GET['disciplina']; ?>" class="form-control" required="">

                                                 <input type="hidden" name="iddisciplina" value="<?php echo $_GET['disc']; ?>" class="form-control" required="">

                                               <button type="submit" class="btn waves-effect waves-light btn-lg btn-primary">Salvar Vídeo Aula</button>
                                               <br>
                                               <br>
                                              
                                          </form>
                                        
                  </div>
                </div>



                <div class="row">
                  <div class="col-md-12">

                    <!-- The time line -->


                    <div class="timeline">

                      <!-- timeline time label -->



                  

                    <?php 



                    $result_gt= listar_video_gt_professor($conexao, $idserie);
                    foreach ($result_gt as $key => $linha) {
                         $idvideo=$linha['id'];
                         $link=$linha['link'];
                         $titulo=$linha['titulo'];
                         $descricao=$linha['descricao'];
                         $hora=$linha['data_visivel'];
                         $data_visivel=data_simples($linha['data_visivel']);
                         echo"
                         <div class='time-label'>
                          <b>Data visível:</b>
                          <input  type='date' class='form-control is-invalid' id='data$idvideo' name='data' value='$data_visivel' required onchange='atualiza_data_hora_video($idvideo);' >
                           <b>Hora visível:</b>
                           <input  class='form-control is-invalid' id='hora$idvideo' type='time' name='hora'  value='".hora($hora)."' required onchange='atualiza_data_hora_video($idvideo);'>
                         </div>
                         <div>

                                         <i class='fas fa-video bg-maroon'></i>



                                         <div class='timeline-item'>

                                           <span class='time'><i class='fas fa-clock'></i>$data_visivel</span>



                                           <h3 class='timeline-header'><a href='#'>$titulo</a> $descricao</h3>



                                           <div class='timeline-body'>

                                             <div class='embed-responsive embed-responsive-16by9'>

                                               <iframe class='embed-responsive-item' src='https://www.youtube.com/embed/$link' allowfullscreen></iframe>

                                             </div>

                                           </div>

                                           <div class='timeline-footer'>

                                              <!--<a href='../Controller/Excluir_video.php?id=$idvideo' class='btn btn-sm bg-red'>EXCLUIR VÍDEO</a>-->

                                           </div>

                                         </div>

                                       </div>
                         ";
                    }


                      $result= listar_video_professor($conexao, $idprofessor,$idturma,$iddisciplina,$idescola);
                      foreach ($result as $key => $linha) {
                           $idvideo=$linha['id'];
                           $link=$linha['link'];
                           $titulo=$linha['titulo'];
                           $descricao=$linha['descricao'];
                           $hora=$linha['data_visivel'];
                           $data_visivel=data_simples($linha['data_visivel']);
                           echo"
                           <div class='time-label'>
                            <b>Data visível:</b>
                            <input  type='date' class='form-control is-invalid' id='data$idvideo' name='data' value='$data_visivel' required onchange='atualiza_data_hora_video($idvideo);' >
                             <b>Hora visível:</b>
                             <input  class='form-control is-invalid' id='hora$idvideo' type='time' name='hora'  value='".hora($hora)."' required onchange='atualiza_data_hora_video($idvideo);'>
                           </div>
                           <div>

                                           <i class='fas fa-video bg-maroon'></i>



                                           <div class='timeline-item'>

                                             <span class='time'><i class='fas fa-clock'></i>$data_visivel</span>



                                             <h3 class='timeline-header'><a href='#'>$titulo</a> $descricao</h3>



                                             <div class='timeline-body'>

                                               <div class='embed-responsive embed-responsive-16by9'>

                                                 <iframe class='embed-responsive-item' src='https://www.youtube.com/embed/$link' allowfullscreen></iframe>

                                               </div>

                                             </div>

                                             <div class='timeline-footer'>

                                                <a href='../Controller/Excluir_video.php?id=$idvideo' class='btn btn-sm bg-red'>EXCLUIR VÍDEO</a>

                                             </div>

                                           </div>

                                         </div>
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