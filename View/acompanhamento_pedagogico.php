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

  include '../Model/Aluno.php';
  include '../Model/Professor.php';

  $idescola=$_GET['idescola']; 
  $idturma=$_GET['turm']; 
  $iddisciplina=$_GET['disc']; 
  $idserie=$_GET['idserie']; 
 $array_url=explode('p?', $_SERVER["REQUEST_URI"]);
 $url_get=$array_url[1];
?>



<script src="ajax.js?<?php echo rand(); ?>"></script>



<div class="content-wrapper" style="min-height: 529px;">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-12 alert alert-secondary text-center">

            <h1 class="m-0"><b> ÁREA DE RIGISTRO DE OCORRÊNCIAS</b></h1>

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
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <button class="btn btn-block btn-lg btn-secondary"><?php

            $nome_turma='';
            $nome_disciplina='';
            if (isset($_GET['turma'])) {
              $nome_turma=$_GET['turma'];
            } 
            if (isset($_GET['disciplina'])) {
               $nome_disciplina=$_GET['disciplina'];

            }

             echo $nome_turma ." - ". $nome_disciplina; ?></button>
        </div>
      </div>
      <br>
      <br>


      
           <!-- ################################################################################# -->

                  <?php
                  echo "<div class='row'>
                    <div class='col-lg-3 col-6'>
                      <!-- small card -->
                      <div class='small-box bg-info'>
                        <div class='inner'>
                          <h3></h3>

                          <p></p>
                        </div>
                        <div class='icon'>

                        </div>
                        <a  href='cadastrar_conteudo.php?disc=$iddisciplina&turm=$idturma&turma=$nome_turma&disciplina=$nome_disciplina&idescola=$idescola&idserie=$idserie' class='small-box-footer' target='_blanck'>
                          Conteúdo <ion-icon name='document-text'></ion-icon>
                        </a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class='col-lg-3 col-6'>
                      <!-- small card -->
                      <div class='small-box bg-success'>
                        <div class='inner'>
                          <h3> </h3>

                          <p></p>
                        </div>
                        <div class='icon'>
                          <i class='ion ion-stats-bars'></i>
                        </div>
                        <a href='diario_frequencia.php?disc=$iddisciplina&turm=$idturma&turma=$nome_turma&disciplina=$nome_disciplina&idescola=$idescola&idserie=$idserie' class='small-box-footer' target='_blanck'>
                          Frequência <i class='fa fa-calendar'></i>
                        </a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class='col-lg-3 col-6'>
                      <!-- small card -->
                      <div class='small-box bg-secondary'>
                        <div class='inner'>
                          <h3></h3>

                          <p> </p>
                        </div>
                        <div class='icon'>

                        </div>
                        <a  href='acompanhamento_pedagogico.php?disc=$iddisciplina&turm=$idturma&turma=$nome_turma&disciplina=$nome_disciplina&idescola=$idescola&idserie=$idserie' class='small-box-footer' target='_blanck'>
                          Ocorrência  <ion-icon name='bookmark-outline'></ion-icon>
                        </a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class='col-lg-3 col-6'>
                      <!-- small card -->
                      <div class='small-box bg-danger'>
                        <div class='inner'>
                          <h3></h3>

                          <p></p>
                        </div>
                        <div class='icon'>

                        </div>
                        <a  href='diario_avaliacao.php?disc=$iddisciplina&turm=$idturma&turma=$nome_turma&disciplina=$nome_disciplina&idescola=$idescola&idserie=$idserie' class='small-box-footer' target='_blanck'>
                          Avaliação <i class='fas fa-chart-pie'></i>
                        </a>
                      </div>
                    </div>

                  </div>


                  
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

                                             echo " <a class='btn btn-secondary btn-block btn-flat' href='boletim.php?idescola=$idescola&idturma=$idturma&disciplina=$nome_disciplina&idescola=$idescola&idserie=$idserie&tokem_teste=reee' >
                                                    <font style='vertical-align: inherit;'>
                                                     <font style='vertical-align: inherit;'> 
                                                       <i class='fa fa-calendar'></i>
                                                        BOLETIM
                                                        </font>
                                                      </font>
                                              </a>                                       


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
                                          <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                      </div> 
                                                                    

                                  </div>";
                  ?>  
      <!-- ################################################################################# -->

       
  <form action="../Controller/Cadastrar_ocorrencia.php" method="post">
      <div class="row">
        <div class="col-sm-1"></div>
        
        <div class="col-sm-5">
          <div class="form-group">
            <label for="exampleInputEmail1">Data da ocorrência</label>
            <input type="date" class="form-control" name="data_ocorrencia" id="data_ocorrencia" required="" onchange="lista_ocorrencia_aluno();">
          </div>
        </div>   

        <div class="col-sm-5">
          <div class="form-group">
            <label for="exampleInputEmail1">Datas das ocorrências</label>

            <select class="form-control" name="data_ocorrencia_lancada" id='data_ocorrencia_lancada' onchange='lista_ocorrencia_aluno();'>
              <option></option>
              <?php 
                $resultado=listar_ocorrencia_cadastrado($conexao, $iddisciplina, $idturma, $idescola, $idprofessor);
                foreach ($resultado as $key => $value) {
                  $data_ocorrencia=$value['data_ocorrencia'];
                  echo"<option value='$data_ocorrencia'>".converte_data($data_ocorrencia)."</option>";
                  
                }

               ?>
            </select>
          </div>
        </div>

      </div>


  <div class="row" id="listagem_ocorrencia">


  </div>

   
<input type="hidden" name="url_get" value="<?php echo $url_get; ?>">

<input type="hidden" name="idescola" id="idescola" value="<?php echo $idescola; ?>">
<input type="hidden" name="idturma" id="idturma" value="<?php echo $idturma; ?>">
<input type="hidden" name="iddisciplina" id="iddisciplina" value="<?php echo $iddisciplina; ?>">

      <div class="row" id="botao_continuar">
        
      </div>
      
 </form>
        <!-- Main row -->

        <!-- /.row -->

      </div>





    </div>

  </section>

</div>


 <?php 

    include 'rodape.php';

 ?>