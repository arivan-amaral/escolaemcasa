<?php
session_start();
if (!isset($_COOKIE['conteudo'])) {
  setcookie('conteudo', 1, (time()+(300*24*3600)));
}else{

  if ($_COOKIE['conteudo']<5) {
   setcookie('conteudo', $_COOKIE['conteudo']+1);

      echo"<script type='text/javascript'>

        function modal_ajuda() {
            $(document).ready(function() {
                $('#modal-conteudo').modal('show');
              });
        }

        setTimeout('modal_ajuda();',500);
        
      </script>";
  }
}
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

              echo $_SESSION['idfuncionario']." - ".$_SESSION['nome'];  

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



                              <h3 class='widget-user-username text-right'>".$_SESSION['nome']." </h3>

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

                        <h3 class="card-title">Clique na disciplina desejada</h3>

                      </div>

                      <!-- /.card-header -->

                      <div class="card-body">

                        <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->

                        <div id="accordion">


                                  <a  href='cadastrar_questionario.php' class='btn btn-danger btn-block btn-flat'>

                                            <i class='fa fa-edit'></i>

                                              Provas                                           

                                    </a>
                                    <br>


                          <?php 

                            $result=listar_disciplina_professor($conexao,$idprofessor);


                            $conta=0;
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

                                  <h4 class='card-title w-100'>";

                                   echo " <a class='d-block w-100 collapsed' data-toggle='collapse' href='#collapseOne$iddisciplina$idturma$idescola' aria-expanded='false'><b class='text-warning'> $nome_escola -></b>". ($turma) ." - ".

                                      ($disciplina)

                                      ."  <i class='right fas fa-angle-left'></i>

                                    </a>

                                  </h4>

                                </div>

                                <div id='collapseOne$iddisciplina$idturma$idescola' class='collapse' data-parent='#accordion' style=''>

                                  <div class='card-body'>
    

                                   <a   href='listar_alunos_da_turma_professor.php?iddisciplina=$iddisciplina&turma=$turma&disciplina=$disciplina&idturma=$idturma&nome_disciplina=$disciplina&nome_turma=$turma&idescola=$idescola&idserie=$idserie' class='btn btn-info btn-block btn-flat'>
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

                                      <!-- -->
                                      <a class='btn btn-info btn-block btn-flat'

                                       href='cadastrar_link_video_chamada.php?disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina&idescola=$idescola&idserie=$idserie' >



                                        <font style='vertical-align: inherit;'>

                                          <font style='vertical-align: inherit;'> 

                                              <ion-icon name='link'></ion-icon>

                                                Link de vídeo chamadas

                                            </font>

                                        </font>

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

                                            href='acompanhamento_pedagogico.php?disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina&idescola=$idescola&idserie=$idserie' >



                                             <font style='vertical-align: inherit;'>

                                               <font style='vertical-align: inherit;'> 

                                                   <ion-icon name='clipboard-outline'></ion-icon>
                                                    Ocorrências (acompanhamento pedagógico)    

                                                 </font>

                                             </font>

                                           </a> 

                                     <a class='btn btn-info btn-block btn-flat'

                                            href='diario_frequencia.php?disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina&idescola=$idescola&idserie=$idserie' >



                                             <font style='vertical-align: inherit;'>

                                               <font style='vertical-align: inherit;'> 

                                                   <i class='fa fa-calendar'></i>

                                                    Diário - Frequência e conteúdo   

                                                 </font>

                                             </font>

                                           </a> 

                                     <a class='btn btn-info btn-block btn-flat'

                                            href='diario_avaliacao.php?disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina&idescola=$idescola&idserie=$idserie' >



                                             <font style='vertical-align: inherit;'>

                                               <font style='vertical-align: inherit;'> 

                                                   <ion-icon name='stats-chart-outline'></ion-icon>

                                                    Diário - Avaliação    

                                                 </font>

                                             </font>

                                           </a> 




                                      <a class='btn btn-info btn-block btn-flat' href='chat_professor.php?escola_id=$idescola&turma_id=$idturma' onclick=alert('chat desabilitado');>
                                            <font style='vertical-align: inherit;'>
                                             <font style='vertical-align: inherit;'> 
                                                <i class='fas fa-comments'></i>
                                                  Chat da turma
                                                </font>
                                              </font>
                                      </a>

                                        <br>
                                        <div class='col-sm-12'>
                                          <div class='card card-secondary collapsed-card'>
                                            <div class='card-header' data-card-widget='collapse'>
                                              <h3 class='card-title'>RESULTADOS/CONTEÚDOS</h3>

                                              <div class='card-tools'>
                                                <button type='button' class='btn btn-tool' data-card-widget='collapse'>
                                                  <i class='fas fa-plus'></i>
                                                </button>
                                              </div>
                                              <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class='card-body' style='display: none;'>
        
                                              <a href='diario_conteudo.php?idturma=$idturma&idescola=$idescola&idserie=$idserie' class='btn btn-secondary btn-block btn-flat'>
                                              <i class='fa fa-edit'></i> 
                                              CONTEÚDOS DE AULAS
                                              </a>";
                                              
                                                if ($idserie<3) {
                                                  echo "<a href='parecer_descritivo.php?idturma=$idturma&idescola=$idescola&idserie=$idserie' class='btn btn-secondary btn-block btn-flat'>
                                                  <i class='fa fa-edit'></i> 
                                                  PARECER DESCRITIVO
                                                  </a>"; 
                                                }

                                             echo " <a class='btn btn-secondary btn-block btn-flat' href='boletim.php?idescola=$idescola&idturma=$idturma&disciplina=$disciplina&idescola=$idescola&idserie=$idserie' onclick=alert('chat desabilitado');>
                                                    <font style='vertical-align: inherit;'>
                                                     <font style='vertical-align: inherit;'> 
                                                       <i class='fa fa-calendar'></i>
                                                        BOLETIM
                                                        </font>
                                                      </font>
                                              </a>                                       


                                              <a   href='diario_rendimento.php?iddisciplina=$iddisciplina&idturma=$idturma&idescola=$idescola&idserie=$idserie&periodo_id=1' class='btn btn-secondary btn-block btn-flat'>
                                              <i class='fa fa-calendar'></i> 
                                              RESULTADO FINAL
                                              </a>


                                              <a   href='diario_frequencia_fund2.php?iddisciplina=$iddisciplina&idturma=$idturma&idescola=$idescola&idserie=$idserie&periodo_id=1' class='btn btn-secondary btn-block btn-flat'>
                                              <i class='fa fa-calendar'></i> 
                                              FICHA DE RENDIMENTO TRI I
                                              </a> 

                                              <a   href='diario_frequencia_fund2.php?iddisciplina=$iddisciplina&idturma=$idturma&idescola=$idescola&idserie=$idserie&periodo_id=2' class='btn btn-secondary btn-block btn-flat'>
                                              <i class='fa fa-calendar'></i> 
                                              FICHA DE RENDIMENTO TRI II
                                              </a>   
                                              <a   href='diario_frequencia_fund2.php?iddisciplina=$iddisciplina&idturma=$idturma&idescola=$idescola&idserie=$idserie&periodo_id=3' class='btn btn-secondary btn-block btn-flat'>
                                              <i class='fa fa-calendar'></i> 
                                              FICHA DE RENDIMENTO TRI III
                                              </a>
                                            </div>
                                          <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                      </div> 
                                                                    

                                  </div>

                                </div>

                              </div>

                              ";
$conta++;
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




  <style>
   #imagem_whats{position:fixed;right:0;bottom:0;display:block;cursor:pointer;z-index:9999999;float:right}
   #imagem_whats2{position:fixed;right:0;bottom:0;display:block;cursor:pointer;z-index:9999999;float:right;display:none} @media only screen and (max-width: 999px) and (min-width: 100px){#imagem_whats{display:none}#imagem_whats2{display:block}}</style>

  <img id="imagem_whats" src="https://www.ellodigital.com.br/images/whatsapp.png" onClick="window.open('https://web.whatsapp.com/send?phone=+557799323906&amp;text=OLÁ, PODE ME AJUDAR COM A PLATAFORMA EDUCA LEM?!', '_blank');">

  <img id="imagem_whats2" src="https://www.ellodigital.com.br/images/whatsapp.png" onClick="window.open('https://api.whatsapp.com/send?phone=+557799323906&amp;text=OLÁ, PODE ME AJUDAR COM A PLATAFORMA EDUCA LEM?!', '_blank');"><div class="preloader"> <div class="preloaderimg"></div></div>


  <div class="modal fade" id="modal-conteudo">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">AVISO! <?php echo $_COOKIE['conteudo']; ?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <div class="modal-body">
         <!-- INICIO CORPO -->
      
         <div class="row">

          <div class="col-md-12">



            <div class="card card-default">
              <div class="card-header callout callout-danger">
                <h3 class="card-title">
                  <i class="fas fa-bullhorn"></i>
                  ATENÇÃO, Melhorias na forma de registro dos conteúdos das aulas, assista o vídeo!
                </h3>
              </div>

              <div class='card-body'>
       <center>

         <!-- <h1>ATENÇÃO, NÃO LANÇAR NOTA ANTES DAS 20:30, <font color="RED">SERVIDOR EM MANUTENÇÃO</font></h1> -->
          <iframe width="380" height="315" src="https://www.youtube.com/embed/ub_1CMDrb8Q" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
       </center>
              </div>


              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>        
        </div>

         <!-- FIM CORPO -->
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

 <?php 

    include 'rodape.php';

 ?>