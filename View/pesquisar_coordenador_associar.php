<?php 
session_start();
if (!isset($_SESSION['idcoordenador'])) {

       header("location:index.php?status=0");

}else{

  $idcoordenador=$_SESSION['idcoordenador'];

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

       </div>


        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->

        <div class="row">
           <div class="col-md-1"></div> 
           <div class="col-md-8"> 
                            <label for="exampleInputEmail1">Pesquise o coordenador a ser associado</label>
            
                <input type="search" id='pesquisa_coordenador' class="form-control form-control" 
                value="" placeholder="Pesquise aqui">
              
           </div>
           <div class="col-sm-2"> 
             <label><br></label><br>
           <a class="btn btn-primary" onclick="pesquisar_coordenador_associacao();">Buscar</a>
           </div>
         </div> 

<div id='tabela_pesquisa_coordenador'>
    


</div>
<!-- fim tabela pesquisa professo -->



</div> 




  


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

  <script type="text/javascript">
  const inputEle = document.getElementById('pesquisa_coordenador');
  inputEle.addEventListener('keyup', function(e){
    var key = e.which || e.keyCode;
    if (key == 13) { // codigo da tecla enter
      pesquisar_coordenador_associacao();
    }
  });
  </script>


 <?php 
    include 'rodape.php';
 ?>