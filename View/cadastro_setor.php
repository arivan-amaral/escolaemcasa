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
  
  
?>

<script src="ajax.js"></script>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-1">
        </div>
         <div class="col-md-10">
            <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">CADASTRO DO SETOR</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form action="../Controller/Cadastro_setor.php" method="POST">
                    <div class="card-body">

                      <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome"  required="">
                      </div>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Concluir</button>
                    </div>

                  </form>
                </div>
             </div> <!-- </div> class=col- 10 -->
      </div> <!-- </div> row  -->
</div>
  <!-- /.content-wrapper -->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
<?php
  include 'rodape.php';
?>