<?php 
  include_once "cabecalho.php";
  include_once "barra_horizontal.php";
  include_once 'menu.php';


  if (isset($_SESSION['status'])) {
    if($_SESSION['status']==0){
        echo "<script>
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Código incorreto!',
            
          })
      </script>"; 
      unset($_SESSION['status']); 
        
    }else {
      echo "</script>      
      Swal.fire(
        'Pronto, agora é só agendar!',
        'q',
        'success'
      )
      </script>"; 
      unset($_SESSION['status']); 
    }
  }
?>

<script src="ajax.js"></script>

<div class="content-wrapper" style="min-height: 529px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Sobre Nós</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Início</a></li>
              <li class="breadcrumb-item active"><i>Sobre Nós</i></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <h4>...</h4>
      </div>
    </section>

  </div>


  <!-- /.content-wrapper -->
  <!-- Control Sidebar -->
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