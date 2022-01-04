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

  $idescola=$_GET['idescola']; 
  $idturma=$_GET['idturma']; 
  $iddisciplina=$_GET['iddisciplina']; 
  $idserie=$_GET['idserie']; 

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

       <div class="card-body">

        <table class="table table-bordered">

          <thead>
            <tr>
              <th style="width: 10px">#id</th>
              <th>Dados do Aluno</th>
              <th>Opção</th>
            </tr>
          </thead>

          <tbody>
            <?php
            $conta_aluno=1; 
            $matricula_aluno="";
            $res_alunos=listar_aluno_da_turma_ata_resultado_final($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
             foreach ($res_alunos as $key => $value) {

              $idaluno=$value['idaluno'];
              $nome_aluno=$value['nome_aluno'];
              $matricula_aluno=$value['matricula'];

            // pesquisar_aluno_da_turma_ata_resultado_final
              $res_movimentacao=pesquisar_aluno_da_turma_ata_resultado_final($conexao,$matricula_aluno,$_SESSION['ano_letivo']);

              $data_evento="";
              $descricao_procedimento="";
              $procedimento="";
              $matricula="";
              foreach ($res_movimentacao as $key => $value) {
                  $datasaida=($value['datasaida']);
                  $matricula=($value['matricula']);
                  $data_evento=converte_data($value['data_evento']);
                  $descricao_procedimento=$value['descricao_procedimento'];
                  $procedimento=$value['procedimento'];
                  
                  if ($datasaida!="") {
                    $datasaida=converte_data($datasaida);
                  }
              }
  // <b class='text-primary'> $nome_turma</b><BR>
          // <b class='text-danger'>$email  </b><BR>
          // <b class='text-danger'>Senha: $senha  </b><BR>
    echo "

       <tr>
        <td>$id</td>

        <td> 
          <b class='text-success'> $nome_aluno </b> <BR>
          <b class='text-danger'> $procedimento $datasaida  </b> <BR>
        
        </td>
        <td> ";
        if ($procedimento=='EVADIDO' || $procedimento=='CANCELADO' || $procedimento=='FALECIDO' || $procedimento=='MATRICULA INDEFERIDA') {
          //  echo"<div class='form-group'>
          //   <div class='custom-control custom-switch custom-switch-off-danger custom-switch-on-success '>
          //     <input type='checkbox' class='custom-control-input' id='customSwitch3$id' onclick='mudar_status_aluno(1,$id)'>

          //     <label class='custom-control-label' for='customSwitch3$id'></label>
          //   </div>
          // </div>";
        }else{
          
           // echo"<div class='form-group'>
           //    <div class='custom-control custom-switch custom-switch-on-success custom-switch-off-danger'>
           //      <input type='checkbox' class='custom-control-input' id='customSwitch3$id' onclick='mudar_status_aluno(0,$id)' checked>

           //      <label class='custom-control-label' for='customSwitch3$id' id='customSwitch3$id' ></label>
           //    </div>
           //  </div>";
          
        }
        

        echo"</td>

      </tr>
    ";


          }
?>

            <?php 
               // $result= listar_aluno_da_turma_professor($conexao,$idturma,$idescola);

               // foreach ($result as $key => $value) {
               //  $nome_aluno=utf8_decode($value['nome_aluno']);
               //  $nome_turma=($value['nome_turma']);
               //  $id=$value['idaluno'];
               //  $status_aluno=$value['status_aluno'];
               //  $email=$value['email'];
               //  $senha=$value['senha'];
               //  $etapa_id=$value['etapa_id'];

               //    echo "
               //       <tr>
               //        <td>$id</td>

               //        <td> 
               //        <a onclick='relatorio_de_visualizacao_video($id,$idturma,$iddisciplina);' >
               //          <b class='text-secondary'> $nome_turma</b><BR>
               //          <b class='text-success'> $nome_aluno </b> <BR>
               //          <b class='text-secondary'>$email  </b><BR>
               //          <b class='text-secondary'>Senha: $senha  </b><BR>
               //        </a><br>
               //        <span id='relatorio_de_visualizacao_video$id'>

               //        </span>
               //        </td>
               //        <td> 
               //        <a onclick='relatorio_de_visualizacao_video($id,$idturma,$iddisciplina);' class='btn btn-primary'>RELATÓRIO DE VISUALIZAÇÕES</a>
               //        <br>
               //        ";

               //          if ($idserie==16) {

               //              echo"<label for='exampleInputEmail1'>Escolha a etapa </label>
               //                        <select class='form-control' id='etapa$id' onchange='muda_etapa($id)' required>
               //                        ";


               //                        if ($etapa_id!="") {
               //                          $res2=$conexao->query("SELECT * FROM etapa_multissereada WHERE id=$etapa_id");
               //                          foreach ($res2 as $key2 => $value2) {
               //                            $nome_etapa=$value2['etapa'];
               //                            echo"
               //                            <option value='$etapa_id'>$nome_etapa</option>
               //                            ";
               //                          }
               //                        }else{
               //                          echo "
               //                          <option></option>
               //                          ";
               //                        }
               //            $res=$conexao->query("SELECT * FROM etapa_multissereada WHERE turma_id=$idturma");
               //            foreach ($res as $key => $value) {
               //              $idetapa=$value['id'];
               //              $nome_etapa=$value['etapa'];
               //              echo"
               //              <option value='$idetapa'>$nome_etapa</option>
               //              ";
               //            }

               //                echo"</select>";
               //          }

               //        echo"</td>

               //      </tr>
               //    ";
               // }
            ?>



            </tbody>

          </table>

        </div>

        

      </div>

 

        <!-- Main row -->

        <!-- /.row -->

      </div>





    </div>

  </section>

</div>

<aside class="control-sidebar control-sidebar-dark">

  <!-- Control sidebar content goes here -->

</aside>

  <!-- /.control-sidebar -->

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


<!--   <script>
    function removerChecked(id) {
        var ele = document.getElementByName(id);
        for(var i=0;i<ele.length;i++){
           ele[i].checked = false;
        }
    }

    function addChecked(id) {
        var ele = document.getElementByName(id);
        for(var i=0;i<ele.length;i++){
           ele[i].checked = true;
        }
    }
  </script> -->




 <?php 

    include 'rodape.php';

 ?>