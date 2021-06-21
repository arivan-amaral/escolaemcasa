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
  <form action="../Controller/Cadastrar_diario_avaliacao_aluno.php" method="post">
          
       
      <div class="row">
        <div class="col-sm-1"></div>
        
        <div class="col-sm-5">
          <div class="form-group">
            <label for="exampleInputEmail1">Data da aula</label>
            <input type="date" class="form-control" name="data_avaliacao" id="data_avaliacao" required="" onchange="lista_avaliacao_aluno_por_data();">
          </div>
        </div>   

        <div class="col-sm-5">
          <div class="form-group">
            <label for="exampleInputEmail1">Período</label>

            <select class="form-control" id='periodo' name='periodo' onchange='lista_avaliacao_aluno_por_data();' required="">
              <option></option>
              <?php 
                $resultado=listar_trimestre($conexao);
                foreach ($resultado as $key => $value) {
                  $idperiodo=$value['id'];
                  $descricao=$value['descricao'];
                  echo"<option value='$idperiodo'>$descricao</option>";
                  
                }

               ?>
            </select>
          </div>
        </div>

      </div>
  <div id="listagem_avaliacao">


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