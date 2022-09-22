<?php 
set_time_limit(0);
session_start();
include_once 'cabecalho.php'; 
include_once 'barra_horizontal.php'; 
include_once "menu.php"; 
include_once "alertas.php"; 
include_once "../Model/Conexao.php"; 
include_once "../Model/Turma.php"; 
include_once "../Model/Escola.php"; 


$idturma=$_GET['idturma']; 
$idescola=$_GET['idescola'];
$idescola_get=$_GET['idescola'];

$rematricula_escola_id=$_GET['idescola']; 
$serie_id=$_GET['idserie']; 
$idserie=$_GET['idserie']; 
$idserie_atual=$_GET['idserie']; 

$array_url=explode('php?', $_SERVER["REQUEST_URI"]);
$url_get=$array_url[1];

?>
  <!-- Main Sidebar Container -->
<div class="content-wrapper">


<!-- ####################### CORPO ################################################# -->
<script type="text/javascript" src="ajax.js?<?php echo rand(); ?>"></script>

      <div class="container-fluid">
<br>
        <div class="row">
          <div class="col-sm-1"></div>
          <div class="col-sm-10">
            <button class="btn btn-block btn-lg btn-secondary">
              <?php
              $nome_turma_global='';
              $nome_disciplina='';
              $res_turma=lista_de_turmas_por_id($conexao,$idturma);

              foreach ($res_turma as $key => $value) {
                $nome_turma_global=$value['nome_turma'];
              }           

              $nome_escola_global='';
        $res_escola=buscar_escola_por_id($conexao,$idescola);
        $nome_escola_global="";
        foreach ($res_escola as $key => $value) {
          $nome_escola_global=$value['nome_escola'];
        }    


              echo "$nome_escola_global-  <b class='text-warning'>$nome_turma_global </b>"  ; ?></button>
            </div>
          </div>
          <br>
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
           <input type="hidden" class="form-control" name="idturma" id="idturma" value="<?php echo $idturma; ?>">
           <input type="hidden" class="form-control" name="idescola" id="idescola" value="<?php echo $idescola; ?>">
          </div>
        </div>
         <div class="col-sm-3">
          <div class="form-group">
           <label for="exampleInputEmail1">DATA REGISTRO FINAL</label>
           <input type="date" class="form-control" name="data_final" id="data_final">
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
           <label for="exampleInputEmail1">QUANTIDADE DE FALTAS</label>
           <select class="form-control"  id="falta" name="falta">
              <option value='Total'>Total</option>

            <?php
          
            for ($i=1; $i < 26; $i++) { 

              if($i > 1){
                echo"<option value='$i'>$i faltas consecutivas</option>
              ";
            }else{
              echo"<option value='$i'>$i falta consecutiva</option>
              ";
              
            }
          }
            ?>
           </select> 
          </div>
        </div>
        <div class="col-sm-2" style="margin-top: 7px;" ><br>
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
    

 


<!-- ######################################################################## -->
</div>
<?php include_once "rodape.php"; ?>