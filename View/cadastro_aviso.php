<?php
session_start();
if (!isset($_SESSION['idprofessor']) && !isset($_SESSION['idcoordenador'])) {

       header("location:index.php?status=0");

}else{

  $idfuncionario=$_SESSION['idfuncionario'];

}
include "cabecalho.php";
include "alertas.php";

  include "barra_horizontal.php";
  include 'menu.php';
  include '../Model/Conexao.php';
  include '../Controller/Conversao.php';
  include '../Model/Trabalho.php';


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
              if (isset($nome_escola_global)) {
                echo $nome_escola_global; 
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
              


                    <button type="button" class="btn btn-block  btn-secondary"> CADASTRO DE AVISO/TUTORIAL</button>
                    <br>
                    <form class="mt-12" action="../Controller/Cadastrar_aviso.php" method="post" enctype="multipart/form-data">


                      <h4 class="card-title" style="color:green;">Dia inicial para ficar visível</h4>
                        <div class="form-group">
                            <input type="date" name="data_visivel" class="form-control"  required="">
                        </div>

         
                      <h4 class="card-title" style="color:red;">Dia final para ficar visível</h4>
                        <div class="form-group">
                            <input type="date" name="data_visivel" class="form-control"  required="">
                        </div>

           


                   

                        <div class="card card-outline card-info">
                          <div class="card-header">
                            <h3  >
                              Descrição  (campo obrigatório)
                            </h3>
                            <b style="color: red;">POR FAVOR, NÃO COLOCAR EMOJI NOS CAMPOS</b>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                            <textarea name="descricao" id="summernote" rows="5" style="height: 245.719px;" required></textarea>

                          </div>
                          <div class="card-footer">
                            
                          </div>

                        </div>


                        <br>
                        <br>
                      
                      <div onclick='carregando()'>
                        <button type="submit" class="btn btn-block btn-primary">Enviar</button>
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




 <?php 

    include 'rodape.php';

 ?>