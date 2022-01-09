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

  include '../Controller/Conversao.php';

  include '../Model/Conexao.php';

  include '../Model/Disciplina.php';

  include '../Model/Turma.php';
  include '../Model/Escola.php';
  include '../Model/Video.php';

  

  

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
                echo $nome_escola_global; 
              }
              ?>
             <?php if (isset($_SESSION['nome'])) {

              echo " ".$_SESSION['nome'];  

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

        <!-- Info boxes -->





        <!-- .row -->

        

      <div class="row">

        <div class="col-md-1">

        </div>

         <div class="col-md-10">

            <div class="card card-primary">

                  <div class="card-header">

                    <h3 class="card-title">Cadastrar vídeo do GT</h3>

                  </div>

                  

                  <form action="../Controller/cadastro_video_gt.php" method="post">

                    <div class='card-body'>



                      <label>Selecione a série</label>

                      <select name='idserie'  class="custom-select rounded-0" required>

                        <option></option>

                        <?php

                        $res_turma=lista_serie($conexao);

                        foreach ($res_turma as $key => $value) {

                            $idserie = $value['id'];

                            $serie = ($value['nome']);

                            echo "<option value='$idserie' class='text-black'>$serie</option>";

                          

                        }



                        ?>

                      </select>



                     <label>Selecione a disciplina </label>

                      <select name='iddisciplina'  class="custom-select rounded-0" required>

                        <option></option>

                        <?php

                        $res_disciplina=lista_disciplina($conexao); 

                        foreach ($res_disciplina as $key => $value) {

                            $iddisciplina = $value['iddisciplina'];

                            $disciplina = ($value['nome_disciplina']);

                            echo "<option value='$iddisciplina' class='text-black'>$disciplina</option>";

                          

                        }



                        ?>

                      </select>

                      <br>
                      <br>

                       

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

                                

                      <div class="card-footer">

                        <button type="submit" class="btn btn-primary">Cadastrar </button>

                      </div>



                    </div>

                </form>



                </div>

             </div> <!-- </div> class=col- 10 -->

      </div> <!-- </div> row  -->







     

      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-4">

          <!-- The time line -->


          <div class="timeline">

            <!-- timeline time label -->



        

          <?php 

          $res_cont=conta_video_gt($conexao);
          $quantidade_total_video_gt=0;

          foreach ($res_cont as $key => $value) {
            $quantidade_total_video_gt=$value['quantidade'];
          }

          $result_gt= listar_video_gt_coordenador($conexao);
          $conta=1;
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
                            <i class='fas bg-maroon'>".$quantidade_total_video_gt--."</i>
                               <div class='timeline-item'>
                                 <span class='time'><i class='fas fa-clock'></i>$data_visivel</span>
                                 <h3 class='timeline-header'><a href='#'>$titulo</a> $descricao</h3>
                                 <div class='timeline-body'>
                                   <div class='embed-responsive embed-responsive-16by9'>
                                     <iframe width='360' height='315' class='embed-responsive-item' src='https://www.youtube.com/embed/$link' allowfullscreen ></iframe>
                                   </div>
                                 </div>
                                 <div class='timeline-footer'>
                                    <a href='../Controller/Excluir_video.php?id=$idvideo' class='btn btn-sm bg-red'>EXCLUIR VÍDEO</a>

                                 </div>

                               </div>
                             </div>";
            $conta++;
          }



          ?>

            <div>

              <i class='fas fa-clock bg-gray'></i>

            </div>

          </div>

            



 

        <!-- Main row -->

        <!-- /.row -->

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