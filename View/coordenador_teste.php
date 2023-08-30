<?php
session_start();
if (!isset($_COOKIE['dia_doservidor_publico2'])) {
  setcookie('dia_doservidor_publico2', 1, (time()+(30*24*3600)));
 // setcookie('conteudo', 1, (time()+(300*24*3600)));
}else{
  setcookie('dia_doservidor_publico2', 0, (time()+(30*24*3600)));
  setcookie('dia_doservidor_publico2', $_COOKIE['dia_doservidor_publico2']+1);
}
  
###################################################
if (!isset($_SESSION['idcoordenador'])) {
  header("location:index.php?status=0");

}else{

  $idcoordenador=$_SESSION['idcoordenador'];

}
 include_once "cabecalho.php";
  include_once "alertas.php";
 
  include_once "barra_horizontal.php";
  include_once 'menu.php';
  include_once '../Controller/Conversao.php';

  if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";

  include_once '../Model/Coordenador.php';
  include_once '../Model/Escola.php';
  include_once '../Model/Aluno.php';

if ($_COOKIE['dia_doservidor_publico2']<2 && date("m-d")=="10-28") {
?>
    <script>
     function dia_doservidor_publico(){
         Swal.fire({
           title: "Parabéns!",
           imageUrl: 'dia_doservidor_publico.png',
           // imageWidth: 400,
           // imageHeight: 200,
           imageAlt: 'dia_doservidor_publico',
         });
     }
setTimeout('dia_doservidor_publico();',3000);
  </script> 
<?php 
  }
?>

<style>
                      .quadro {
                        background-image: url(imagens/logo_educalem_natal.png);
                        background-repeat: no-repeat;
                   
                        background-position: center;
                         
                            background-size: 100% 100%;
                      }
                      </style>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   


<script src="ajax.js?<?php echo rand(); ?>"></script>

<script type="text/javascript">
   setTimeout("licitalem_webhook();",1000);
</script>

<div class="content-wrapper" style="min-height: 529px;">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-1">
          </div>
          <div class="col-sm-12 alert alert-warning">

            <h1 class="m-0"><b>

           <?php
              if (isset($nome_escola_global)) {
                echo $_SESSION['NOME_APLICACAO']; 
              }
              ?>

             <?php if (isset($_SESSION['nome'])) {

              echo " ".$_SESSION['nome'];  

            } 

             ?></b></h1>

          </div><!-- /.col -->

          

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

                  $res_dados_aluno=dados_coordenador($conexao,$idcoordenador);
                  $cont=0;
                  foreach ($res_dados_aluno as $key => $value) {
                    $nome=$value['nome'];
                    $imagem=$value['foto'];
                      echo "<!-- Widget: user widget style 1 -->

                          <div class='card card-widget widget-user shadow-lg quadro'>

                            <!-- Add the bg color to the header using any of the bg-* classes -->

                            <div class='widget-user-header text-white'>



                              <h3 class='widget-user-username text-right'>$nome</h3>

                              <h5 class='widget-user-desc text-right'>Coordenador (a) </h5>

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

                       

                      echo "

                          <div class='card card-widget widget-user shadow-lg quadro' >

                            <!-- Add the bg color to the header using any of the bg-* classes -->

                            <div class='widget-user-header text-white' >



                              <h3 class='widget-user-username text-right'>".$_SESSION['nome']."</h3>

                              <h5 class='widget-user-desc text-right'>Coordenador(a) </h5>

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





        <!-- .row -->




       <div class="row">

      

            <script type="text/javascript">
              google.charts.load('current', {'packages':['corechart']});
              google.charts.setOnLoadCallback(drawChart);

              function drawChart() {

                var data = google.visualization.arrayToDataTable([
                  <?php 
                      $result_ativos=$conexao->query("SELECT COUNT(*) AS ativo FROM aluno where status like 'Ativo' ");
                      $ativo=0;
                      foreach ($result_ativos as $key => $value) {
                        $ativo=$value['ativo'];
                      }

                      $result_bloqueado=$conexao->query("SELECT COUNT(*) AS bloqueado FROM aluno where status like 'Desativado' ");
                      $bloqueado=0;
                      foreach ($result_bloqueado as $key => $value) {
                        $bloqueado=$value['bloqueado'];
                      }
                    
                    echo "
                    ['Task', 'Hours per Day'],
                    ['Ativos',     $ativo],
                    ['Bloqueados',  $bloqueado]
                    ";

                  ?>
                ]);

                var options = {
                  title: 'GRÁFICO DE ALUNOS'
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                chart.draw(data, options);
              }
            </script>

          <div class='col-sm-1'></div>
          <div class='col-lg-3 col-6'>
            <!-- small card -->
            <div class='small-box bg-danger'>
              <div class='inner'>
                <h3 class="text-center">RECEBIDAS</h3>
                <h4 class="text-center">
                  <?php
                  $res_escola= escola_associada($conexao,$idcoordenador);
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

                   $res_enviada=quantidade_solicitacao_transferencia_enviada_por_escola($conexao,0, $sql_escolas_enviada);
                   $quantidade_enviada=0;
                   foreach ($res_enviada as $key => $value) {
                     $quantidade_enviada=$value['quantidade'];
                   }
                   echo "$quantidade_enviada";
                ?>

                </h4>

                <p> </p>
              </div>
              <div class='icon'>

              </div>
              <a  href='lista_solicitacao_transferencia_enviada.php' class='small-box-footer'  >
                Transferências pendentes  <ion-icon name="cloud-download"></ion-icon></ion-icon>
              </a>
            </div>
          </div>
          <!-- ./col -->
            


        <div class="col-lg-3 col-6" >
            <div id="piechart" style="height: 100px;"></div>
        </div>

   
       
    </div>        

        <?php 







          //   $res_video=$conexao->query("SELECT * FROM visualizacao_video order by data_hora asc");
          //   $array_data_video=array();
          //   $minuto_aux=0;

          //   foreach ($res_video as $key => $value) {
          //     $minuto_aux=0;
          //     $data=data_simples($value['data_hora']);
          //     $minuto_aux=$minuto_aux+($value['minuto']/2); 
          //     if (!isset($array_data_video["$data"])) {
          //       $array_data_video["$data"]=0;
          //     }            
          //     $array_data_video["$data"]+=$minuto_aux;
              

          //   }
         
          
          // echo"
          // <script type='text/javascript'>
          //    google.charts.load('current', {packages:['calendar']});
          //    google.charts.setOnLoadCallback(drawChart);

          // function drawChart() {
          //     var dataTable = new google.visualization.DataTable();
          //     dataTable.addColumn({ type: 'date', id: 'Date' });
          //     dataTable.addColumn({ type: 'number', id: 'Won/Loss' });
          //     dataTable.addRows([
          //     ";
          //     $relatorio_video="";

          //     foreach ($array_data_video as $key => $value) {
          //       $ano=date("Y", strtotime($key));
          //       $mes=date("m", strtotime($key));
          //       $dia=date("d", strtotime($key));
          //       $minuto=$value;
          //       $relatorio_video.="[ new Date($ano, $mes, $dia), $minuto ],";
                 
          //     }
          //     echo"$relatorio_video";

          //     echo" 
              
          //     ]);
          //     var chart = new google.visualization.Calendar(document.getElementById('calendar_basic'));

          //     var options = {
          //       title: 'RELATÓRIO DE MINUTOS ASSISTIDOS',
          //       height: 350,
          //     };

          //     chart.draw(dataTable, options);
          // }
          //  </script>

          //  ";
 ?>

<!-- <div id="calendar_basic" style="width: 1000px; height: 200px;"></div>

        </div>    
    </div>
   -->

      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <br>

          <a   href='cadastrar_simulado.php' class='btn btn-danger btn-block btn-flat'>
          <i class='fa fa-edit'></i> 
          SIMULADO
          </a>  
          <div class="form-group">

            <label for="exampleInputEmail1">Escolha a escola</label>
            <select class="form-control form-control-lg select2" id="idescola" onchange="listar_turmas_coordenador(this.value);" required="">
                 
               

                
                <?php 
                  echo "$lista_escola_associada";

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

  <!-- /.control-sidebar -->

  <script type="text/javascript">

    setTimeout('listar_turmas_coordenador_automatico()',500);
    function listar_turmas_coordenador_automatico(){
        var idescola = document.getElementById("idescola").value;  
        listar_turmas_coordenador(idescola);
    }


  </script>



 <?php 

    include_once 'rodape.php';

 ?>