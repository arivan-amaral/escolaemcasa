<?php 

session_start();
if (!isset($_SESSION['idcoordenador'])) {

       header("location:index.php?status=0");

}else{

  $idcoordenador=$_SESSION['idcoordenador'];

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

 //$array_url=explode('p?', $_SERVER["REQUEST_URI"]);
 $url_get="";
  

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
                                              
                                      <button type="button" class="btn btn-block  btn-success"> ADICIONAR ITEM AO MURAL GERAL</button>
                                              <br>
                                          <form class="mt-12"  method="post" action="../Controller/Cadastro_mural_geral.php">
                                              

                                            <h4 class="card-title">Selecione a série</h4>
                                            <div class="form-group">

                                            <select name='idserie'  class="custom-select rounded-0" required>
                                              <option></option>

                                              <option value='todas'>TODAS</option>
                                              <?php

                                              $res_turma=lista_serie($conexao);

                                              foreach ($res_turma as $key => $value) {
                                                  $idserie = $value['id'];
                                                  $serie = ($value['nome']);
                                                   echo "<option value='$idserie' class='text-black'>$serie</option>";
                                              }
                                              ?>
                                            </select>
                                          </div>

                                              <h4 class="card-title">Título do mural</h4>
                                              <div class="form-group">
                                                  <input type="text" name="titulo" class="form-control" autocomplete="off"  required="">
                                              </div>                                             
                                             
                              
                                              <h4 class="card-title">Descrição </h4>
                                              <div class="form-group">
                                                  <textarea class="form-control" rows="3" name="descricao" placeholder="Descrição" required=""></textarea>
                                              </div>
                                              <input type="hidden" id="pagina" value="cadastro_mural_geral.php">
                                              
                                              <input type="hidden" name="url_get" id="url_get" value="<?php echo $url_get; ?>">


                                               <button type="submit" class="btn btn-block btn-primary">Salvar </button>
                                               <br>
                                               <br>
                                              
                                          </form>
                                        
                  </div>
                </div>
 
          <a name="mural"></a>

             <?php



             echo "

             <div class='row'>
             <div class='col-sm-1'></div>
             <div class='col-sm-8'>
               <div class='card card-secondary collapsed-card'>
                 <div class='card-header' data-card-widget='collapse'>
                   <h3 class='card-title'>POSTADO PELO PROFESSOR </h3>

                   <div class='card-tools'>
                     <button type='button' class='btn btn-tool' data-card-widget='collapse'>
                       <i class='fas fa-plus'></i>
                     </button>
                   </div>
                   <!-- /.card-tools -->
                 </div>
                 <!-- /.card-header -->
                 <div class='card-body' style='display: none;'>

             ";
                 
               $res_mural_secret=$conexao->query("SELECT * FROM mural where
                setor !='Secretaria'  order by mural.id desc");

               foreach ($res_mural_secret as $key => $value) {
                 $idmural=$value['id'];
                 $titulo=$value['titulo'];
                 $descricao=$value['descricao'];
     
               
             
                   echo"
                    <input id='idmural$idmural' value='$idmural' hidden>
                   <div class='card-body'>
                     <div class='callout callout-info'>
                       <h5>$titulo</h5>
                       <p>$descricao</p><br>
                       
                       <span class='text-info'> Postado pelo professor.</span><br>
                      
                        <a onclick='excluir_mural($idmural);' class='btn btn-danger text-white'>Excluir</a>
                     </div>
                     </div>";
             

             }





echo"
      </div>
    </div>
  </div>
</div>
";

      ?> 

             
      <?php 


echo "

<div class='row'>
<div class='col-sm-1'></div>
<div class='col-sm-8'>
  <div class='card card-info collapsed-card'>
    <div class='card-header' data-card-widget='collapse'>
      <h3 class='card-title'>MEUS POSTs </h3>

      <div class='card-tools'>
        <button type='button' class='btn btn-tool' data-card-widget='collapse'>
          <i class='fas fa-plus'></i>
        </button>
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class='card-body' style='display: none;'>

";
    
  
               $res_mural_secret=$conexao->query("SELECT 
               mural.id, mural.titulo, mural.descricao, serie.nome

               FROM mural,serie where serie_id=serie.id and setor='Secretaria' and usuario_id=$idcoordenador  group by serie_id order by mural.id desc");

               foreach ($res_mural_secret as $key => $value) {
                 $idmural=$value['id'];
                 $titulo=$value['titulo'];
                 $descricao=$value['descricao'];
                 $nome=$value['nome'];
               
             
                   echo"<div class='card-body'>
                     <div class='callout callout-danger'>
                       <h5>$titulo</h5>
                       <p>$descricao</p><br>
                       <p>$nome</p>
                       <span class='text-info'> Postado pela secretaria.</span>

                        <br>
                          <input id='idmural$idmural' value='$idmural' hidden>
                         <a onclick='excluir_mural($idmural);' class='btn btn-danger text-white'>Excluir</a>
                     </div>
                     </div>";
             

             }



echo"
      </div>
    </div>
  </div>
</div>
";


      ?>      

    <?php 


echo "

<div class='row'>
<div class='col-sm-1'></div>
<div class='col-sm-8'>
  <div class='card card-warning collapsed-card'>
    <div class='card-header' data-card-widget='collapse'>
      <h3 class='card-title'>POSTADOS POR OUTROS PROFISSIONAIS </h3>

      <div class='card-tools'>
        <button type='button' class='btn btn-tool' data-card-widget='collapse'>
          <i class='fas fa-plus'></i>
        </button>
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class='card-body' style='display: none;'>

";
    
  
               $res_mural_secret=$conexao->query("SELECT 
               mural.id, mural.titulo, mural.descricao, serie.nome

               FROM mural,serie where serie_id=serie.id and setor='Secretaria' and usuario_id !=$idcoordenador  group by serie_id order by mural.id desc");

               foreach ($res_mural_secret as $key => $value) {
                 $idmural=$value['id'];
                 $titulo=$value['titulo'];
                 $descricao=$value['descricao'];
                 $nome=$value['nome'];
               
             
                   echo"<div class='card-body'>
                     <div class='callout callout-danger'>
                       <h5>$titulo</h5>
                       <p>$descricao</p><br>
                       <p>$nome</p>
                       <span class='text-info'> Postado pela secretaria.</span>

                        <br>
                          <input id='idmural$idmural' value='$idmural' hidden>
                         <a onclick='excluir_mural($idmural);' class='btn btn-danger text-white'>Excluir</a>
                     </div>
                     </div>";
             

             }



echo"
      </div>
    </div>
  </div>
</div>
";


      ?>

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