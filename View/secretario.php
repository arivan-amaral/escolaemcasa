<?php
session_start();
if (!isset($_SESSION['idsecretario'])) {
  header("location:index.php?status=0");

}else{

 $idfuncionario=$_SESSION['idsecretario'];

}
 include "cabecalho.php";
  include "alertas.php";
 
  include "barra_horizontal.php";
  include 'menu.php';
  include '../Controller/Conversao.php';

  include_once '../Model/Conexao.php';

  include '../Model/Coordenador.php';
  include '../Model/Escola.php';

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
                echo NOME_APLICACAO; 
              }
              ?>

             <?php if (isset($_SESSION['nome'])) {

              echo " ".$_SESSION['nome'];  

            } 

             ?></b></h1>

          </div><!-- /.col -->

 <!-- /.col -->

        </div><!-- /.row -->

      </div><!-- /.container-fluid -->

    </div>

    <!-- /.content-header -->



    <!-- Main content -->

    <section class="content">

      <div class="container-fluid">

        <!-- Info boxes -->

     

        <div class="row">

                   <!-- .row -->

              <div class="col-md-1"></div>



              <div class="col-md-10">

                <?php 

                  $res_dados_aluno=dados_coordenador($conexao,$idfuncionario);
                  $cont=0;
                  foreach ($res_dados_aluno as $key => $value) {
                    $nome=$value['nome'];
                    $imagem=$value['foto'];
                      echo "

                      <style>
                  .quadro {
                    background-image: url(imagens/logo_educalem_natal.png);
                    background-repeat: no-repeat;
                    // background-attachment: fixed;
                    background-position: center;
                     
                        background-size: 100% 100%;
                  }
                  </style>

                          <div class='card card-widget widget-user shadow-lg quadro'>

                            <!-- Add the bg color to the header using any of the bg-* classes -->

                            <div class='widget-user-header text-white'>



                              <h3 class='widget-user-username text-right'>$nome</h3>

                              <h5 class='widget-user-desc text-right'>Secretário (a) </h5>

                            </div>



                            <div class='widget-user-image'>

                              <img class='img-circle' src='fotos/$imagem' alt='User Avatar'>

                            </div>

                            <div class='card-footer'>

                              

                                

                              <!--

                              <ul class='nav flex-column'>

                                                <li class='nav-item'>

                                                  <a href='#' class='nav-link'>

                                                    Projects <span class='float-right badge bg-primary'>31</span>

                                                  </a>

                                                </li>

                                                <li class='nav-item'>

                                                  <a href='#' class='nav-link'>

                                                    Tasks <span class='float-right badge bg-info'>5</span>

                                                  </a>

                                                </li>

                                                <li class='nav-item'>

                                                  <a href='#' class='nav-link'>

                                                    Completed Projects <span class='float-right badge bg-success'>12</span>

                                                  </a>

                                                </li>

                                                <li class='nav-item'>

                                                  <a href='#' class='nav-link'>

                                                    Followers <span class='float-right badge bg-danger'>842</span>

                                                  </a>

                                                </li>

                                              </ul>

                                               -->

                            </div>

                          </div>

                          ";
                          $cont++;

                  }



                  if ($cont==0) {

                       

                      echo "<!-- Widget: user widget style 1 -->


                      <style>
                        .quadro {
                          background-image: url(imagens/logo_educalem_natal.png);
                          background-repeat: no-repeat;
                          // background-attachment: fixed;
                          background-position: center;
                           
                              background-size: 100% 100%;
                        }
                        </style>
                          <div class='card card-widget widget-user shadow-lg quadro'>

                            <!-- Add the bg color to the header using any of the bg-* classes -->

                            <div class='widget-user-header text-black'>



                              <h3 class='widget-user-username text-right'>".$_SESSION['nome']."</h3>

                               <h5 class='widget-user-desc text-right'>".$_SESSION['cargo']." </h5>

                            </div>



                            <div class='widget-user-image'>

                              <img class='img-circle' src='fotos/user.png' alt='User Avatar'>

                            </div>

                            <div class='card-footer'>


                             <!--    <ul class='nav flex-column'>

                                                <li class='nav-item'>

                                                  <a href='#' class='nav-link'>

                                                    Prova ou Teste Disponível<span class='float-right badge bg-primary'>0</span>

                                                  </a>

                                                </li>

                                                

                                                <li class='nav-item'>

                                                  <a href='#' class='nav-link'>

                                                    Vídeos não Assistidos <span class='float-right badge bg-danger'>0</span>

                                                  </a>

                                                </li>

                                                <li class='nav-item'>

                                                  <a href='#' class='nav-link'>

                                                    Trabalhos/Atividades não Entregues <span class='float-right badge bg-danger'>0</span>

                                                  </a>

                                                </li>

                                              </ul>

                                

                          

                              /.row -->

                            </div>

                          </div>

                          ";

                      }


                ?>

                          

                </div>

            

        </div>

<div class="row">
  <div class='col-sm-1'></div>
  <div class='col-lg-3 col-6'>
    <!-- small card -->
    <div class='small-box bg-danger'>
      <div class='inner'>
        <h3 class="text-center">RECEBIDAS</h3>
        <h4 class="text-center">
          <?php
          $res_escola= escola_associada($conexao,$idfuncionario);
           $lista_escola_associada=""; 
         $sql_escolas="AND ( escola_id = -1 ";
         $sql_escolas_enviada="AND ( escola_id_origem = -1 ";
         foreach ($res_escola as $key => $value) {
             $id=$value['idescola'];
            $nome_escola=($value['nome_escola']);
             $sql_escolas.=" OR escola_id = $id ";
             $sql_escolas_enviada.=" OR escola_id_origem = $id ";

             $lista_escola_associada.= "
                  <option value='$id'>$nome_escola </option>

              ";
         }
          $res_recebida=quantidade_solicitacao_transferencia_recebida_por_escola($conexao,0, $sql_escolas);
          $quantidade_recebida=0;
          foreach ($res_recebida as $key => $value) {
            $quantidade_recebida=$value['quantidade'];
          }
          echo "$quantidade_recebida";
           ?>
        </h4>
        <p></p>
      </div>
      <div class='icon'>

      </div>
      <a  href='lista_solicitacao_transferencia.php' class='small-box-footer'>
        Transferências pendentes <ion-icon name="cloud-upload"></ion-icon>
      </a>
    </div>
  </div>

  <!-- ./col -->
  <div class='col-lg-3 col-6'>
    <!-- small card -->
    <div class='small-box bg-info'>
      <div class='inner'>
        <h3 class="text-center">ENVIADAS</h3>
        <h4 class="text-center">
          <?php 

           // $res_enviada=quantidade_solicitacao_transferencia_enviada_por_escola($conexao,0, $sql_escolas_enviada);
           // $quantidade_enviada=0;
           // foreach ($res_enviada as $key => $value) {
           //   $quantidade_enviada=$value['quantidade'];
           // }
           // echo "$quantidade_enviada";
        ?>

        </h4>
                <p>Você pode ter transferências pendentes clique abaixo para ver </p>


 
      </div>
      <div class='icon'>

      </div>
      <a  href='lista_solicitacao_transferencia_enviada.php' class='small-box-footer'  >
        Transferências pendentes  <ion-icon name="cloud-download"></ion-icon></ion-icon>
      </a>
    </div>
  </div>
  <!-- ./col -->
    

</div>



        <!-- .row -->




    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="form-group">
            <label for="exampleInputEmail1">Escolha a escola</label>
            <select class="form-control" id="idescola" onchange="listar_turmas_coordenador(this.value);" required="">
                
                <?php 
                  $res_escola= escola_associada($conexao,$idfuncionario);
                  foreach ($res_escola as $key => $value) {
                      $id=$value['idescola'];
                      $nome_escola=($value['nome_escola']);
                      echo "
                          <option value='$id'>$nome_escola </option>

                      ";
                  }
                ?>
            </select>
          </div>
        </div>
    </div>


      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">

                    <div class="card">

                      <div class="card-header">

                        <h3 class="card-title">Clique na disciplina desejada</h3>

                      </div>

                      <!-- /.card-header -->

                      <div class="card-body">

                        <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->

                        <div id="accordion">

                        

                              



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





    </div>

  </section>

</div>

<aside class="control-sidebar control-sidebar-dark">

  <!-- Control sidebar content goes here -->

</aside>
<script type="text/javascript">
    setTimeout(verificar_atraso(),2000);
  </script>
  <!-- /.control-sidebar -->

  <script type="text/javascript">

    setTimeout('listar_turmas_coordenador_automatico()',500);
    function listar_turmas_coordenador_automatico(){
        var idescola = document.getElementById("idescola").value;  
        listar_turmas_coordenador(idescola);
    }


  </script>



 <?php 

    include 'rodape.php';

 ?>