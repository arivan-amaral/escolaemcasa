<?php
session_start();
if (!isset($_SESSION['idprofessor']) && !isset($_SESSION['idcoordenador'])) {

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
  include '../Model/Trabalho.php';

  $idescola=$_GET['idescola'];
  $idturma=$_GET['turm'];
  $idserie=$_GET['idserie'];

  $iddisciplina=$_GET['disc'];

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
              


                    <button type="button" class="btn btn-block  btn-success"><?php echo $_GET['turma']."  - ".$_GET['disciplina']; ?></button>
                    <br>
                    <form class="mt-12" action="../Controller/Cadastro_trabalho.php" method="post" enctype="multipart/form-data">



                        <h4 class="card-title">Título da Atividade</h4>
                        <div class="form-group">
                            <input type="text" name="titulo" class="form-control" autocomplete="off"  required="">
                        </div>

                        <h4 class="card-title">Arquivo</h4>
                        <div class="form-group">
                            <input type="file" name="arquivo" class="form-control" >
                        </div>
                      
                      <h4 class="card-title">Dia para ficar visível</h4>
                        <div class="form-group">
                            <input type="date" name="data_visivel" class="form-control"  required="">
                        </div>

                        <h4 class="card-title">Hora para ficar visível</h4>
                        <div class="form-group">
                            <input type="time" name="hora_visivel" class="form-control"  required="">
                        </div>


                   

                        <div class="card card-outline card-info">
                          <div class="card-header">
                            <h3 >
                              Descrição da Atividade
                            </h3>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                            <textarea name="descricao" id="summernote" rows="5" style="height: 245.719px;" required></textarea>

                          </div>
                          <div class="card-footer">
                            
                          </div>

                        </div>

                        <h4 class="card-title">Data de Entrega</h4>
                        <div class="form-group">
                            <input type="date" name="data_entrega" class="form-control"  required="">

                        </div>

                        <input type="hidden" name="idescola" id="idescola" value="<?php echo $idescola; ?>" class="form-control" required="">
                        <input type="hidden" name="turma_id" value="<?php echo $_GET['turm']; ?>" class="form-control" required="">

                        <input type="hidden" name="disciplina_id" value="<?php echo $_GET['disc']; ?>" class="form-control" required="">
                      
                      <div style="background-color:#808080; padding:10px;border-radius: 1%;">
                            
                          <p> <font color='red'>Escolha ás turma abaixo que esse trabalho/atividade será cadastrado. </font></p>
                        <?php

                          $result_disciplinas=$conexao->query("SELECT * FROM ministrada,escola,turma,disciplina where
                           ministrada.turma_id=idturma and
                           ministrada.disciplina_id=iddisciplina and 
                           ministrada.escola_id=idescola and
                           ministrada.escola_id=idescola and

                           idescola=$idescola and
                           professor_id=$idprofessor and
                           serie_id=$idserie and 
                           disciplina_id=$iddisciplina
                        
                          ");

                          foreach ($result_disciplinas as $key => $value) {
                             $turma_id=$value['idturma'];
                             $nome_turma=$value['nome_turma'];
                             $nome_disciplina=$value['nome_disciplina'];
                          
                             if ($idturma==$turma_id) {
                                echo"
                                <div class='custom-control custom-checkbox'>
                                    <input class='custom-control-input' name='idturma[]' type='checkbox' id='customCheckbox$turma_id' value='$turma_id' required checked>
                                    <label for='customCheckbox$turma_id' class='custom-control-label'>$nome_turma - $nome_disciplina</label>
                                </div>";

                             } else {
                              echo"
                              <div class='custom-control custom-checkbox'>
                                  <input class='custom-control-input' name='idturma[]' type='checkbox' id='customCheckbox$turma_id' value='$turma_id'  >
                                  <label for='customCheckbox$turma_id' class='custom-control-label'>$nome_turma - $nome_disciplina</label>
                              </div>";

                              
                            }
                        }

                        ?>
                    </div>
                        <br>
                        <br>

                        <button type="submit" class="btn btn-block btn-primary">Enviar Atividade</button>

                    </form>

                                        
                  </div>
                </div>



                <div class="row">
                  <div class="col-md-12">

                    <!-- The time line -->


                    <div class="timeline">
<br>
<br>
<br>

                      <!-- timeline time label -->
                    <?php 
                      $result= listar_trabalho($conexao, $idprofessor,$idturma,$iddisciplina,$idescola);
                      $cont=0;
                      foreach ($result as $key => $value) {
                         $id=$value['id'];

                         $titulo=$value['titulo'];

                         $descricao=$value['descricao'];

                         $extensao=$value['extensao'];
                         
                         $caminho=$value['caminho'];

                         $data_entrega=$value['data_entrega'];
                         $data_visivel=$value['data_hora_visivel'];

                         if ($extensao=="") {

                             echo "

                             <div class='time-label'>

                               <span class='bg-blue'>Data Entrega: $data_entrega</span>
                               <span class='bg-greem'>Data visivel: $data_visivel</span>

                             </div>

                             <!-- /.timeline-label -->

                             <!-- timeline item -->

                             <div>

                               <i class='fas fa-envelope bg-blue'></i>

                               <div class='timeline-item'>

                                 <span class='time'>
                                 <i class='fas fa-clock'></i> $data_entrega</span>

                                 <h3 class='timeline-header'><a href='#'>$titulo</a>  </h3>



                                 <div class='timeline-body'>

                                   $descricao

                                 </div>

                             

                                 <div class='timeline-footer'>
                                    <a href='#' onclick='excluir_trabalho($id);' class='btn btn-sm bg-danger'>Deletar Trabalho</a>

                                   <a class='btn btn-sm bg-warning' data-toggle='modal' data-target='#modal-default' onclick='listar_alunos_trabalho($id,$idturma,$iddisciplina);'> VER QUEM ENTREGOU </a>
          

                                 </div>
                                 
                               </div>

                             </div>";




                         }else {

                              

                             echo "

                             <!-- timeline time label -->

                             <div class='time-label'>

                               <span class='bg-primary'>Data entrega: ". converte_data_hora($data_entrega)."</span>
                               <span class='bg-secondary'>Data visível: ". converte_data_hora($data_visivel)."</span>


                             </div>

                             

                             <!-- /.timeline-label -->

                             <!-- timeline item -->

                             <div>

                               <i class='fa fa-camera bg-purple'></i>

                               <div class='timeline-item'>

                                 <span class='time'><i class='fas fa-clock'></i>$data_entrega</span>

                                 <h3 class='timeline-header'><a href='#'>$titulo</a> $descricao</h3>

                                 <div class='timeline-body'>
                                    
                                    <a href='trabalho/$caminho' target='_blank'>";
                                    $extensao = strtolower ( $extensao );

                                    if ( strstr ( '.pdf;.docx;.doc;.txt;.odt;.pptx', $extensao ) ) {
                                       echo"<img src='imagens/arquivos.png' width='200' height='200' alt='...'  ><br>
                                       $caminho
                                       ";
                                    }else{
                                        echo"<img src='trabalho/$caminho' width='300' height='300' alt='...'  >";
                                    }
                                  
                                  echo"
                                    </a>                                 

                                 </div>

                                 <div class='timeline-footer'>
                                    <a href='#' onclick='excluir_trabalho($id);' class='btn btn-sm bg-danger'>Deletar Trabalho</a>
                                   
                                   <a class='btn btn-sm bg-warning' data-toggle='modal' data-target='#modal-default'  onclick='listar_alunos_trabalho($id,$idturma,$iddisciplina);'> VER QUEM ENTREGOU </a>


                                 </div>
 
                               </div>
 

                             </div>
                             ";

                          

                      }



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



  <div class='modal fade' id='modal-default'>
      <div class='modal-dialog'>
        <div class='modal-content'>
          <div class='modal-header'>
            <h4 class='modal-title'>Escolha o aluno</h4>
            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>
            <div class='modal-body' id="listar_alunos">
                
                
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>


 <?php 

    include 'rodape.php';

 ?>