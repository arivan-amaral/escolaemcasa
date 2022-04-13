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
  $status = '';
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
              <h2 align="center">Chat</h2>
              <div class="container-fluid">
               
                  <?php  
                  $res_chamada = pesquisa_chat($conexao,$id_chamada);
                  foreach ($res_chamada as $key => $value) {
                    $descricao = $value['mensagem'];
                    $arquivo = $value['arquivo'];
                    $data = $value['data'];

                    echo "
                    <br>
                    <br>

                    <center>
                      <h5>Mensagem realizada: $data</h5>
                      <h6>Descrição:</h6>
                        <textarea type='text' class='form-control' rows='10'disabled>$descricao</textarea>
                      " ;
                      if($arquivo != ""){
                        echo "<h6>Anexo:</h6>
                      <a class='btn btn-block btn-success' href='chamadas/$arquivo' download>Arquivo</a>                      
                    </center>";
                      }
                  }
                  ?>
                    <?php  
                      $res_chamado= pesquisa_chamada($conexao,$id_chamada);
                      foreach ($res_chamado as $key => $value) {
                        $status = $value['status'];
                      }
                      if($status != 'finalizado'){
                      ?>
                      
                        <form class="mt-12" action="../Controller/Cadastrar_chat_chamado.php" method="post" enctype="multipart/form-data">

                        <br>
                        <h4 align="center">Responder</h4>
                        <br>
                         <h4 class="card-title">Anexo</h4>
                        <div class="form-group">
                            <input type="file" name="arquivo" class="form-control" >
                        </div>
                        <input type="hidden" name="id_funcionario" id="id_funcionario" value="<?php echo $idFuncionario ?>">
                        <input type="hidden" name="id_chamado" id="id_chamado" value="<?php echo $id_chamada ?>">
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
                        <button type="submit" class="btn btn-block btn-primary">Responder</button>
                      </div>
                    </form>
                    <?php
                      }
                    ?>
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