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
  $idcoordenador=$_SESSION['idfuncionario'];
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

<style>

.checkbox-btn {
  display: inline-block;
  position: relative;
}

.checkbox-btn__label {
  display: inline-block;
  position: relative;
  font-size: 16px;
  line-height: 32px;
  padding-left: 40px;
  cursor: pointer;
}

.checkbox-btn__image {
  display: inline-block;
  position: absolute;
  top: 0;
  left: 0;
  width: 32px;
  height: 32px;
  background-image: url("imagens/excel.png");
  background-size: cover;
  opacity: 0.5;
}

.checkbox-btn__image::before {
  content: "";
  display: inline-block;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

.checkbox-btn input[type="checkbox"] {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

.checkbox-btn input[type="checkbox"]:checked ~ .checkbox-btn__image {
  opacity: 1;
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
  <h2>RELATÓRIO DE FALTAS</h2>
   
   <br>
    <div class="row">
<!--         <div class="col-sm-2">
          <br>
          <div class="checkbox-btn">
            <input type="checkbox" id="baixar_excel" name="baixar_excel">
            <label for="baixar_excel" class="checkbox-btn__label">
              <span class="checkbox-btn__image"></span>
              Baixar em excel?
            </label>
          </div>
        </div> -->

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
       <div class="col-sm-3">
         <div class="form-group">
          <label for="exampleInputEmail1">QUANTIDADE DE FALTAS</label>
          <select class="form-control"  id="quantidade_falta" name="quantidade_falta">
           <?php
         
           for ($i=1; $i < 60; $i++) { 

             if($i > 1){
               echo"<option value='$i'> $i ou + faltas consecutiva</option>
             ";

           }else{

             echo"<option value='$i'>+ de $i falta </option>
             ";
             
           }
         }
           ?>
          </select> 
         </div>
       </div>



        <div class="col-sm-4">
          <div class="form-group">
           <label for="exampleInputEmail1">ESCOLA</label>
           <select class="form-control"  id="escola" name="escola" >
            <?php 
            try {
              
           
             // if ($_SESSION['nivel_acesso_id']>=100) {
            ?>
                <option value="todas">TODAS</option>

         
            <?php  
             // }
              // $res_escola = lista_escola($conexao); 
              $res_escola= escola_associada($conexao,$idcoordenador);
              foreach ($res_escola as $key => $value) {
                $idescola = $value['idescola'];
                $nome_escola = $value['nome_escola'];
                echo "<option value='$idescola'>$nome_escola</option>";
              }
              } catch (Exception $e) {
                echo "$e";
              }
            ?>
            
          
           </select> 
          </div>
        </div>  




        <div class="col-sm-2">
          <div class="form-group">
          <a style="margin-top: 30PX;" class="btn btn-primary" onclick="pesquisa_relatorio_faltas_aluno()">Buscar</a>
          </div>
        </div>
      </div>
  <br>
  <table class="table table-bordered table-striped" id="tabela_pesquisa">
      
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
  <script type="text/javascript">
  const checkboxBtn = document.querySelector('.checkbox-btn input[type="checkbox"]');

  checkboxBtn.addEventListener('change', () => {
    const checkboxImage = checkboxBtn.parentNode.querySelector('.checkbox-btn__image');
    if (checkboxBtn.checked) {
      checkboxImage.style.opacity = 1;
    } else {
      checkboxImage.style.opacity = 0.5;
    }
  });

</script>

 <?php 

    include_once 'rodape.php';

 ?>