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
include_once '../Model/Conexao.php';
include '../Controller/Conversao.php';
include '../Model/Questionario.php';
include '../Model/Turma.php';
include '../Model/Professor.php';




$array_url=explode('.php', $_SERVER["REQUEST_URI"]);
$url_get=$array_url[1];



?>



<script src="ajax.js?<?php echo rand(); ?>"></script>



<div class="content-wrapper" style="min-height: 529px;">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-12 alert alert-warning">

            <h1 class="m-0"><b>

             <?php
             if (isset($nome_escola_global)) {
                echo $_SESSION['NOME_APLICACAO']; 
            }
            ?>

            <?php if (isset($_SESSION['nome'])) {

              echo $_SESSION['nome'];  

          } 

      ?></b></h1>

  </div><!-- /.col -->

  <div class="col-sm-2">

    <ol class="breadcrumb float-sm-right">

      <li class="breadcrumb-item"><a href="#">Home</a></li>

      <li class="breadcrumb-item active">Questionário</li>

  </ol>

</div><!-- /.col -->

</div><!-- /.row -->

</div><!-- /.container-fluid -->

</div>

<!-- /.content-header -->



<!-- Main content -->



</section>



<!-- Main content -->

<section class="content">

  <div class="container-fluid">


    <div class="row">
      <div class="col-md-12">

          <button type="button" class="btn btn-block  btn-secondary">CADASTRO DE QUESTIONARIOS</button>


          <form class="mt-12" action="../Controller/Cadastrar_questionario.php" method="post" enctype="multipart/form-data">
            <br>
            <b>Nome do Questionário</b>
            <div class="form-group">
                <input type="text" name="nome" class="form-control" autocomplete="off"  required="">
            </div>




            <div style="background-color:#B0C4DE; padding:10px;border-radius: 1%;">

              <b> <font color='blue'>Escolha as turmas e/ou disciplinas que receberão esse questionário. </font></b>
              <?php



              $result_disciplinas=listar_disciplina_professor($conexao,$idprofessor,$_SESSION['ano_letivo']);



              foreach ($result_disciplinas as $key => $value) {

                $disciplina=($value['nome_disciplina']);
                $nome_escola=($value['nome_escola']);
                $turma=($value['nome_turma']);
                $idescola=($value['idescola']);
                $iddisciplina=$value['iddisciplina'];
                $idturma=$value['idturma'];
                $idserie=$value['serie_id'];

                echo"
                <div class='custom-control custom-checkbox'>
                <input class='custom-control-input check' name='escola_turma_disciplina[]' type='checkbox' id='customCheckbox$idturma$idescola$iddisciplina' value='$idescola+$idturma+$iddisciplina+$idserie'>
                <label for='customCheckbox$idturma$idescola$iddisciplina' class='custom-control-label'> $nome_escola - $turma -$disciplina</label>
                </div>";




            }

            ?>
        </div>
        <br>
        <br>




        <b>Data de Início</b>
        <div class="form-group">
            <input type="date" name="data" class="form-control"  required="">

        </div>        

        <b>Data final</b>
        <div class="form-group">
            <input type="date" name="data_final" class="form-control"  required="">

        </div>




        <h4>Hora de Início (horários que os alunos poderão acessar a prova)</b>
            <div class="form-group">
                <input type="time" class="form-control" name="hora_inicio" value="00:00" required>
            </div>
        
        <h4>Hora de Fim</b>
                <div class="form-group">
                    <input type="time" class="form-control" name="hora_fim" value="23:59" required>
                </div>




                <input type="hidden" name="url_get" value="<?php echo $url_get ?>" class="form-control" required="">

<input type="text" id="testa" name="testa" value="" required="" style="display: none;">

            <div  onclick='carregando();'>
                <button type="submit" class="btn waves-effect waves-light btn-lg btn-primary">
                  Cadastrar
              </button>
          </div>

          </form>


      </div>
  </div>



  <div class="row">
      <div class="col-md-12">

          <br>      
          <div class="table">
            <a class="btn btn-block btn-info" name="#questionario">Lista de Questionário Enviados</a>

            <table id="zero_config" class="table">
                <thead>
                    <tr>

                     <th>Título</th>

                     <th>Opção</th>


                 </tr>
             </thead>
             <tbody>


                <?php 


                $result_disciplinas_t=listar_disciplina_professor($conexao,$idprofessor,$_SESSION['ano_letivo']);
                    $conta=0;
                foreach ($result_disciplinas_t as $key => $value) {                            
                    $idescola=$value['idescola'];
                    $disciplina_id=$value['iddisciplina'];
                    $turma_id=$value['idturma'];

                    $disciplina=($value['nome_disciplina']);
                    $nome_escola=($value['nome_escola']);
                    $turma=($value['nome_turma']);

                    $result=listar_questionario_professor($conexao,$idescola,$turma_id,$disciplina_id);
                    foreach ($result as $key => $value) {
                      $id=$value['id'];
                      $nome=($value['nome']);
                      $status=$value['status'];
                      $data=$value['data'];
                      $data_fim=$value['data_fim'];
                      $origem_questionario_id=$value['origem_questionario_id'];
                      $cor='';
                      if ($conta%2==0) {
                        $cor='#D3D3D3';
                      }else{
                        $cor='';

                      }

                    echo "
                    <tr style='background-color:$cor' id='linha$id'>


                    <td>
                    id: $id <b>$nome_escola - $turma - $disciplina</b><br>

                    <b style='background-color:#CD853F'>$nome</b><br>
                    Data início<br>
                    <input type='date' value='$data' onchange='alterar_data_questionario($id);' id='data$id' > 
                    
                   <br> Data final<br>
                    <input type='date' value='$data_fim' onchange='alterar_data_questionario($id);' id='data_fim$id' >
                    <span class='alert-success' id='resposta_alteracao_data$id'></span>
                    <br>

                    ";

                    if ($status==1) {
                      echo"
                      <b class='text-success'>
                      Ativo
                      </b>
                      <br>
                      ";
                     }else{
                        echo"
                        <b class='text-danger'>
                        Desativado
                        </b>
                        <br>";
                    }




                 if ($status==1) {
                      echo"
                      <a  onclick='alterar_status_questionario($id,$status);'>

                      <span class='btn btn-primary'>
                      Desativar
                      </span>
                      </a>
                      <br>
                      <br>
                      ";
                  }else if ($status==0) {
                      echo"
                      <a onclick='alterar_status_questionario($id,$status);'>

                      <span class='btn btn-warning'>
                      Ativar
                      </span>
                      </a>  

                      <a onclick='excluir_questionario($id);'>

                      <span class='btn btn-danger'>
                      Excluir definitivamente?
                      </span>
                      </a>
                      <br>
                      <br>
                      ";
                  }

                  echo "
                  </td>

                  <td>
                  
                  <a  href='resultado_questionario.php?disc=$disciplina_id&turm=$turma_id&idescola=$idescola&idserie=$idserie' class='btn btn-info btn-block btn-flat'>

                          <ion-icon name='eye'></ion-icon>

                            Acompanhar Prova/Testes                                           

                  </a> 
                  <br>


                  <a href='adicionar_questao.php?nome=$nome&id=$id&turma_id=$turma_id&disciplina_id=$disciplina_id&origem_questionario_id=$origem_questionario_id'>
                  <span class='btn btn-primary btn-block btn-flat'>
                  Adicionar Questões
                  </span>
                  </a>

                  <br>
          

                  <a href='adicionar_horario_individual_questionario.php?nome=$nome&id=$id&turma_id=$turma_id&disciplina_id=$disciplina_id&idescola=$idescola'>
                  <span class='btn btn-secondary btn-block btn-flat'>
                  Agendar Hórario Individual
                  </span><br><br>
                  </a> 

      

                  </td>";

                  echo "
                  </tr>



                  <div class='modal fade' id='modal-$id'>
                  <div class='modal-dialog'>
                  <div class='modal-content'>
                  <div class='modal-header'>
                  <h4 class='modal-title'>COPIAR PARA!</b>
                  <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                  </button>
                  </div>


                  <div class='modal-body'>
                  <!-- corpo -->
                  <form action='../Controller/Copiar_questionario_para_outra_turma.php' method='post' enctype='multipart/form-data'>

                  <input type='hidden' value='$id' name='idquestionario'>
                  <input type='hidden' value='$idescola' name='idescola'>
                  <input type='hidden' value='$url_get' name='url_get'>

                  <div class='row'>
                  <div class='col-4'>
                  <label><b>Hora início</b></label>
                  <input type='time' class='form-control' name='hora_inicio' required>

                  </div>

                  <div class='col-4'>
                  <label><b>Hora fim</b></label>
                  <input type='time' class='form-control' name='hora_fim' required>

                  </div>
                  </div>
                  <br>                                                                 

                  ";
              $conta++;
          }
      }

      ?>
  </tbody>


</table>

</div>               



<!-- /.content -->

</div>        

</div>

</div>

</section>

</div>

<aside class="control-sidebar control-sidebar-dark">

  <!-- Control sidebar content goes here -->

</aside>

<!-- /.control-sidebar -->

<script type="text/javascript">

function carregando() {

    checkBoxes = document.getElementsByClassName("check")
    noCheckedBoxes = true
    for (i = 0; i< checkBoxes.length; ++i) {
        if(checkBoxes[i].checked) {
            noCheckedBoxes = false
        }
    }

    if(noCheckedBoxes) {
        document.getElementById("testa").value="";
        Swal.fire({
                  icon: 'info',
                  title: 'Atenção',
                  text: 'Marque todos os campo obrigatórios e  pelo menos uma disciplina, para cadastrar o questionário!',
                  
                });


    }else{
        document.getElementById("testa").value=" ";

    }

}





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



<?php 

include 'rodape.php';

?>