<?php 
session_start();
if (!isset($_SESSION['idprofessor'])) {
       header("location:index.php?status=0");

}else{

  $idprofessor=$_SESSION['idprofessor'];

}
  include "cabecalho.php";
  include "alertas.php";
  include "barra_horizontal.php";

  include 'menu.php';

  include '../Controller/Conversao.php';

  include '../Model/Conexao.php';

  include '../Model/Aluno.php';
  include '../Model/Professor.php';

  $idescola=$_GET['idescola']; 
  $idturma=$_GET['turm']; 
  $iddisciplina=$_GET['disc']; 
 $array_url=explode('p?', $_SERVER["REQUEST_URI"]);
 $url_get=$array_url[1];
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
             echo "$nome_escola_global"; 

             if (isset($_SESSION['nome'])) {

              echo " ".$_SESSION['nome'];  

            } 

             ?></b></h1>

          </div><!-- /.col -->

          <div class="col-sm-2">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Home</a></li>

              <li class="breadcrumb-item active">Início</li>

            </ol>

          </div><!-- /.col -->

        </div><!-- /.row -->

      </div><!-- /.container-fluid -->

    </div>

    <!-- /.content-header -->



    <!-- Main content -->

    <section class="content">

      <div class="container-fluid">
        <!-- Info boxes -->
        <!-- .row -->
  <form action="../Controller/Cadastrar_ocorrencia.php" method="post">
          
       
      <div class="row">
        <div class="col-sm-1"></div>
        
        <div class="col-sm-5">
          <div class="form-group">
            <label for="exampleInputEmail1">Data da ocorrência</label>
            <input type="date" class="form-control" name="data_ocorrencia" id="data_ocorrencia" required="" onchange="lista_ocorrencia_aluno();">
          </div>
        </div>   

        <div class="col-sm-5">
          <div class="form-group">
            <label for="exampleInputEmail1">Datas das ocorrências</label>

            <select class="form-control" name="data_ocorrencia_lancada" id='data_ocorrencia_lancada' onchange='lista_ocorrencia_aluno();'>
              <option></option>
              <?php 
                $resultado=listar_ocorrencia_cadastrado($conexao, $iddisciplina, $idturma, $idescola, $idprofessor);
                foreach ($resultado as $key => $value) {
                  $data_ocorrencia=$value['data_ocorrencia'];
                  echo"<option value='$data_ocorrencia'>".converte_data($data_ocorrencia)."</option>";
                  
                }

               ?>
            </select>
          </div>
        </div>

      </div>
  <div class="row" id="listagem_ocorrencia">


  </div>

   
<input type="hidden" name="url_get" value="<?php echo $url_get; ?>">

<input type="hidden" name="idescola" id="idescola" value="<?php echo $idescola; ?>">
<input type="hidden" name="idturma" id="idturma" value="<?php echo $idturma; ?>">
<input type="hidden" name="iddisciplina" id="iddisciplina" value="<?php echo $iddisciplina; ?>">

      <div class="row" id="botao_continuar">
        
      </div>
      
 </form>
        <!-- Main row -->

        <!-- /.row -->

      </div>





    </div>

  </section>

</div>


 <?php 

    include 'rodape.php';

 ?>