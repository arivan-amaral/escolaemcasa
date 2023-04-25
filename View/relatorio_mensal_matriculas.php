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

  $idcoordenador=$_SESSION['idfuncionario'];

}
  include_once "cabecalho.php";
  include_once "alertas.php";
 
  include_once "barra_horizontal.php";
  include_once 'menu.php';
  include_once '../Controller/Conversao.php';

  include_once '../Model/Conexao.php';

  include_once '../Model/Setor.php';
  include_once '../Model/Chamada.php';
  include_once '../Model/Escola.php';
  include_once '../Model/Turma.php';
  include_once '../Model/Coordenador.php';

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
                echo $_SESSION['NOME_APLICACAO']; 
              }
              ?>

             <?php if (isset($_SESSION['nome'])) {

              echo " ( ".$_SESSION['idfuncionario'].")".$_SESSION['nome'];  

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
  <h2>RELATÓRIO MENSAL DE MATRÍCULAS</h2>
   
   <br>
    <div class="row">
        <div class="col-sm-2">
          <div class="form-group">
           <label for="exampleInputEmail1">DATA INICIAL</label>
           <input type="date" class="form-control" name="data_inicial" id="data_inicial">
          </div>
        </div>
         <div class="col-sm-2">
          <div class="form-group">
           <label for="exampleInputEmail1">DATA FINAL</label>
           <input type="date" class="form-control" name="data_final" id="data_final">
          </div>
        </div>
       
        <div class="col-sm-4">
          <div class="form-group">
           <label for="exampleInputEmail1">ESCOLA</label>
           <select class="form-control"  id="escola" name="escola" >
            <?php 
              if ($_SESSION['nivel_acesso_id']>=100) {
            ?>
                <option value="todas">TODAS</option>

         
            <?php  
              }
              // $res_escola = lista_escola($conexao); 
              $res_escola= escola_associada($conexao,$idcoordenador);
              foreach ($res_escola as $key => $value) {
                $idescola = $value['idescola'];
                $nome_escola = $value['nome_escola'];
                echo "<option value='$idescola'>$nome_escola</option>";
              }

            ?>
            
          
           </select> 
          </div>
        </div>  

        <div class="col-sm-2">
          <div class="form-group">
           <label for="exampleInputEmail1">Segmento</label>
           <select class="form-control"  id="serie" name="serie" >
              <option value="todos">TODOS</option>      
              <option value="1">Infantil</option>      
              <option value="2">Anos Iniciais</option>      
              <option value="3">Anos Finais</option>      
              <option value="4">EJA</option>      
              <option value="5">Multisseriada</option>      
          
           </select> 
          </div>
        </div> 



        <div class="col-sm-2">
          <div class="form-group">
          <a style="margin-top: 30PX;" class="btn btn-primary" onclick="pesquisa_matricula_mensal()">Buscar</a>
          </div>
        </div>
      </div>
  <br>
  <table class="table table-bordered table-striped" id="resultado">
      
  </table>
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

    include_once 'rodape.php';

 ?>