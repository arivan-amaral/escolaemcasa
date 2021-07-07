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

 $nome_turma='';
 $nome_disciplina='';
 if (isset($_GET['turma'])) {
   $nome_turma=$_GET['turma'];
 } 
 if (isset($_GET['disciplina'])) {
    $nome_disciplina=$_GET['disciplina'];

 }
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

       
      <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <button class="btn btn-block btn-lg btn-secondary"><?php

            $nome_turma='';
            $nome_disciplina='';
            if (isset($_GET['turma'])) {
              $nome_turma=$_GET['turma'];
            } 
            if (isset($_GET['disciplina'])) {
               $nome_disciplina=$_GET['disciplina'];

            }

             echo $nome_turma ." - ". $nome_disciplina; ?></button>
        </div>
      </div>
      <br>
      <br>

      <div class="row">
        <div class="col-sm-1"></div>
        
        <div class="col-sm-4">
          <div class="form-group">
            <label for="exampleInputEmail1">Data da aula</label>
            <input type="date" class="form-control" name="data_frequencia" id="data_frequencia" required="" >
            <!-- <input type="date" class="form-control" name="data_frequencia" id="data_frequencia" required="" onchange="lista_frequencia_aluno();"> -->
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
              <option value="AULA-4">AULA-4</option>
              
            </select>
          </div>
        </div>




        <div class="col-sm-3">
          <div class="form-group">
            <label for="exampleInputEmail1">Datas das aulas lançadas</label>

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

<!-- ####################################################################### -->


<div class="row">

    <div class="col-md-1"></div>



    <div class="col-md-10">

                <div class="card">

                  <div class="card-header">

                    <h3 class="card-title">FREQUÊNCIAS CADASTRADAS</h3>

                  </div>

                  <!-- /.card-header -->

                  <div class="card-body">

                    <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->

                    <div id="accordion">



       

                          <div class='card card-primary'>

                            <div class='card-header'>

                              <h4 class='card-title w-100'>



                                <a class='d-block w-100 collapsed' data-toggle='collapse' href='#collapseOne' aria-expanded='false'><b class='text-warning'>
                                    CLIQUE AQUI PARA VER AS FREQUÊNCIAS CADASTRADAS 
                                  </b>

                                </a>

                              </h4>

                            </div>

                            <div id='collapseOne' class='collapse' data-parent='#accordion' style=''>

                              <div class='card-body'>


                          

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

                               



                    </div>

                  </div>



                  <!-- /.card-body -->

                </div>

                <!-- /.card -->

              </div>

        </div>







    <!-- Main row -->

    <!-- /.row -->

  </div>


<!-- ####################################################################### -->


<input type="hidden" id="url_get" value="<?php echo $url_get; ?>">

  <div class="row" id="listagem_frequencia">


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
<script type="text/javascript">

  function seleciona_tudo(){

      var checkBoxes = document.querySelectorAll('.checkbox');
      var selecionados = 0;
      checkBoxes.forEach(function(el) {
         if(el.checked) {
             //selecionados++;
            el.checked=false;
         }else{
           
            el.checked=true;
         }
        
      });
      console.log(selecionados);

    }

// $("#checkTodos__").change(function () {
//     $("input:checkbox").prop('checked', $(this).prop("checked"));
// });

// $("#checkTodos__").click(function(){
//     $('input:checkbox').not(this).prop('checked', this.checked);
// });

// var checkTodos = $("#checkTodos");
// checkTodos.click(function () {
//   if ( $(this).is(':checked') ){
//     $('input:checkbox').prop("checked", true);
//   }else{
//     $('input:checkbox').prop("checked", false);
//   }
// });

</script>

 <?php 

    include 'rodape.php';

 ?>