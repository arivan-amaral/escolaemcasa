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
  include '../Controller/Conversao.php';

  include '../Model/Conexao.php';

  include '../Model/Professor.php';

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

        <!-- Info boxes -->

     

        <div class="row">

                   <!-- .row -->

              <div class="col-md-1"></div>



              <div class="col-md-10">

                <?php 

                  $res_dados_aluno=dados_professor($conexao,$idprofessor);
                  $cont=0;
                  foreach ($res_dados_aluno as $key => $value) {

                    

                    $nome=$value['nome'];

                    $imagem=$value['foto'];





                      echo "<!-- Widget: user widget style 1 -->

                          <div class='card card-widget widget-user shadow-lg'>

                            <!-- Add the bg color to the header using any of the bg-* classes -->

                            <div class='widget-user-header text-white' style='background: url(fotos/fundo.jpg)'>



                              <h3 class='widget-user-username text-right'>$nome</h3>

                              <h5 class='widget-user-desc text-right'>Professor(a) </h5>

                            </div>



                            <div class='widget-user-image'>

                              <img class='img-circle' src='fotos/$imagem' alt='User Avatar'>

                            </div>

                            <div class='card-footer'>

                              

                                

                              <!--

                              <ul class='nav flex-column'>

                                                <li class='nav-item'>

                                                  <a href='#' class='nav-link'>

                                                    Projects <span class='float-right badge bg-primary'>31</span>

                                                  </a>

                                                </li>

                                                <li class='nav-item'>

                                                  <a href='#' class='nav-link'>

                                                    Tasks <span class='float-right badge bg-info'>5</span>

                                                  </a>

                                                </li>

                                                <li class='nav-item'>

                                                  <a href='#' class='nav-link'>

                                                    Completed Projects <span class='float-right badge bg-success'>12</span>

                                                  </a>

                                                </li>

                                                <li class='nav-item'>

                                                  <a href='#' class='nav-link'>

                                                    Followers <span class='float-right badge bg-danger'>842</span>

                                                  </a>

                                                </li>

                                              </ul>

                                               -->

                            </div>

                          </div>

                          ";
                          $cont++;

                  }



                  if ($cont==0) {

                       

                      echo "<!-- Widget: user widget style 1 -->

                          <div class='card card-widget widget-user shadow-lg'>

                            <!-- Add the bg color to the header using any of the bg-* classes -->

                            <div class='widget-user-header text-white' style='background: url(fotos/fundo.jpg)'>



                              <h3 class='widget-user-username text-right'>".$_SESSION['nome']."</h3>

                              <h5 class='widget-user-desc text-right'>Professor(a) </h5>

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





        <!-- .row -->

        

    <div class="row">

        <div class="col-md-1"></div>



        <div class="col-md-10">

                    <div class="card">

                      <div class="card-header">

                        <h3 class="card-title">Clique na Disciplina Desejada</h3>

                      </div>

                      <!-- /.card-header -->

                      <div class="card-body">

                        <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->

                        <div id="accordion">



                          <?php 

                            $result=listar_disciplina_professor($conexao,$idprofessor,$_SESSION['ano_letivo']);



                            foreach ($result as $key => $value) {

                              $disciplina=($value['nome_disciplina']);

                              $iddisciplina=$value['iddisciplina'];

                              $idturma=$value['idturma'];

                              $turma=($value['nome_turma']);



                              echo "

                              <div class='card card-primary'>

                                <div class='card-header'>

                                  <h4 class='card-title w-100'>



                                    <a class='d-block w-100 collapsed' data-toggle='collapse' href='#collapseOne$iddisciplina$idturma' aria-expanded='false'>". ($turma) ." - ".

                                      ($disciplina)

                                      ."  <i class='right fas fa-angle-left'></i>

                                    </a>

                                  </h4>

                                </div>

                                <div id='collapseOne$iddisciplina$idturma' class='collapse' data-parent='#accordion' style=''>

                                  <div class='card-body'>

                                    <a   href='listar_alunos_da_turma_professor.php?iddisciplina=$iddisciplina&idturma=$idturma&nome_disciplina=$nome_disciplina&nome_turma=$nome_turma' class='btn btn-outline-info btn-block btn-flat'>
                                     <i class='fa fa-users'></i> 
                                     LISTAR ALUNOS DA TURMA
                                   </a>      
                                      

                                  <a  href='responder_questionario.php?disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina' class='btn btn-outline-info btn-block btn-flat'>

                                          <i class='fa fa-edit'></i>

                                            Prova/Testes                                           

                                  </a>



                                      <a class='btn btn-outline-info btn-block btn-flat'

                                       href='cadastro_video.php?disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina' >



                                        <font style='vertical-align: inherit;'>

                                          <font style='vertical-align: inherit;'> 

                                              <i class='fa fa-play'></i>

                                                Vídeo Aulas     

                                            </font>

                                        </font>

                                      </a> 





                                      <a  href='cadastro_trabalho.php?disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina' class='btn btn-outline-info btn-block btn-flat'>

                                              <i class='fa fa-book'></i>

                                                Trabalhos/Atividades                                           

                                      </a> 



                                      <a  href='responder_questionario.php?disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina' class='btn btn-outline-info btn-block btn-flat'>

                                              <i class='fas fa-download'></i>

                                                Baixar Prova/Testes                                           

                                      </a>  



                                      <a  href='responder_questionario.php?disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina' class='btn btn-outline-info btn-block btn-flat'>

                                              <i class='fas fa-chart-pie mr-1'></i>

                                                Cadastrar Relatório de Provas                                          

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