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





                      echo "

                          <div class='card card-widget widget-user shadow-lg'>

                          

                            <div class='widget-user-header text-white' style='background: url(imagens/fundo.jpg);'>

                              <h3 class='widget-user-username text-right'>$nome</h3>

                              <h5 class='widget-user-desc text-right'>Professor(a) </h5>

                            </div>



                            <div class='widget-user-image'>

                              <img class='img-circle' src='fotos/$imagem' alt='User Avatar'>

                            </div>

                            <div class='card-footer'>

     

                            </div>

                          </div>

                          ";
                          $cont++;

                  }



                  if ($cont==0) {

                       

                      echo "<!-- Widget: user widget style 1 -->

                          <div class='card card-widget widget-user shadow-lg'>

                            <!-- Add the bg color to the header using any of the bg-* classes -->

                            <div class='widget-user-header text-white' style='background: url(imagens/fundo.jpg);'>



                              <h3 class='widget-user-username text-right'>".$_SESSION['nome']."</h3>

                              <h5 class='widget-user-desc text-right'>Professor(a) </h5>

                            </div>



                            <div class='widget-user-image'>

                              <img class='img-circle' src='fotos/user.png' alt='User Avatar'>

                            </div>

                            <div class='card-footer'>


                           

                          


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

                            $result=listar_disciplina_professor($conexao,$idprofessor);



                            foreach ($result as $key => $value) {

                              $disciplina=($value['nome_disciplina']);
                              $nome_escola=($value['nome_escola']);
                              $idescola=($value['idescola']);
                              $iddisciplina=$value['iddisciplina'];
                              $idturma=$value['idturma'];
                              $turma=($value['nome_turma']);
                              $idserie=$value['serie_id'];



                              echo "

                              <div class='card card-primary'>

                                <div class='card-header'>

                                  <h4 class='card-title w-100'>



                                    <a class='d-block w-100 collapsed' data-toggle='collapse' href='#collapseOne$iddisciplina$idturma$idescola' aria-expanded='false'><b class='text-warning'> $nome_escola -></b>". ($turma) ." - ".

                                      ($disciplina)

                                      ."  <i class='right fas fa-angle-left'></i>

                                    </a>

                                  </h4>

                                </div>

                                <div id='collapseOne$iddisciplina$idturma$idescola' class='collapse' data-parent='#accordion' style=''>

                                  <div class='card-body'>
    

                                   <a   href='listar_alunos_da_turma_professor.php?iddisciplina=$iddisciplina&idturma=$idturma&nome_disciplina=$disciplina&nome_turma=$turma&idescola=$idescola&idserie=$idserie' class='btn btn-info btn-block btn-flat'>
                                     <i class='fa fa-users'></i> 
                                     Lista de alunos
                                   </a>      
                                      


                                   <a class='btn btn-info btn-block btn-flat'

                                       href='cadastrar_mural.php?disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina&idescola=$idescola&idserie=$idserie' >



                                        <font style='vertical-align: inherit;'>

                                          <font style='vertical-align: inherit;'> 

                                              <ion-icon name='megaphone'></ion-icon>

                                                Mural     

                                            </font>

                                        </font>

                                      </a> 

                                
                                <a class='btn btn-info btn-block btn-flat'

                                       href='cadastro_video.php?disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina&idescola=$idescola&idserie=$idserie' >



                                        <font style='vertical-align: inherit;'>

                                          <font style='vertical-align: inherit;'> 

                                              <i class='fa fa-play'></i>

                                                Videoaulas     

                                            </font>

                                        </font>

                                      </a> 

                                      <!-- <a class='btn btn-info btn-block btn-flat'

                                       href='cadastrar_link_video_chamada.php?disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina&idescola=$idescola&idserie=$idserie' >



                                        <font style='vertical-align: inherit;'>

                                          <font style='vertical-align: inherit;'> 

                                              <ion-icon name='link'></ion-icon>

                                                Link de vídeo chamadas

                                            </font>

                                        </font>

                                      </a> 
                                        -->





                                      <a  href='cadastrar_questionario.php?disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina&idescola=$idescola&idserie=$idserie' class='btn btn-info btn-block btn-flat'>

                                              <i class='fa fa-edit'></i>

                                                Prova/Testes                                           

                                      </a>

                                      <a  href='cadastro_trabalho.php?disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina&idescola=$idescola&idserie=$idserie' class='btn btn-info btn-block btn-flat'>

                                              <i class='fa fa-book'></i>

                                                Trabalhos/Atividades                                           

                                      </a> 

                                      
                                      <a  href='resultado_questionario.php?disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina&idescola=$idescola&idserie=$idserie' class='btn btn-info btn-block btn-flat'>

                                              <ion-icon name='eye'></ion-icon>

                                                Acompanhar Prova/Testes                                           

                                      </a> 


                                      <!--
                                      <a  href='responder_questionario.php?disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina&idescola=$idescola&idserie=$idserie' class='btn btn-info btn-block btn-flat'>

                                              <i class='fas fa-chart-pie mr-1'></i>

                                                Cadastrar Relatório de Provas                                          

                                      </a>
                                       -->

                                    

                                     
                                      <a   href='cadastro_material_apoio.php?disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina&idescola=$idescola&idserie=$idserie' class='btn btn-info btn-block btn-flat'>
                                       <ion-icon name='document-text'></ion-icon> 
                                       MATERIAL DE APOIO
                                     </a> 

                                     <a class='btn btn-info btn-block btn-flat'

                                            href='#' onclick=alert('chat desabilitado');>



                                             <font style='vertical-align: inherit;'>

                                               <font style='vertical-align: inherit;'> 

                                                   <i class='fas fa-comments'></i>

                                                     Chat da turma     

                                                 </font>

                                             </font>

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