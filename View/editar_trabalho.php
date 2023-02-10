<?php
session_start();
if (!isset($_SESSION['idprofessor']) && !isset($_SESSION['idcoordenador'])) {

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
include '../Model/Trabalho.php';

$idescola=$_GET['idescola'];
$idturma=$_GET['turm'];
$idserie=$_GET['idserie'];
$iddisciplina=$_GET['disc'];
$idtrabalho=$_GET['idtrabalho'];

 $array_url=explode('p?', $_SERVER["REQUEST_URI"]);
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

            <li class="breadcrumb-item active">Aulas</li>

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



        <button type="button" class="btn btn-block  btn-success"><?php echo $_GET['turma']."  - ".$_GET['disciplina']; ?></button>
        <br>
        <form class="mt-12" action="../Controller/Editar_trabalho.php" method="post" enctype="multipart/form-data">

          <?php 

          $res_tra=listar_trabalho_aluno_por_idtrabalho($conexao,$idtrabalho);
          foreach ($res_tra as $key => $value) {
              $titulo=$value['titulo'];
              $data_hora_visivel=$value['data_hora_visivel'];
              $descricao=$value['descricao'];
              $data_entrega=data_simples($value['data_entrega']);
              
              $data_visivel=data_simples($data_hora_visivel);
              $hora_visivel=hora($data_hora_visivel);

              echo"<h4 class='card-title'>Título da Atividade</h4>
              <div class='form-group'>
                <input type='text' name='titulo' class='form-control' autocomplete='off'  required value='$titulo'>
              </div>

              <h4 class='card-title'>Dia para ficar visível</h4>
              <div class='form-group'>
                <input type='date' name='data_visivel' class='form-control'  required value='$data_visivel'>
              </div>

              <h4 class='card-title'>Hora para ficar visível</h4>
              <div class='form-group'>
                <input type='time' name='hora_visivel' class='form-control'  required value='$hora_visivel'>
              </div>

              <div class='card card-outline card-info'>
                <div class='card-header'>
                  <h3  >
                    Descrição da Atividade (campo obrigatório)
                  </h3>
                  <b style='color: red;'>POR FAVOR, NÃO COLOCAR EMOJI NOS CAMPOS DA ATIVIDADE </b>
                </div>
                <!-- /.card-header -->
                <div class='card-body'>
                  <textarea name='descricao' id='summernote' rows='5' style='height: 245.719px;' required>$descricao</textarea>

                </div>
                <div class='card-footer'>

                </div>

              </div>

              <h4 class='card-title'>Data de Entrega </h4>
              <div class='form-group'>
                <input type='date' name='data_entrega' class='form-control'  required value='$data_entrega'>
              </div>";
          }
   ?>




          <input type="hidden" name="idescola" id="idescola" value="<?php echo $idescola; ?>" class="form-control" required="">
          <input type="hidden" name="turma_id" value="<?php echo $_GET['turm']; ?>" class="form-control" required="">

          <input type="hidden" name="disciplina_id" value="<?php echo $_GET['disc']; ?>" class="form-control" required="">
          <input type="hidden" name="idtrabalho" value="<?php echo $idtrabalho; ?>" class="form-control" required="">
          <input type="hidden" name="url_get" value="<?php echo $url_get; ?>" class="form-control" required="">

          <div style="background-color:#808080; padding:10px;border-radius: 1%;">

            <p> <font color='red'>Escolha as turma abaixo que esse trabalho/atividade será cadastrado. </font></p>
            <?php

            $result_disciplinas=$conexao->query("SELECT * FROM ministrada,escola,turma,disciplina where
             ministrada.turma_id=idturma and
             ministrada.disciplina_id=iddisciplina and 
             ministrada.escola_id=idescola and
             ministrada.escola_id=idescola and

             idescola=$idescola and
             professor_id=$idprofessor and
             serie_id=$idserie and 
             disciplina_id=$iddisciplina

             ");

            foreach ($result_disciplinas as $key => $value) {
             $turma_id=$value['idturma'];
             $nome_turma=$value['nome_turma'];
             $nome_disciplina=$value['nome_disciplina'];

             if ($idturma==$turma_id) {
              echo"
              <div class='custom-control custom-checkbox'>
              <input class='custom-control-input' name='idturma[]' type='checkbox' id='customCheckbox$turma_id' value='$turma_id' required checked>
              <label for='customCheckbox$turma_id' class='custom-control-label'>$nome_turma - $nome_disciplina</label>
              </div>";

            } else {
              // echo"
              // <div class='custom-control custom-checkbox'>
              // <input class='custom-control-input' name='idturma[]' type='checkbox' id='customCheckbox$turma_id' value='$turma_id'  >
              // <label for='customCheckbox$turma_id' class='custom-control-label'>$nome_turma - $nome_disciplina</label>
              // </div>";


            }
          }

          ?>
        </div>
        <br>
        <br>

        <div onclick='carregando()'>
          <button type="submit" class="btn btn-block btn-primary">Salvar alterações</button>
        </div>
      </form>


    </div>
  </div>





  <script type="text/javascript">

   function carregando(){


    var descricao =  document.getElementById("summernote").value
    if (descricao=="") {
      Swal.fire('Preencha os campos obrigatorios!', '', 'info');
      


    }else{
      let timerInterval
      Swal.fire({
        title: 'Aguarde, ação está sendo realizada...',
        html: '',
        timer: 200000,
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
    }//else
  }


</script>




















<!-- /.content -->

</div>        

</div>

</div>

</section>

</div>




<div class='modal fade' id='modal-default'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h4 class='modal-title'>Escolha o aluno</h4>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <div class='modal-body' id="listar_alunos">


      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


<?php 

include 'rodape.php';

?>