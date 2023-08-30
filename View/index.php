<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

  if (isset($_SESSION['cargo'])){
      
      if ($_SESSION['cargo']=="Aluno" or $_SESSION['cargo']=="Aluna"){
 
          header("Location:../View/aluno.php");
      }else if ($_SESSION['cargo']=="Professor"){

          header("Location:../View/professor.php");
      }else if ($_SESSION['cargo']=="Secretário"){
          
          header("Location:../View/secretario.php");
        
      }else if ($_SESSION['cargo']=="Coordenador"){
  
          header("Location:../View/coordenador.php");

      }


  }

  include_once "cabecalho.php";
  include_once "alertas.php";

  include_once "barra_horizontal.php";
  include_once 'menu.php';
  // include_once'../Model/Conexao.php';
  


?>
<script type="text/javascript">
  
      //Swal.fire('ATENÇÃO, O MÓDULO DE PROFESSOR e ALUNO ESTÃO EM MANUTENÇÃO.', '', 'info');
</script>


<div class="modal fade" id="modal-bem-vindo">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">BEM VINDO</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        

          <div class="modal-body">
              <!-- /corpo -->
          <center>

            <!-- <h1>ATENÇÃO, NÃO LANÇAR NOTA ANTES DAS 20:30, <font color="RED">SERVIDOR EM MANUTENÇÃO</font></h1> -->
             <iframe width="400" height="315" src="https://www.youtube.com/embed/86bozRFrNKs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </center>
            <p>ATENÇÃO, O vídeo acima possui conteúdo muito importante, assista!  </p>
              <!-- /corpo -->
        </div>
      <button type="button" class="btn btn-default" data-dismiss="modal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Fechar</font></font></button>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

<script src="ajax.js?<?php echo rand(); ?>"></script>

<div class="content-wrapper" style="min-height: 529px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 alert alert-warning">
            <center>
            <h1 class="m-0"><b>
              <?php
                if (isset($_SESSION['APLICACAO'])) {
                  echo str_replace('-', '', $_SESSION['APLICACAO']); 
                }
              ?>
              
             <?php if (isset($_SESSION['nome'])) {
              echo $_SESSION['nome'];  
            } 
             ?></b></h1>
            </center>

          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->


        <!-- /.row -->


        <div class="row">
          <!-- /.col -->
          <div class="col-md-12">



</script>


            <div class="card">
              <div class="card-header">
                <!-- <h3 class="card-title">EDUCA LEM</h3> -->
              </div>

         <!--      <button type="button" class="btn btn-block btn-danger btn-lg">
                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">SAIBA MAIS</font>
                </font>
              </button> -->
              <button type="button" class="btn btn-block btn-primary btn-lg" data-toggle='modal' data-target='#modal-default'>
                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">ENTRAR</font>
                </font>
              </button>

              <br>
              <br>
                <p><b style="color:black;">Atenção, o vídeo abaixo possui conteúdo muito importante, assista! </b> </p>
    
                 <iframe height="350" src="https://www.youtube.com/embed/86bozRFrNKs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
           


              <!-- /.card-header -->
            <!--   <div class="card-body">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    
                  </ol>
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img class="d-block w-100" src="imagens/agradecimento_matricula.jpeg" alt="First slide"  height="450">
                    </div>
                    <div class="carousel-item">
                      <img class="d-block w-100" src="imagens/slider1.jpg" alt="Second slide"  height="450">
                    </div>
                    <div class="carousel-item">
                      <img class="d-block w-100" src="imagens/psicopedagoga.png" alt="Third slide"  height="450">
                    </div>
                   
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-custom-icon" aria-hidden="true">
                      <i class="fas fa-chevron-left"></i>
                    </span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-custom-icon" aria-hidden="true">
                      <i class="fas fa-chevron-right"></i>
                    </span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
              </div> -->
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
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

<?php include_once 'rodape.php';?>