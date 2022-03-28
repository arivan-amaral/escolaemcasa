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
  include '../Model/Conexao.php';
  include '../Controller/Conversao.php';
  include '../Model/Setor.php';
  include '../Model/Chamada.php';

  $idFuncionario=$_SESSION['idfuncionario'];
  $id_chamada=$_POST['id_chamada'];

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
                echo $nome_escola_global; 
              }
              ?> 

             <?php if (isset($_SESSION['nome'])) {

              echo $_SESSION['nome'];  

            } 

             ?></b></h1>

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
                  <?php  
                  $res_chamada = pesquisa_chamada($conexao,$id_chamada);
                  foreach ($res_chamada as $key => $value) {
                    $descricao = $value['descricao'];
                  }
                  ?>
                  <h4 align="center">Informações da Chamada</h4>
                  <br>
                  <div class="col-md-12">
                    <div class="card card-outline card-info">
                      <div class="card-header">
                        <h3  >
                          Descrição da Chamada
                        </h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <textarea rows="5" style="height: 245.719px;" disabled>
                          <?php echo $descricao;  ?>
                        </textarea>
                      </div>
                    </div>
                     <form class="mt-12" action="../Controller/.php" method="post" enctype="multipart/form-data">
                        <br>
                        <h4 align="center">Responder a Chamada</h4>
                        <br>
                        <input type="hidden" name="id_funcionario" id="id_funcionario" value="<<?php echo $idFuncionario ?>">
                        <div class="card card-outline card-info">
                      <div class="card-header">
                        <h3  >
                          Descrição da Resposta
                        </h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <textarea rows="5" style="height: 245.719px;" name="resposta" id="summernote" required="">
                        </textarea>
                      </div>
                    </div>
                      <div onclick='carregando();'>
                        <button type="submit" class="btn btn-block btn-primary">Responder Chamado</button>
                      </div>
                    </form>                    
                  </div>
                </div>



                <div class="row">
                  <div class="col-md-12">

                    <!-- The time line -->


                    <div class="timeline">
<br>
<br>
<br>

<script type="text/javascript">

 function carregando(){


    var descricao =  document.getElementById("summernote").value;
    var setor =  document.getElementById("setor").value;
    var funcionario =  document.getElementById("funcionario").value;

  if (descricao=="" || setor=="") {
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

                      <div>
                        <i class='fas fa-clock bg-gray'></i>
                      </div>
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


 <?php 

    include 'rodape.php';

 ?>