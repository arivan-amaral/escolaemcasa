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
  include_once '../Model/Conexao.php';
  include_once '../Controller/Conversao.php';

  include_once '../Model/Video.php';







  $idescola=$_GET['idescola'];
  $idturma=$_GET['turm'];

  $iddisciplina=$_GET['disc'];

  

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
                echo $_SESSION['NOME_APLICACAO']; 
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

              <li class="breadcrumb-item active">Material</li>

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
                                          <form class="mt-12" action="../Controller/Cadastro_video.php" method="post">
                                           
                                              <h4 class="card-title">Título do material de apoio</h4>
                                              <div class="form-group">
                                                  <input type="text" name="titulo" class="form-control" autocomplete="off"  required="">
                                              </div>

                                              <h4 class="card-title">Anexo</h4>
                                              <div class="form-group">
                                                  <input type="file" name="anexo" class="form-control" autocomplete="off" required="">
                                              </div>
                                             
                                              <h4 class="card-title">Visível a partir da data:</h4>
                                              <div class="form-group">
                                                  <input type="date" name="data_visivel" class="form-control"   required="">
                                              </div>

                                          <h4 class="card-title">Visível a partir da hora:</h4>
                                              <div class="form-group">
                                                  <input type="time" name="hora" class="form-control" required=""  >
                                              </div>
                              
                                              <h4 class="card-title">Descrição</h4>
                                              <div class="form-group">
                                                  <textarea class="form-control" rows="3" name="descricao" placeholder="Descrição do Video" required=""></textarea>
                                              </div>

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

    include_once 'rodape.php';

 ?>