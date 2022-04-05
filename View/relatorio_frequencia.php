<?php 
session_start();
include_once 'cabecalho.php'; 
include_once 'barra_horizontal.php'; 
include_once "menu.php"; 
include_once "alertas.php"; 
include_once "../Model/Conexao.php"; 



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
                RELATÓRIO DE FREQUÊNCIA
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
  <form method="GET">                 
   <div class="card-body">
      <div class="row">
        <div class="col-sm-3">
          <div class="form-group">
           <label for="exampleInputEmail1">DATA REGISTRO INICIAL</label>
           <input type="date" class="form-control" name="data_inicial" id="data_inicial">
          </div>
        </div>
         <div class="col-sm-3">
          <div class="form-group">
           <label for="exampleInputEmail1">DATA REGISTRO FINAL</label>
           <input type="date" class="form-control" name="data_final" id="data_final">
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
           <label for="exampleInputEmail1">QUANTIDADE DE FALTAS</label>
           <select class="form-control"  id="falta" name="falta">
            <?php
          
            for ($i=1; $i < 26; $i++) { 

              if($i > 1){
                echo"<option value='$i'>$i faltas</option>
              ";
            }else{
              echo"<option value='$i'>$i falta</option>
              ";
              
            }
          }
            ?>
           </select> 
          </div>
        </div>
        <div class="col-sm-3" style="margin-top: 7px;" ><br>
         <a  class="btn btn-primary" onclick="pesquisa_frequencia()">Pesquisar</a>
        </div>
      </div>
    </div>
  </form>
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
  function pesquisa_frequencia(){

    var result = document.getElementById('resultado');
    var falta = document.getElementById('falta').value;
    var data_inicial = document.getElementById('data_inicial').value;
    var data_final = document.getElementById('data_final').value;
      
    result.innerHTML = "<img src='imagens/carregando.gif'>";  
    var xmlreq = CriaRequest();
    xmlreq.open("GET", "../Controller/Relatorio_de_frequencia.php?falta="+falta+"&data_inicial="+data_inicial+"&data_final="+data_final, true);

    xmlreq.onreadystatechange = function(){
  
     if (xmlreq.readyState == 4) {
         if (xmlreq.status == 200) {
               result.innerHTML = xmlreq.responseText;

         }else{
               alert('Erro desconhecido, verifique sua conexão com a internet');

            result.innerHTML ="Erro ao receber mensagens";                 
         }
     }
    };
     xmlreq.send(null);
}
</script>


<!-- ######################################################################## -->
</div>
<?php include_once "rodape.php"; ?>