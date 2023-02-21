<?php 
session_start();
if (!isset($_SESSION['idfuncionario'])) {

       header("location:index.php?status=0");

}else{

  $idcoordenador=$_SESSION['idfuncionario'];

} 
  include_once "cabecalho.php";
  include_once "barra_horizontal.php";
  include_once 'menu.php';
  include_once 'alertas.php';
  include_once '../Model/Coordenador.php';
  include_once '../Model/Conexao.php';
  include_once '../Model/Escola.php';


  
?>

<script src="ajax.js?<?php echo rand(); ?>"></script>
<script type="text/javascript">
  // Swal.fire({
  //   position: 'center',
  //   icon: 'error',
  //   title: 'A página de pesquisa de alunos está em manutenção para melhorar o desempenho da plataforma, caso precise de alguma funcionalidade dela, entre em contato com o suporte !! previsão de retorno para as 15:30',
  //      text: ' ',
  //   showConfirmButton: true
  // });
  
</script>
 
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

       </div>


        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
  <div class="container-fluid">

        <div class="row">
           <div class="col-sm-4">
            <label for="exampleInputEmail1">Filtrar por escola</label>
              <select id="escola" class="form-control form-control">

                  <option value="Todas" style='color: black; background-color:#A9A9A9;'>TODAS AS ESCOLAS</option>
                  <?php 

                  $res_turma=escola_associada($conexao,$idcoordenador); 
                  $array_escolas_coordenador=array();
                  $conta_escolas=0;
                  foreach ($res_turma as $key => $value) {
                    $array_escolas_coordenador[$conta_escolas]=$value['idescola'];
                    $conta_escolas++;
                  }
                 $res_escola=lista_escola($conexao); 
                 foreach ($res_escola as $key => $value) {
                    $idescola=$value['idescola'];
                    $nome_escola=$value['nome_escola'];
                    if (in_array($idescola, $array_escolas_coordenador) ) { 
                      echo"<option value='$idescola' style='color: black; background-color:#A9A9A9;'>$nome_escola </option>";
                    }else{
                      echo"<option value='$idescola'>$nome_escola </option>";

                    }
                 }


                  ?>
              </select>

           </div>  

  
           <div class="col-sm-6"> 
              <label for="exampleInputEmail1">Pesquisar aluno</label>
                <input type="search" id="pesquisa" class="form-control form-control" 
               value="" placeholder="Pesquisar aluno">
              
           </div>

              <div class="col-sm-2"> 
                <label><br></label><br>
              <a class="btn btn-primary" onclick="limpa_pesquisa_aluno();pesquisa_aluno();">Buscar</a>
              </div>
         </div> 

<div id='tabela_pesquisa'>
    


</div>

<div id="paginacao">
             
</div>
<input type="hidden" value="50" id="valor_paginacao">

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
    limpa_pesquisa_aluno();
   pesquisa_aluno();
  }
});
</script>


 <?php 
    include_once 'rodape.php';
 ?>