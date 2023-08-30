<?php
session_start();
if (!isset($_SESSION['idprofessor']) && !isset($_SESSION['idfuncionario']) ) {
   header("location:index.php?status=0");
}else{
    if (isset($_SESSION['idfuncionario'])) {
      $idfuncionario=$_SESSION['idfuncionario'];

   
    }

}
 include_once "cabecalho.php";
  include_once "alertas.php";
  
  include_once "barra_horizontal.php";
  include_once 'menu.php';
  include_once '../Controller/Conversao.php';
  if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
  include_once '../Model/Professor.php';
  

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
 
              

            <form class="mt-12" action="../Controller/Alterar_dados_funcionario.php" method="post"  enctype="multipart/form-data">
              <?php 
                  $result=listar_dados_professor($conexao,$idfuncionario);
                  foreach ($result as $key => $value) {
                    $nome=$value['nome'];
                    $email=$value['email'];
                    
                    $whatsapp=$value['whatsapp'];
                    $senha=$value['senha'];

                    echo " <div class='form-group'>
                             <label for='exampleInputEmail1'>Nome</label>
                             <input type='text' class='form-control' name='nome' value='$nome' required=''>
                           </div>

                           <div class='form-group'>
                             <label for='exampleInputEmail1'>Email</label>
                             <input type='text' class='form-control' name='email' value='$email' required='' >
                           </div>

                           <div class='form-group'>
                             <label for='exampleInputEmail1'>Whatsapp</label>
                             <input type='text' class='form-control' name='whatsapp' value='$whatsapp' required=''>
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