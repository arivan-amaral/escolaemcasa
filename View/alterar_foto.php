<?php
  include_once 'seguranca_aluno.php';

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
  include_once '../Model/Aluno.php';

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
                echo $_SESSION['NOME_APLICACAO']; 
              }
              ?>
              
             <?php if (isset($_SESSION['nome'])) {
              echo " - ".$_SESSION['nome'];  
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

                    <h1 class="btn alert-primary">Sua foto Atual</h1 >
                    <div class="col-lg-8 text-center mb-8">

                    <?php 
                      $result=pesquisar_imagem_aluno($conexao, $idaluno);
                      $cont=0;

                      foreach ($result as $key => $value) {
                        $foto=$value['nome'];
                        echo "
                          <img src='fotos/$foto' alt='image'  id='image' class='rounded-circle' height='250' width='250'>
                          ";
                          $cont++;
                      }
                      if ($cont==0) {
                        echo "
                          <img src='fotos/user.png' alt='image'  id='image' class='rounded-circle' height='250' width='250'>
                          ";
                      }
                    ?>
                    </div>

            <form class="mt-12" action="../Controller/Alterar_foto.php" method="post"  enctype="multipart/form-data">
                  <label>Escolha sua Foto</label>
                  <div class="form-group">
                          <input type="file" accept="image/*" id="files" name="imagem" class="form-control" required="">
                  </div>

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