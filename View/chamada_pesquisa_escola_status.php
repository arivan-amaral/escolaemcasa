<?php
session_start();
if (!isset($_COOKIE['dia_doservidor_publico2'])) {
  setcookie('dia_doservidor_publico2', 1, (time()+(30*24*3600)));
 // setcookie('conteudo', 1, (time()+(300*24*3600)));
}else{
  setcookie('dia_doservidor_publico2', 0, (time()+(30*24*3600)));
  setcookie('dia_doservidor_publico2', $_COOKIE['dia_doservidor_publico2']+1);
}
  
###################################################
if (!isset($_SESSION['idcoordenador'])) {
  //header("location:index.php?status=0");

}else{

  $idcoordenador=$_SESSION['idcoordenador'];

}
  include "cabecalho.php";
  include "alertas.php";
 
  include "barra_horizontal.php";
  include 'menu.php';
  include '../Controller/Conversao.php';

  include '../Model/Conexao.php';

  include '../Model/Setor.php';
  include '../Model/Chamada.php';

if ($_COOKIE['dia_doservidor_publico2']<2 && date("m-d")=="10-28") {
?>
    <script>
     function dia_doservidor_publico(){
         Swal.fire({
           title: "Parabéns!",
           imageUrl: 'dia_doservidor_publico.png',
           imageAlt: 'dia_doservidor_publico',
         });
     }
setTimeout('dia_doservidor_publico();',3000);
  </script> 
<?php 
  }
?>

<style>
.quadro {
  background-image: url(imagens/logo_educalem_natal.png);
  background-repeat: no-repeat;

  background-position: center;
   
      background-size: 100% 100%;
}


 </style>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="ajax.js?<?php echo rand(); ?>"></script>


<div class="content-wrapper" style="min-height: 529px;">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-1">
          </div>
          <div class="col-sm-12 alert alert-warning">

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

          

        </div><!-- /.row -->

      </div><!-- /.container-fluid -->

    </div>

    <!-- /.content-header -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <!-- Inicio -Content Wrapper. Contains page content -->
  <div class="container">
  <h2>Consulta com Filtros</h2>
  <p>Digite informações no campo de entrada para pesquisar por escola, solicitante, data da solicitação,
    setor, retorno, data de retorno ou status.</p> 
   
    <!--div class="row">
      <div class="col-sm-8">
         <div class="form-group">
           <label for="exampleInputEmail1">Filtro</label>
           <select class="form-control"  id="filtro" name="filtro" >
            <option value="ESCOLA">ESCOLA</option>
            <option value="SOLICITANTE">SOLICITANTE</option>
            <option value="DATA SOLICITAÇÃO">DATA SOLICITAÇÃO</option>
            <option value="SETOR">SETOR</option>
            <option value="RETORNADOR">RETORNADOR</option>
            <option value="DATA RETORNO">DATA RETORNO</option>
           </select> 
          </div> 
      </div>
    </div-->
    <div class="row">
      <div class="col-sm-8">
        <input class="form-control" id="pesquisa" name="pesquisa" type="text" placeholder="Digite aqui..">
      </div>
      <div class="col-sm-4">
        <a  class="btn btn-primary" onclick="pesquisa_chamado_setor_escola()">Pesquisar</a>
      </div>
    </div>
  <br>
  <table class="table table-bordered table-striped" id="resultado">
        
  </table>
  
  <p>A pesquisa acontecerá mediante as informações inserida e apresentadas na tabela.</p>
</div>

<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
            
</div>

<aside class="control-sidebar control-sidebar-dark">

  <!-- Control sidebar content goes here -->

</aside>

  <!-- /.control-sidebar -->

 <?php 

    include 'rodape.php';

 ?>