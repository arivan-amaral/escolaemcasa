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
  include_once '../Model/Conexao.php';
  include '../Controller/Conversao.php';
  include '../Model/Turma.php';

  include '../Model/Video.php';


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

          <div class="col-sm-12 alert alert-warning">

            <h1 class="m-0"><b>
            <?php
              if (isset($nome_escola_global)) {
                echo NOME_APLICACAO; 
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
                  <div class="col-sm-10">
                                              
                          
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
                                              <input type="hidden" id="pagina" value="cadastrar_mural.php">
                                              <input type="hidden" name="url_get" id="url_get" value="<?php echo $url_get; ?>">

                                               <button type="submit" class="btn btn-block btn-primary">Salvar </button>
                                               <br>
                                               <br>
                                              
                                          </form>
                                        
                  </div>
                </div>

      <div class="row">
                  <div class="col-sm-1"></div>
                  <div class="col-sm-10">
<a name="mural"></a>

              <?php
               $res_mural_secret=$conexao->query("SELECT * FROM mural where
                escola_id=$idescola and
                turma_id=$idturma and
             


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
                       
                      
                        <a onclick='excluir_mural($idmural);' class='btn btn-danger text-white'>Excluir</a>
                     </div>
                     </div>";
             

             }
            ?>  



             
             <?php
               $res_mural_secret=$conexao->query("SELECT 
               mural.id, mural.titulo, mural.descricao, serie.nome

               FROM mural,serie where serie_id=serie.id and setor='Secretaria' group by serie_id order by mural.id desc");

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
                       <span class='text-danger'> Postado pela secretaria.</span>

                        <br>
                          <input id='idmural$idmural' value='$idmural' hidden>
                         <a onclick='excluir_mural($idmural);' class='btn btn-danger text-white'>Excluir</a>
                     </div>
                     </div>";
             

             }
            ?>

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