<?php 
session_start();
if (!isset($_SESSION['idfuncionario'])) {

       header("location:index.php?status=0");

}else{

  $idcoordenador=$_SESSION['idfuncionario'];

} 
  include "cabecalho.php";
  include "barra_horizontal.php";
  include 'menu.php';
  include 'alertas.php';


 
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

       </div>


        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->

        <div class="row">
           <div class="col-sm-1"></div> 
           <div class="col-sm-8"> 
              <label for="exampleInputEmail1">Pesquisar aluno</label>
                <input type="search" id="pesquisa" class="form-control form-control" 
               value="" placeholder="Pesquisar aluno">
              
           </div>

              <div class="col-sm-2"> 
                <label><br></label><br>
               <a class="btn btn-primary" onclick="pesquisa_aluno();">Buscar</a>
              </div>
         </div> 

<div id='tabela_pesquisa'>
    


</div>
<!-- fim tabela pesquisa professo -->



</div> 



  <!-- /.content-wrapper -->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->


  


<script type="text/javascript">
const inputEle = document.getElementById('pesquisa');
inputEle.addEventListener('keyup', function(e){
  var key = e.which || e.keyCode;
  if (key == 13) { // codigo da tecla enter
   pesquisar_professor_associacao();
  }
});
</script>


 <?php 
    include 'rodape.php';
 ?>