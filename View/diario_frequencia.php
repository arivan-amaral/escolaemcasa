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
  <form action="../Controller/Cadastrar_frequencia.php" method="post">
          <input type="hidden" name="url_get" value="<?php echo $url_get; ?>">

          <input type="hidden" name="idescola" id="idescola" value="<?php echo $idescola; ?>">
          <input type="hidden" name="idturma" id="idturma" value="<?php echo $idturma; ?>">
          <input type="hidden" name="iddisciplina" id="iddisciplina" value="<?php echo $iddisciplina; ?>">

       
      <div class="row">
        <div class="col-sm-1"></div>
        
        <div class="col-sm-4">
          <div class="form-group">
            <label for="exampleInputEmail1">Data da aula</label>
            <input type="date" class="form-control" name="data_frequencia" id="data_frequencia" required="" onchange="lista_frequencia_aluno();">
          </div>
        </div>   

        <div class="col-sm-4">
          <div class="form-group">
            <label for="exampleInputEmail1">Escolha a aula</label>

            <select class="form-control" id='aula' required  name='aula' onchange="lista_frequencia_aluno();">
              <option></option>
              <option value="AULA-1">AULA-1</option>
              <option value="AULA-2">AULA-2</option>
              <option value="AULA-3">AULA-3</option>
              
            </select>
          </div>
        </div>




        <div class="col-sm-3">
          <div class="form-group">
            <label for="exampleInputEmail1">Datas já lançadas</label>

            <select class="form-control" id="data_ja_lancada" onchange="data_frequencia_ja_cadastrada(this.value);" >
              <option></option>
              <?php 
                $resultado=listar_conteudo_aula_cadastrado($conexao, $iddisciplina, $idturma, $idescola, $idprofessor);
                foreach ($resultado as $key => $value) {
                  $data=$value['data'];
                  $aula=$value['aula'];
                  echo"<option value='$data' >".converte_data($data)." - $aula </option>";
                  
                }

               ?>
            </select>
          </div>
        </div>


      </div>




  <div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">

         <table class='table table-primary'>
              <thead>
                <tr>
                  <th style='width: 10px'>#</th>
                  <th>Avaliações</th>
                  <th>
                  Opções
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $resultado=listar_conteudo_aula_cadastrado($conexao, $iddisciplina, $idturma, $idescola, $idprofessor);
                      $conta=1;
                    foreach ($resultado as $key => $value) {
                      $conteudo_aula_id=$value['id'];
                      $data=$value['data'];
                      $aula=$value['aula'];
                      echo"
                      <tr>
                      <td>
                      $conta
                      <input type='hidden' id='conteudo_aula_id$conta' value='$conteudo_aula_id'>
                      </td>
                        <td>$aula - ".converte_data($data)."</td>
                        <td><a onclick='excluir_frequencia($conta);' class='btn btn-danger'>EXCLUIR FREQUÊNCIA</a></td>
                      </tr>";
                      $conta++;
                    }


                ?>

              </tbody>
        </table>
    </div>
  </div>
<input type="hidden" id="url_get" value="<?php echo $url_get; ?>">

  <div class="row" id="listagem_frequencia">


  </div>

   

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