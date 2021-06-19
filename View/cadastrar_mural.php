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
  include '../Model/Turma.php';

  include '../Model/Video.php';

  $idescola=$_GET['idescola'];
  $idserie=$_GET['idserie'];
  $idturma=$_GET['turm'];


  

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

              <li class="breadcrumb-item active">Mural</li>

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
                                              
                                <button type="button" class="btn btn-block  btn-success"> 
                                  ADICIONAR ITEM AO MURAL 
                                </button>
                                              <br>
                                          <form class="mt-12"  method="post" action="../Controller/Cadastrar_mural.php">
                                                  <input type="hidden" name="idturma" value="<?php echo $idturma ?>">
                                                  <input type="hidden" name="idserie" value="<?php echo $idserie ?>">
                                                  <input type="hidden" name="idescola" value="<?php echo $idescola ?>">
                                              
                                              <h4 class="card-title">Título do mural</h4>
                                              <div class="form-group">
                                                  <input type="text" name="titulo" class="form-control" autocomplete="off"  required="">
                                              </div>                                             
                                             
                              
                                              <h4 class="card-title">Descrição </h4>
                                              <div class="form-group">
                                                  <textarea class="form-control" rows="3" name="descricao" placeholder="Descrição" required=""></textarea>
                                              </div>


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

    include 'rodape.php';

 ?>