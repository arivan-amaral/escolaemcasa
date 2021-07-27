<?php
  include 'seguranca_aluno.php';

  include "cabecalho.php";
  include "alertas.php";
  include "barra_horizontal.php";

  include 'menu.php';

  include '../Controller/Conversao.php';

  include '../Model/Conexao.php';

  include '../Model/Aluno.php';
  $idescola=$_SESSION['escola_id'];
  $idturma=$_SESSION['turma_id'];
?>



<script src="ajax.js?<?php echo rand(1,100); ?>"></script>

 

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

              echo "  ".$_SESSION['nome'];  

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

    <section class="content">

      <div class="container-fluid">

        <!-- Info boxes -->



        <!-- .row -->

        

    <div class="row">

               <!-- .row -->

          <div class="col-md-1"></div>

          <div class="col-md-10">

            <?php 

              $res_dados_aluno=dados_aluno($conexao,$idaluno);

              $cont=0;

              foreach ($res_dados_aluno as $key => $value) {

                

                $nome=$value['nome'];

                $imagem=$value['foto'];

                



                  echo "<!-- Widget: user widget style 1 -->

                      <div class='card card-widget widget-user shadow-lg'>

                        <!-- Add the bg color to the header using any of the bg-* classes -->

                        <div class='widget-user-header text-white' style='background: url(imagens/fundo.jpg)'>



                          <h3 class='widget-user-username text-right'>$nome</h3>

                          <h5 class='widget-user-desc text-right'>".$_SESSION['cargo']." </h5>

                        </div>



                        <div class='widget-user-image'>

                          <img class='img-circle' src='fotos/$imagem' alt='Minha foto de perfil' >

                        </div>

                        <div class='card-footer'>

                          

                            

                         <!--    <ul class='nav flex-column'>

                                            <li class='nav-item'>

                                              <a href='#' class='nav-link'>

                                                Prova ou Teste Disponível<span class='float-right badge bg-primary'>0</span>

                                              </a>

                                            </li>

                                            

                                            <li class='nav-item'>

                                              <a href='#' class='nav-link'>

                                                Vídeos não Assistidos <span class='float-right badge bg-danger'>0</span>

                                              </a>

                                            </li>

                                            <li class='nav-item'>

                                              <a href='#' class='nav-link'>

                                                Trabalhos/Atividades não Entregues <span class='float-right badge bg-danger'>0</span>

                                              </a>

                                            </li>

                                          </ul>

                            

                      

                          /.row -->

                        </div>

                      </div>

                      ";

                $cont++;

              }



              if ($cont==0) {

                   

                  echo "<!-- Widget: user widget style 1 -->

                      <div class='card card-widget widget-user shadow-lg'>

                        <!-- Add the bg color to the header using any of the bg-* classes -->

                        <div class='widget-user-header text-white' style='background: url(imagens/fundo.jpg)'>



                          <h3 class='widget-user-username text-right'>".$_SESSION['nome']."</h3>

                          <h5 class='widget-user-desc text-right'>Aluno(a) </h5>

                        </div>

 

                        <div class='widget-user-image'>

                          <img class='img-circle' src='fotos/user.png' alt='User Avatar'>

                        </div>

                        <div class='card-footer'>


                         <!--    <ul class='nav flex-column'>

                                            <li class='nav-item'>

                                              <a href='#' class='nav-link'>

                                                Prova ou Teste Disponível<span class='float-right badge bg-primary'>0</span>

                                              </a>

                                            </li>

                                            

                                            <li class='nav-item'>

                                              <a href='#' class='nav-link'>

                                                Vídeos não Assistidos <span class='float-right badge bg-danger'>0</span>

                                              </a>

                                            </li>

                                            <li class='nav-item'>

                                              <a href='#' class='nav-link'>

                                                Trabalhos/Atividades não Entregues <span class='float-right badge bg-danger'>0</span>

                                              </a>

                                            </li>

                                          </ul>

                            

                      

                          /.row -->

                        </div>

                      </div>

                      ";

                  }





            ?>

                      

            </div>

        

    </div>



    <div class="row">
      <div class="col-md-12">




 <div class="row">
                  <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-info">

                    <a href="mural.php" class="small-box-footer">
                      <div class="inner">
                        <h3>Mural</h3>

                        
                      </div>
                      <div class="icon">
                        <i class="fas fa-tag"></i>
                      </div>
                        Ver sobre isso <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>



                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-success">
                      <a href="chat.php" class="small-box-footer">
                      <div class="inner">
                        <h3>Bate papo</h3>
                        <h3></h3>
                        <script type="text/javascript">
                              setInterval("chat_receber();",5000);
                        </script>
                      
                      </div>
                      <div class="icon">
                        <i class="far fa-comment"></i>
                      </div>
                      
                        Ver sobre isso <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-warning">
                      <a href="video_nao_visualizado.php" class="small-box-footer">

                      <div class="inner">
                        <h3>Vídeos 
                          <?php
                            $res_pendencia_v=$conexao->query("SELECT * FROM video WHERE escola_id=$idescola and id_turma=$idturma");
                            $cont_video=0;
                            foreach ($res_pendencia_v as $key => $value) {
                              $idvideo=$value['id'];
                              $res_v=$conexao->query("SELECT * FROM visualizacao_video WHERE video_id=$idvideo and aluno_id=$idaluno limit 1");
                             
                              $cont_v=0;
                              foreach ($res_v as $key => $value) {
                                $cont_v++;
                              }
                              if ($cont_v==0) {
                                $cont_video=$cont_video + 1;
                              }
                          }
                          // echo $cont_video;                                  

                          ?>

                        </h3>

                        
                      </div>
                      <div class="icon">
                        <i class="fas fa-video"></i>
                      </div>
                        Ver sobre isso <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-danger">
                      <a href="trabalho_nao_respondido.php" class="small-box-footer">

                      <div class="inner">
                        <h3>
                          Trabalhos 
                          <?php
                            $res_pendencia=$conexao->query("SELECT * FROM trabalho WHERE escola_id=$idescola and turma_id=$idturma");
                            $cont_trabalho=0;
                            foreach ($res_pendencia as $key => $value) {
                              $idtrabalho=$value['id'];
                              $res=$conexao->query("SELECT * FROM trabalho_entregue WHERE trabalho_id=$idtrabalho  and aluno_id=$idaluno  limit 1");
                             
                              $cont=0;
                              foreach ($res as $key => $value) {
                                $cont++;
                              }
                              if ($cont==0) {
                                $cont_trabalho=$cont_trabalho+ 1;
                              }
                          }
                                                           

                          ?>
                        </h3>

                        
                      </div>
                      <div class="icon">
                        <i class="fa fa-book"></i>
                      </div>
                        Veja sobre isso <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>
                  <!-- ./col -->
                </div>










      </div>
  </div>


    <div class="row">

        <div class="col-md-1"></div>

        <div class="col-md-10">

                    <div class="card">

                      <div class="card-header">

                        <h3 class="card-title">Clique na disciplina desejada</h3>

                      </div>

                      <!-- /.card-header -->

                      <div class="card-body">

                        <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->

                        <div id="accordion">



                          <?php 

                            $result=listar_disciplina_aluno($conexao,$idaluno);

                            foreach ($result as $key => $value) {

                              $disciplina=($value['nome_disciplina']);

                              $nome_professor=($value['nome_professor']);

                              $iddisciplina=$value['iddisciplina'];

                              $idturma=$value['idturma'];

                              $turma=($value['nome_turma']);



                              echo "

                              <div class='card card-primary'>

                                <div class='card-header'>

                                  <h4 class='card-title w-100'>



                                    <a class='d-block w-100 collapsed' data-toggle='collapse' href='#collapseOne$iddisciplina' aria-expanded='false'>

                                     $nome_professor - <b class='text-warning'> $disciplina</b>

                                      <i class='right fas fa-angle-left'></i>

                                    </a>

                                  </h4>

                                </div>

                                <div id='collapseOne$iddisciplina' class='collapse' data-parent='#accordion' style=''>

                                  <div class='card-body'>

                                      

                                      <a class='btn btn-info btn-block btn-flat'

                                       href='videoaulas.php?disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina' >



                                        <font style='vertical-align: inherit;'>

                                          <font style='vertical-align: inherit;'> 

                                              <i class='fa fa-play'></i>

                                                Ver Videoaulas     

                                            </font>

                                        </font>

                                      </a> 



                                      <a class='btn btn-info btn-block btn-flat'

                                       href='link_video_chamada.php?disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina' >



                                        <font style='vertical-align: inherit;'>

                                          <font style='vertical-align: inherit;'> 

                                              <ion-icon name='link'></ion-icon>

                                                Link de vídeo chamadas

                                            </font>

                                        </font>

                                      </a> 


                                      <a  href='trabalhos.php?disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina' class='btn btn-info btn-block btn-flat'>

                                              <i class='fa fa-book'></i>

                                                Trabalhos/Atividades                                           

                                      </a> 



                                      <a  href='responder_questionario.php?disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina' class='btn btn-info btn-block btn-flat'>

                                              <i class='fa fa-edit'></i>

                                                Prova/Testes                                           

                                      </a>                                      

                                      

                                       <a   href='material_apoio.php?iddisciplina=$iddisciplina&idturma=$idturma&nome_disciplina=$disciplina&nome_turma=$turma' class='btn btn-info btn-block btn-flat'>
                                        <ion-icon name='document-text'></ion-icon> 
                                        MATERIAL DE APOIO
                                      </a> 

                                        

                                  </div>

                                </div>

                              </div>

                              ";

                            }

                           ?>

                              



                        </div>

                      </div>



                      <!-- /.card-body -->

                    </div>

                    <!-- /.card -->

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