<?php 
session_start();
setcookie('video', 1, (time()+(300*24*3600)));
 if (!isset($_COOKIE['video'])) {

    echo"<script type='text/javascript'>
      function modal_video() {
          $(document).ready(function() {
              $('#modal-video').modal('show');
            });
      }

      setTimeout('modal_video();',1000);
      
    </script>";
  $_COOKIE['video']=$_COOKIE['video']+1;
}

if (!isset($_SESSION['idprofessor'])) {
      // header("location:index.php?status=0");

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

  $idserie=$_GET['idserie']; 
  $idescola=$_GET['idescola']; 
  $idturma=$_GET['turm']; 
  $iddisciplina=$_GET['disc']; 
 $array_url=explode('p?', $_SERVER["REQUEST_URI"]);
 $url_get=$array_url[1];
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
             echo "$nome_escola_global"; 

             if (isset($_SESSION['nome'])) {

              echo " ".$_SESSION['nome'];  

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
  <form action="../Controller/Cadastrar_diario_avaliacao_aluno.php" method="post">
          
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
      <div class="row">

        <div class="col-sm-1"></div>
        
        <div class="col-sm-3">
          <div class="form-group">
            <label for="exampleInputEmail1">Data da avaliação</label>
            <input type="date" class="form-control" name="data_avaliacao" id="data_avaliacao" required="">
            <!-- <input type="date" class="form-control" name="data_avaliacao" id="data_avaliacao" onchange='lista_avaliacao_aluno_por_data();' required=""> -->
          </div>
        </div>   

        <div class="col-sm-3">
          <div class="form-group">
            <label for="exampleInputEmail1">Período</label>

            <select class="form-control" id='periodo' name='periodo' onchange='lista_avaliacao_aluno_por_data();'  required="">
              <option></option>
              <?php 
                $resultado=listar_trimestre($conexao);
                foreach ($resultado as $key => $value) {
                  $idperiodo=$value['id'];
                  $descricao=$value['descricao'];
                  echo"<option value='$idperiodo'>$descricao</option>";
                  
                }

               ?>
            </select>
          </div>
        </div>

        <div class="col-sm-2">
          <div class="form-group">
            <label for="exampleInputEmail1">Avaliação/Parecer</label>

            <select class="form-control" id='avaliacao' name='avaliacao' onchange='lista_avaliacao_aluno_por_data();' required="">
              <option></option>
              <option value="DIAGNÓSTICO INICIAL">DIAGNÓSTICO INICIAL</option>
              <option value="av1">AV1 / Parecer</option>
              <option value="av2">AV2 / Parecer</option>
              <option value="av3">AV3 / Parecer</option>
              <option value="RP">RECUPERAÇÃO</option>
             
            </select>
          </div>
        </div>

      </div>


<input type="hidden" name="url_get" id="url_get" value="<?php echo $url_get; ?>">

<input type="hidden" name="idserie" id="idserie" value="<?php echo $idserie; ?>" >
<input type="hidden" name="idescola" id="idescola" value="<?php echo $idescola; ?>">
<input type="hidden" name="idturma" id="idturma" value="<?php echo $idturma; ?>">
<input type="hidden" name="iddisciplina" id="iddisciplina" value="<?php echo $iddisciplina; ?>" readonly>




<!-- ####################################################################### -->


<div class="row">

    <div class="col-md-1"></div>



    <div class="col-md-10">

                <div class="card">

                  <div class="card-header">

                    <h3 class="card-title">AVALIAÇÕES CADASTRADAS</h3>

                  </div>

                  <!-- /.card-header -->

                  <div class="card-body">

                    <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->

                    <div id="accordion">



       

                          <div class='card card-primary'>

                            <div class='card-header'>

                              <h4 class='card-title w-100'>



                                <a class='d-block w-100 collapsed' data-toggle='collapse' href='#collapseOne' aria-expanded='false'><b class='text-warning'>
                                    CLIQUE AQUI PARA VER AS AVALIAÇÕES CADASTRADAS 
                                  </b>

                                </a>

                              </h4>

                            </div>

                            <div id='collapseOne' class='collapse' data-parent='#accordion' style=''>

                              <div class='card-body'>


                          
                                         <table class='table table-primary'>
                                              <thead>
                                                <tr>
                                                  <th style='width: 10px'>#</th>
                                                  <th>Avaliações</th>
                                                  <th>
                                                  Opções
                                                  </th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <?php 
                                                $conta=1;
                                                $array_avaliacao= array('0'=>'av1','1'=>'av2','2'=>'av3','3'=>'av4');
                                          foreach ($array_avaliacao as $key => $value) {
                                                  $avaliacao=$value;
                                                
                                                $resultado=listar_todas_avaliacao_lancada($conexao,$idescola,$idturma,$iddisciplina,$avaliacao);
                                                    foreach ($resultado as $key => $value) {
                                                      $data_nota=$value['data_nota'];
                                                      $turma_id  =$value['turma_id'];
                                                      $disciplina_id  =$value['disciplina_id'];
                                                      $escola_id=$value['escola_id'];
                                                      $avaliacao=$value['avaliacao'];
                                                      $periodo_id=$value['periodo_id'];
                                                      
                                                      echo"
                                                      <tr>
                                                      <td>
                                                      $conta
                                                      
                                                      <input type='hidden' id='data_nota$conta' value='$data_nota'>
                                                      <input type='hidden' id='turma_id$conta' value='$turma_id'>
                                                      <input type='hidden' id='disciplina_id$conta' value='$disciplina_id'>
                                                      <input type='hidden' id='escola_id$conta' value='$escola_id'>
                                                      <input type='hidden' id='avaliacao$conta' value='$avaliacao'>
                                                      <input type='hidden' id='periodo_id$conta' value='$periodo_id'>

                                           
                                                      </td>
                                                        <td>Avaliação $avaliacao - ".converte_data($data_nota)."</td>
                                                        <td><a onclick='excluir_avaliacao($conta);' class='btn btn-danger'>EXCLUIR AVALIAÇÃO</a></td>
                                                        <td>
                                                          <a href='#listaAlunos' onclick='editar_avaliacao_aluno_por_data($conta);' class='btn btn-primary'>EDITAR AVALIAÇÃO</a>
                                                        </td>

                                                      </tr>";
                                                      $conta++;
                                                    }
                                                }

                                              ?>

                                              </tbody>
                                        </table>
              

                            </div>

                          </div>

                               



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


<!-- ####################################################################### -->







<a name="listaAlunos"></a>
  <div id="listagem_avaliacao">


  </div>

   

      <div class="row" id="botao_continuar">
        
      </div>
      
 </form>
        <!-- Main row -->

        <!-- /.row -->

      </div>





    </div>

  </section>

</div>








<div class="modal fade" id="modal-video">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">VEJA O QUE MUDOU</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        

          <div class="modal-body">
              <!-- /corpo -->
          <center>

            <!-- <h1>ATENÇÃO, NÃO LANÇAR NOTA ANTES DAS 20:30, <font color="RED">SERVIDOR EM MANUTENÇÃO</font></h1> -->
             <iframe width="400" height="315" src="https://www.youtube.com/embed/dNihxQto4Hg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </center>

              <!-- /corpo -->
        </div>
      <button type="button" class="btn btn-default" data-dismiss="modal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Fechar</font></font></button>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>



 <?php 

    include 'rodape.php';

 ?>