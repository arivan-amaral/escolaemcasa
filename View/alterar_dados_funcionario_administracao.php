<?php
session_start();
if (!isset($_SESSION['idprofessor']) && !isset($_SESSION['idcoordenador']) ) {
   header("location:index.php?status=0");
}else{

    if (isset($_GET['idfuncionario'])) {
      $idfuncionario=$_GET['idfuncionario'];
    }else{
      header("location:index.php?status=0");
    }

}
 include "cabecalho.php";
  include "alertas.php";
  
  include "barra_horizontal.php";
  include 'menu.php';
  include '../Controller/Conversao.php';
  include '../Model/Conexao.php';
  include '../Model/Professor.php';
  

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
 
              

            <form class="mt-12" action="../Controller/Alterar_dados_funcionario_administracao.php" method="post"  enctype="multipart/form-data">
              <input type="hidden" name="idfuncionario" value="<?php echo $idfuncionario; ?>">
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
            

                 
  

          </div>       
    </div>


    </div>
  </section>
</div>


 <?php 
    include 'rodape.php';
 ?>