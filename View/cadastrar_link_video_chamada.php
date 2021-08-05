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
  include '../Model/Conexao.php';
  include '../Controller/Conversao.php';

  include '../Model/Video.php';

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
                                              
                                          <button type="button" class="btn btn-block btn-xs btn-success"><?php echo $_GET['turma']."  - ".$_GET['disciplina']; ?></button>
                                              <br>
                                          <form class="mt-12" action="../Controller/Cadastro_link_video_chamada.php" method="post">
                                              
                                              <h4 class="card-title">Link da da reunião de vídeo chamada</h4>
                                              <div class="form-group">
                                                  <input type="text" name="link" class="form-control" autocomplete="off" required="">
                                              </div>
                                             
                                          <h4 class="card-title text-success">Link da reunião visível a partir da data:</h4>
                                          <div class="form-group">
                                                  <input type="date" name="data_visivel" class="form-control"   required="">
                                              </div>
                                          <h4 class="card-title  text-success">Link da reunião visível a partir da hora:</h4>
                                              <div class="form-group">
                                                  <input type="time" name="hora" class="form-control" required=""  >
                                              </div>  

                                              <h4 class="card-title text-danger">Link da reunião  visível ATÉ a data:</h4>
                                          <div class="form-group">
                                                  <input type="date" name="data_visivel_fim" class="form-control"   required="">
                                              </div>
                                          <h4 class="card-title  text-danger">Link da reunião visível ATÉ a hora:</h4>
                                              <div class="form-group">
                                                  <input type="time" name="hora_fim" class="form-control" required=""  >
                                              </div>
                              
                                            <div class="card card-outline card-info">
                                              <div class="card-header">
                                                <h3 >
                                                  Descrição
                                                </h3>
                                              </div>
                                              <!-- /.card-header -->
                                              <div class="card-body">
                                                <textarea name="descricao" id="summernote" rows="5" style="height: 245.719px;"></textarea>

                                              </div>
                                              <div class="card-footer">
                                                
                                              </div>

                                            </div>


                                                 <input type="hidden" name="url_get" value="<?php echo $url_get; ?>" class="form-control" required=""> 

                                                 <input type="hidden" name="idturma" value="<?php echo $_GET['turm']; ?>" class="form-control" required="">

                                                 <input type="hidden" name="idescola" value="<?php echo $idescola; ?>" class="form-control" required="">

                                                 <input type="hidden" name="turma" value="<?php echo $_GET['turma']; ?>" class="form-control" required="">

                                                 <input type="hidden" name="disciplina" value="<?php echo $_GET['disciplina']; ?>" class="form-control" required="">

                                                 <input type="hidden" name="iddisciplina" value="<?php echo $_GET['disc']; ?>" class="form-control" required="">

                                               <button type="submit" class="btn btn-block btn-primary">Salvar </button>
                                               <br>
                                               <br>
                                              
                                          </form>
                                        
                  </div>
                </div>




                <section class="content">

                             <div class="container-fluid">

                               

                                   <div class="timeline">

                                     <!-- timeline time label -->

                                     <div class="row">
                                       <div class="col-md-2"></div>
                                       <div class="col-md-8">

                                              <?php 

                                               $listando_links=$conexao->query("SELECT * FROM video_chamada,disciplina WHERE  
                                                 disciplina_id=iddisciplina AND
                                                 escola_id=$idescola and turma_id=$idturma  order by id desc");
                                               $cont_reuniao=0;
                                               foreach ($listando_links as $key => $value) {

                                                 $id=$value['id'];
                                                 $nome_disciplina=$value['nome_disciplina'];
                                                 $descricao=$value['titulo'];
                                                 $link=$value['link'];
                                                 $data_visivel=converte_data_hora($value['hora_inicio']);
                                                 $data_visivel_fim=converte_data_hora($value['hora_fim']);

                                                 echo"       
                                                 <div class='time-label'>
                                                 <span class='bg-blue'>LINK DA DISCIPLINA: $nome_disciplina DISPONÍVEL DE: $data_visivel ÀS $data_visivel_fim</span>
                                                 </div>";

                                                 echo "
                                                 <p> <a href='$link' target='_blank'>$link</a> </p>
                                   
                                                 $descricao";
                                               }

                                               ?> 
                                        </div>
                                    </div>      
                                    <!--  <div>
                                       <i class="fas fa-clock bg-gray"></i>
                                     </div> -->
                                       
                               </div>
                             </div>
                           </section>


             

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