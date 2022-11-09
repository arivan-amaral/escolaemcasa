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

  include_once '../Model/Conexao.php';

  include '../Model/Setor.php';
  include '../Model/Chamada.php';
  include '../Model/Escola.php';

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
  <h2>RELATÓRIO DE ALUNO</h2>
   
   <br>
    <div class="row">
      <div class="col-sm-3" style="margin-left: 20px;">
          <div class="form-check">
          <input class="form-check-input" type="checkbox" value="aluno.idaluno" id="idaluno">
          <label class="form-check-label" for="flexCheckDefault">
            ID Aluno
          </label>
        </div>
         <div class="form-check">
          <input class="form-check-input" type="checkbox" value="aluno.nome" id="nome">
          <label class="form-check-label" for="flexCheckDefault">
            Nome
          </label>
        </div>
         <div class="form-check">
          <input class="form-check-input" type="checkbox" value="filiacao1" id="filiacao1">
          <label class="form-check-label" for="flexCheckDefault">
            1° Filiação
          </label>
        </div>
         <div class="form-check">
          <input class="form-check-input" type="checkbox" value="filiacao2" id="filiacao2">
          <label class="form-check-label" for="flexCheckDefault">
            2° Filiação
          </label>
        </div>
         <div class="form-check">
          <input class="form-check-input" type="checkbox" value="cartao_sus" id="cartao_sus">
          <label class="form-check-label" for="flexCheckDefault">
            Cartão Sus
          </label>
        </div>
         <div class="form-check">
          <input class="form-check-input" type="checkbox" value="aluno.whatsapp" id="whatsapp">
          <label class="form-check-label" for="flexCheckDefault">
            Whatsapp
          </label>
        </div>
         <div class="form-check">
          <input class="form-check-input" type="checkbox" value="aluno.whatsapp_responsavel" id="whatsapp_responsavel">
          <label class="form-check-label" for="flexCheckDefault">
            Whatsapp do Responsável
          </label>
        </div>
         <div class="form-check">
          <input class="form-check-input" type="checkbox" value="aluno.bairro_endereco" id="bairro">
          <label class="form-check-label" for="flexCheckDefault">
            Bairro
          </label>
        </div>
         <div class="form-check">
          <input class="form-check-input" type="checkbox" value="aluno.endereco" id="endereco">
          <label class="form-check-label" for="flexCheckDefault">
            Endereço
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="escola.nome_escola" id="nome_escola">
          <label class="form-check-label" for="flexCheckDefault">
            Nome da Escola
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="turma.nome_turma" id="nome_turma">
          <label class="form-check-label" for="flexCheckDefault">
            Nome da Turma
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="aluno.bolsa_familia" id="bolsa_familia">
          <label class="form-check-label" for="flexCheckDefault">
            Recebe Bolsa Familia
          </label>
        </div>
      </div>
      

        <div class="col-sm-3">
          <div class="form-group">
           <label for="exampleInputEmail1">ESCOLA</label>
           <select class="form-control"  id="escola" name="escola" >
            <?php  
              $res_escola = lista_escola($conexao);
              foreach ($res_escola as $key => $value) {
                $idescola = $value['idescola'];
                $nome_escola = $value['nome_escola'];
                echo "<option value='$idescola'>$nome_escola</option>";
              }

            ?>
            
          
           </select> 
          </div>
        </div> 
        <div class="col-sm-3">
          <div class="form-group">
          <a style="margin-top: 30PX;" class="btn btn-primary" onclick="pesquisa_relatorio_filtros()">Pesquisar</a>
          </div>
        </div>
      </div>
  <br>
  <div class="table-responsive">
    <table class="table table-bordered table-striped" id="resultado">
      
    </table>
  </div>
  
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