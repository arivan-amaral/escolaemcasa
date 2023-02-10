<?php
session_start();

###################################################
if (!isset($_SESSION['idfuncionario'])) {
  //header("location:index.php?status=0");

}else{

  $idcoordenador=$_SESSION['idfuncionario'];

}
  include "cabecalho.php";
  include "alertas.php";
 
  include "barra_horizontal.php";
  include 'menu.php';
  include '../Controller/Conversao.php';

  include_once '../Model/Conexao.php';
  include_once '../Model/Coordenador.php';

  include '../Model/Setor.php';
  include '../Model/Chamada.php';
  include '../Model/Escola.php';


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
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="aluno.data_nascimento" id="data_nascimento">
          <label class="form-check-label" for="flexCheckDefault">
            Data de Nascimento
          </label>
        </div>

        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="aluno.cpf" id="cpf">
          <label class="form-check-label" for="flexCheckDefault">
            Cpf Aluno
          </label>
        </div>
      </div>
      
        <div class="col-sm-3">
          <div class="form-group">
           <label for="exampleInputEmail1">SEXO</label>
           <select class="form-control"  id="sexo" name="sexo" >
             <option value='todos'>Todos</option>
             <option value='M'>Masculino</option>
             <option value='F'>Feminino</option>
           </select> 
          </div>
        </div> 
        <div class="col-sm-3">
          <div class="form-group">
           <label for="exampleInputEmail1">ESCOLA</label>
           <select class="form-control"  id="escola" name="escola" >
            <?php  
       
              $res_escola= escola_associada($conexao,$idcoordenador);
                $lista_escola_associada=""; 
              $sql_escolas="AND ( escola_id = -1 ";
              $sql_escolas_enviada="AND ( escola_id_origem = -1 ";
              foreach ($res_escola as $key => $value) {
                  $id=$value['idescola'];
                 $nome_escola=($value['nome_escola']);
                  $sql_escolas.=" OR escola_id = $id ";
                  $sql_escolas_enviada.=" OR escola_id_origem = $id ";

                  $lista_escola_associada.= "
                       <option value='$id'>$nome_escola </option>

                   ";
              }

              echo "$lista_escola_associada";

            ?>
            
          
           </select> 
          </div>
        </div> 
        <div class="col-sm-2">
          <div class="form-group">
          <a style="margin-top: 30PX;" class="btn btn-primary" onclick="pesquisa_relatorio_filtros()">Pesquisar</a>
          </div>
        </div>
      </div>
  <br>
  <div class="table-responsive" id="resultado">
 
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