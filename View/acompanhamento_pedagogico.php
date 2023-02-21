<?php 
session_start();
if (!isset($_SESSION['idprofessor'])) {
       header("location:index.php?status=0");

}else{

  $idprofessor=$_SESSION['idprofessor'];

}
  include_once "cabecalho.php";
  include_once "alertas.php";
  include_once "barra_horizontal.php";

  include_once 'menu.php';

  include_once '../Controller/Conversao.php';

  include_once '../Model/Conexao.php';

  include_once '../Model/Aluno.php';
  include_once '../Model/Professor.php';

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

            <h1 class="m-0"><b> ÁREA DE REGISTRO DE OCORRÊNCIAS</b></h1>

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


                  
                                    ";
                  ?>  
      <!-- ################################################################################# -->

       
  <form action="../Controller/Cadastrar_ocorrencia.php" method="post">
      <div class="row">
        <div class="col-sm-1"></div>
        
        <div class="col-sm-5">
          <div class="form-group">
            <label for="exampleInputEmail1">Data da ocorrência</label>
            <input type="date" class="form-control" name="data_ocorrencia" id="data_ocorrencia" required="" min="<?php echo $_SERVER['ano_letivo']."01-01"; ?>" max="<?php echo $_SERVER['ano_letivo']."12-31"; ?>" onchange="verifica_dia_letivo('data_ocorrencia');lista_ocorrencia_aluno();">
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

    include_once 'rodape.php';

 ?>