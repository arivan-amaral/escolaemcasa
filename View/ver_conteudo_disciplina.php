<?php
session_start();


if (!isset($_SESSION['idfuncionario'])) {
    header("location: index.php?status=0");
    exit();
} else if (isset($_GET['idprofessor'])) {
    // código...
    $idfuncionario = $_GET['idprofessor'];
} else {
    $idfuncionario = $_SESSION['idfuncionario'];
}


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
  include_once '../Model/Video.php';
  include_once '../Controller/Conversao.php';




  $idturma=$_GET['idturma'];

  $iddisciplina=$_GET['iddisciplina'];
  
  $idescola=$_GET['idescola'];
  $idserie=$_GET['idserie'];
  $nome_turma=$_GET['nome_turma'];
  $nome_disciplina=$_GET['nome_disciplina'];

  

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



<section class="content">
    <div class="container-fluid">







        

    <div class="row">

        <div class="col-md-1"></div>



        <div class="col-md-10">

                    <div class="card">

                      <div class="card-header">

                        <!-- <h3 class="card-title">Clique na Disciplina Desejada</h3> -->

                      </div>

                      <!-- /.card-header -->

                      <div class="card-body">

                        <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->

                        <div id="accordion">



                          <?php 
                            if ( $_SESSION["cargo"] == 'Secretário') {
                  

                           echo "

                           <div class='card card-secondary'>

                           <div class='card-header'>

                           <h4 class='card-title w-100'>
                           <a class='d-block w-100 collapsed' data-toggle='collapse show' href='#collapseOne$iddisciplina$idturma$idescola' aria-expanded='true'><b class='text-warning'></b> VER CONTEÚDO - $nome_turma - $nome_disciplina

                           </a>

                           </h4>

                           </div>

                           <div id='collapseOne$iddisciplina$idturma$idescola' class='collapse show' data-parent='#accordion' style=''>

                           <div class='card-body'>


                           <a   href='listar_alunos_da_turma.php?iddisciplina=$iddisciplina&idturma=$idturma&idescola=$idescola&idserie=$idserie' class='btn btn-secondary btn-block btn-flat'>
                           <i class='fa fa-users'></i> 
                           Lista de alunos
                           </a> 


                                <a class='btn btn-danger btn-block btn-flat'
                                  href='diario_avaliacao.php?disc=$iddisciplina&turm=$idturma&turma=$nome_turma&disciplina=$nome_disciplina&idescola=$idescola&idserie=$idserie&funcionario=secretaria' target='_blank'>
                                   <font style='vertical-align: inherit;'>
                                     <font style='vertical-align: inherit;'> 
                                         <ion-icon name='stats-chart-outline'></ion-icon>
                                          Diário - Avaliação (alunos da rede)    
                                       </font>
                                   </font>
                                 </a> 



                           <a  href='resultado_questionario.php?disc=$iddisciplina&turm=$idturma&idescola=$idescola&idserie=$idserie' class='btn btn-secondary btn-block btn-flat'>

                                   <ion-icon name='eye'></ion-icon>

                                     Acompanhar Prova/Testes                                           

                           </a> 
                           <br>
                           
                           <a href='parecer_descritivo.php?idturma=$idturma&idescola=$idescola&idserie=$idserie' class='btn btn-secondary btn-block btn-flat'>
                           <i class='fa fa-edit'></i> 
                           PARECER DESCRITIVO
                           </a>
                           <BR>


                           <a   href='diario_rendimento.php?iddisciplina=$iddisciplina&idturma=$idturma&idescola=$idescola&idserie=$idserie&periodo_id=1' class='btn btn-secondary btn-block btn-flat'>
                           <i class='fa fa-calendar'></i> 
                           RESULTADO ANUAL
                           </a>


                           <a   href='impressao_diario_frequencia.php?iddisciplina=$iddisciplina&idturma=$idturma&idescola=$idescola&idserie=$idserie&periodo_id=1' class='btn btn-secondary btn-block btn-flat'>
                           <i class='fa fa-calendar'></i> 
                           FICHA DE RENDIMENTO TRI I
                           </a> 

                           <a   href='impressao_diario_frequencia.php?iddisciplina=$iddisciplina&idturma=$idturma&idescola=$idescola&idserie=$idserie&periodo_id=2' class='btn btn-secondary btn-block btn-flat'>
                           <i class='fa fa-calendar'></i> 
                           FICHA DE RENDIMENTO TRI II
                           </a>   
                           <a   href='impressao_diario_frequencia.php?iddisciplina=$iddisciplina&idturma=$idturma&idescola=$idescola&idserie=$idserie&periodo_id=3' class='btn btn-secondary btn-block btn-flat'>
                           <i class='fa fa-calendar'></i> 
                           FICHA DE RENDIMENTO TRI III
                           </a>   

                          

                      






                           </div>

                           </div>

                           </div>

                           ";











                            }else{

                              echo "

                              <div class='card card-secondary'>

                                <div class='card-header'>

                                  <h4 class='card-title w-100'>



                                    <a class='d-block w-100 collapsed' data-toggle='collapse show' href='#collapseOne$iddisciplina$idturma$idescola' aria-expanded='true'><b class='text-warning'></b> VER CONTEÚDO - $nome_turma - $nome_disciplina

                                    </a>

                                  </h4>

                                </div>

                                <div id='collapseOne$iddisciplina$idturma$idescola' class='collapse show' data-parent='#accordion' style=''>

                                  <div class='card-body'>
    
                                
                                   <a   href='listar_alunos_da_turma.php?iddisciplina=$iddisciplina&idturma=$idturma&idescola=$idescola&idserie=$idserie' class='btn btn-info btn-block btn-flat'>
                                     <i class='fa fa-users'></i> 
                                     Lista de alunos
                                   </a>      
                           



                                <a class='btn btn-primary btn-block btn-flat'
                                  href='diario_avaliacao.php?disc=$iddisciplina&turm=$idturma&turma=$nome_turma&disciplina=$nome_disciplina&idescola=$idescola&idserie=$idserie&funcionario=secretaria' target='_blank'>
                                   <font style='vertical-align: inherit;'>
                                     <font style='vertical-align: inherit;'> 
                                         <ion-icon name='stats-chart-outline'></ion-icon>
                                          Diário - Avaliação (alunos da rede)    
                                       </font>
                                   </font>
                                 </a> 



                                <a class='btn btn-danger btn-block btn-flat'
                                  href='cadastrar_conteudo.php?idprofessor=$idfuncionario&disc=$iddisciplina&turm=$idturma&turma=$nome_turma&disciplina=$nome_disciplina&idescola=$idescola&idserie=$idserie&funcionario=secretaria' target='_blank'>
                                   <font style='vertical-align: inherit;'>
                                     <font style='vertical-align: inherit;'> 
                                         <ion-icon name='stats-chart-outline'></ion-icon>
                                          Cadastrar Conteúdo (alunos da rede)    
                                       </font>
                                   </font>
                                 </a> 


                                <a class='btn btn-info btn-block btn-flat'

                                       href='video_aula_disciplina_coordenado.php?disc=$iddisciplina&turm=$idturma&idescola=$idescola&idserie=$idserie' >



                                        <font style='vertical-align: inherit;'>

                                          <font style='vertical-align: inherit;'> 

                                              <i class='fa fa-play'></i>

                                                Videoaulas     

                                            </font>

                                        </font>

                                      </a> 


                           <a  href='resultado_questionario.php?disc=$iddisciplina&turm=$idturma&idescola=$idescola&idserie=$idserie' class='btn btn-info btn-block btn-flat'>

                                   <ion-icon name='eye'></ion-icon>

                                     Acompanhar Prova/Testes                                           

                           </a> 
                           

                           <a href='parecer_descritivo.php?idturma=$idturma&idescola=$idescola&idserie=$idserie' class='btn btn-secondary btn-block btn-flat'>
                           <i class='fa fa-edit'></i> 
                           PARECER DESCRITIVO
                           </a>
                           
                                   <a   href='diario_rendimento.php?iddisciplina=$iddisciplina&idturma=$idturma&idescola=$idescola&idserie=$idserie&periodo_id=1' class='btn btn-info btn-block btn-flat'>
                                     <i class='fa fa-calendar'></i> 
                                     RESULTADO ANUAL
                                   </a>


                                   <a   href='impressao_diario_frequencia.php?iddisciplina=$iddisciplina&idturma=$idturma&idescola=$idescola&idserie=$idserie&periodo_id=1' class='btn btn-info btn-block btn-flat'>
                                     <i class='fa fa-calendar'></i> 
                                     FICHA DE RENDIMENTO TRI I
                                   </a> 

                                   <a   href='impressao_diario_frequencia.php?iddisciplina=$iddisciplina&idturma=$idturma&idescola=$idescola&idserie=$idserie&periodo_id=2' class='btn btn-info btn-block btn-flat'>
                                     <i class='fa fa-calendar'></i> 
                                     FICHA DE RENDIMENTO TRI II
                                   </a>   
                                   <a   href='impressao_diario_frequencia.php?iddisciplina=$iddisciplina&idturma=$idturma&idescola=$idescola&idserie=$idserie&periodo_id=3' class='btn btn-info btn-block btn-flat'>
                                     <i class='fa fa-calendar'></i> 
                                     FICHA DE RENDIMENTO TRI III
                                   </a>      
                                      








                                      <a  href='ver_trabalho_coordenador.php?turma=$nome_turma&disciplina=$nome_disciplina&disc=$iddisciplina&turm=$idturma&idescola=$idescola&idserie=$idserie' class='btn btn-info btn-block btn-flat'>

                                              <i class='fa fa-book'></i>

                                                Trabalhos/Atividades                                           

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


 <?php 

    include_once 'rodape.php';

 ?>