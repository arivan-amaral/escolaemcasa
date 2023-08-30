<?php 
session_start();
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
include_once '../Model/Setor.php';
include_once '../Model/Chamada.php';


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