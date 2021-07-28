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

  include '../Model/Conexao.php';

  include '../Model/Aluno.php';

  include '../Controller/Conversao.php';

  include '../Model/Questionario.php';



  $idturma=$_GET['turm'];

  $iddisciplina=$_GET['disc'];
  $turma=$_GET['turma'];
  $disciplina=$_GET['disciplina'];

  $idturma=$_GET['turm'];
  $idescola=$_GET['idescola'];

  $data=date("Y-m-d H:i:s");

  

?>



<script src="ajax.js"></script>



<div class="content-wrapper" style="min-height: 529px;">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-10 alert alert-warning">

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

                  <div class="col-md-12">

                    

                        <h3 class="card-title">Lista de Questionário</h3>

                        <select class="form-control" id='questionario' >
                            
                            <?php 
 

                            $turma_id=$_GET['turm'];
                            $disciplina_id=$_GET['disc'];
                           

                                $listar_questao=listar_questionario_ativo($conexao,$idprofessor,$turma_id,$disciplina_id);
                                $conta=1;
                                foreach ($listar_questao as $key => $value) {
                                  $idquestionario=$value['id'];
                                  $questionario=converter_utf8($value['nome']);
                                  echo "
                                    <option value='$idquestionario'> $questionario </option>

                                  ";
                                }

                            ?>
                        </select>
                       <?php 

                        echo "
                        <input type='hidden' id='disciplina_id' value='$disciplina_id'>
                        <input type='hidden' id='turma_id' value='$turma_id'>
                        ";

                      ?>


                  <h3 class="card-title">Escolha o Aluno</h3>
                        <select class="form-control" id='aluno' onchange="resultado_questao();" >
                          <option></option>
                            <?php 
                                $listar_aluno=listar_aluno_da_turma_professor($conexao,$idturma,$idescola);
                                
                                // $listar_aluno=listar_aluno_da_turma($conexao,$turma_id);
                                $conta=1;
                                foreach ($listar_aluno as $key => $value) {
                                  $idaluno=$value['idaluno'];
                                  $nome_aluno=converter_utf8($value['nome_aluno']);
                                  echo "
                                    <option value='$idaluno' >$nome_aluno</option>

                                  ";
                                }

                            ?>
                        </select>
                        <br>


                <div  id="resultado_questao">


                </div>
            

                  </div>        

                </div>

              </div>

            </section>

</div>

<aside class="control-sidebar control-sidebar-dark">

  <!-- Control sidebar content goes here -->

</aside>


<script type="text/javascript">

 function carregando(){
        let timerInterval
        Swal.fire({
          title: 'Aguarde, sua atividade está sendo enviada!',
          html: ' <b></b> ',
          timer: 100000,
          timerProgressBar: true,
          didOpen: () => {
            Swal.showLoading()
            timerInterval = setInterval(() => {
              const content = Swal.getContent()
              if (content) {
                const b = content.querySelector('b')
                if (b) {
                  b.textContent = Swal.getTimerLeft()
                }
              }
            }, 100)
          },
          willClose: () => {
            clearInterval(timerInterval)
          }
        }).then((result) => {
          /* Read more about handling dismissals below */
          if (result.dismiss === Swal.DismissReason.timer) {
            console.log('I was closed by the timer')
          }
        })
  }

</script>




  <!-- /.control-sidebar -->

  <script type="text/javascript">

function refreshPage(){
    window.location.reload();
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

    include 'rodape_pesquisas.php';

 ?>