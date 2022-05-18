<?php 
session_start();
include "cabecalho.php";
include "alertas.php";
include "barra_horizontal.php";
include 'menu.php';
include '../Controller/Conversao.php';
include '../Model/Conexao.php';
include '../Model/Setor.php';
include '../Model/Chamada.php';


?>
  <!-- Main Sidebar Container -->
<div class="content-wrapper">
<!-- ####################### CORPO ################################################# -->
<script type="text/javascript" src="ajax.js?<?php echo rand(); ?>"></script>

      <div class="container-fluid">
        <div class="row mb-2">

          <div class="col-sm-1"></div>
          <div class="col-sm-10 alert alert-<?php echo $tema_aplivacao; ?>">
          <center>  
            <h1 class="m-0">
              <b>
                PESQUISAR CHAMADO POR PROTOCOLO
              </b>
            </h1>
          </center>

          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
<div class="card card-primary">
<div class="card-header">
</div>
<!-- /.card-header -->
<!-- form start -->
<!-- form start -->
               
   <div class="card-body">
      <div class="row">
        <div class="col-sm-10">
          <div class="form-group">
           <label for="exampleInputEmail1">PESQUISA</label>
           <input type="text" class="form-control" name="pesquisa" id="pesquisa">
          </div>
        </div>
        <div class="col-sm-2" style="margin-top: 7px;" ><br>
         <a  class="btn btn-primary" onclick="pesquisa_chamado()">Pesquisar</a>
        </div>
      </div>
    </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">     
            <!-- /.card-header -->
          <div class="card-body table-responsive ">
            <table class="table table-hover text-nowrap" id="resultado">
              
            </table>
          </div>
            <!-- /.card-body -->
        </div>
          <!-- /.card -->
      </div>
    </div>
  </div>

</div>
    

<script type="text/javascript">
  document.addEventListener('keydown', function (event) {
    if (event.keyCode == 13){
     pesquisa_chamado();
    }
});
</script>



<!-- ######################################################################## -->
</div>

<?php include_once "rodape.php"; ?>