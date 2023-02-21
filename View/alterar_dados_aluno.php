<?php
  include_once '../Model/Aluno.php';

  include_once 'seguranca_aluno.php';
 
  include_once "cabecalho.php";
  include_once "alertas.php";
  
  include_once "barra_horizontal.php";
  include_once 'menu.php';
  include_once '../Controller/Conversao.php';
  include_once '../Model/Conexao.php';
  

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
        
    <div class="row">
               <!-- .row -->
          <div class="col-md-12">
 
              

            <form class="mt-12" action="../Controller/Alterar_dados_aluno.php" method="post"  enctype="multipart/form-data">
              <?php 
                  $result=meus_dados_aluno($conexao,$idaluno);
                  foreach ($result as $key => $value) {
                    $idaluno=$value['idaluno'];
                    $nome=$value['nome'];
                    $email=$value['email'];
                    $whatsapp=$value['whatsapp'];
                    $whatsapp_responsavel=$value['whatsapp_responsavel'];
                    $senha=$value['senha'];
                    
                    if(mb_strlen($whatsapp)>11){
                      $whatsapp=substr($whatsapp, 2);
                    }

                    if(mb_strlen($whatsapp_responsavel)>11){
                      $whatsapp_responsavel=substr($whatsapp_responsavel, 2);
                    }
                    if(mb_strlen($whatsapp)<3){
                      $whatsapp="";
                    }

                    if(mb_strlen($whatsapp_responsavel)<3){
                      $whatsapp_responsavel="";
                    }


                    echo " <div class='form-group'>
                             <input type='hidden' class='form-control' name='idaluno' value='$idaluno'  required>

                             <label for='exampleInputEmail1'>Nome do aluno</label>
                             <input type='text' class='form-control' name='nome' value='$nome' readonly='' required>
                           </div>
                         

                           <div class='form-group'>
                             <label for='exampleInputEmail1'>Usuário ou Email do aluno</label>
                             <input type='text' class='form-control' name='email' value='$email' required='' >
                           </div>

                           <div class='form-group'>
                             <label for='exampleInputEmail1'>Whatsapp do aluno</label>
                             <input type='tel' class='form-control' name='whatsapp' value='$whatsapp' onkeypress='mask(this, mphone);' onblur='mask(this, mphone);'>
                           </div>


                           <div class='form-group'>
                             <label for='exampleInputEmail1'>Whatsapp do responsável</label>
                             <input type='tel' class='form-control' name='whatsapp_responsavel' value='$whatsapp_responsavel' onkeypress='mask(this, mphone);' onblur='mask(this, mphone);' >
                           </div>

                           <div class='form-group'>
                             <label for='exampleInputEmail1'>Nova Senha</label>
                             <input type='password' class='form-control' name='senha' value='$senha' required='' >
                           </div>"; 
                  }

              ?>
              
                             


                  <button type="submit" class="btn btn-block btn-primary">Concluir!</button>
              </form>
              <br>
              <br>
              <br>
              <br>
            

                 
                <script>
                   document.getElementById("files").onchange = function () {
                       var reader = new FileReader();

                       reader.onload = function (e) {
                           // get loaded data and render thumbnail.
                           document.getElementById("image").src = e.target.result;
                       };

                       // read the image file as a data URL.
                       reader.readAsDataURL(this.files[0]);
                   };
                </script>

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