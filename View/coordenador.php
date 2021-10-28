<?php
session_start();
if (!isset($_COOKIE['dia_doservidor_publico'])) {
  setcookie('dia_doservidor_publico', 1, (time()+(30*24*3600)));
 // setcookie('conteudo', 1, (time()+(300*24*3600)));
}else{
  setcookie('dia_doservidor_publico', 0, (time()+(30*24*3600)));
  setcookie('dia_doservidor_publico', $_COOKIE['dia_doservidor_publico']+1);
}
  
###################################################
if (!isset($_SESSION['idcoordenador'])) {
  header("location:index.php?status=0");

}else{

  $idcoordenador=$_SESSION['idcoordenador'];

}
 include "cabecalho.php";
  include "alertas.php";
 
  include "barra_horizontal.php";
  include 'menu.php';
  include '../Controller/Conversao.php';

  include '../Model/Conexao.php';

  include '../Model/Coordenador.php';
  include '../Model/Escola.php';
  include '../Model/Aluno.php';

if ($_COOKIE['dia_doservidor_publico']<2 && date("m-d")=="10-28") {
?>
    <script>
     function dia_doservidor_publico(){
         Swal.fire({
           title: "Parabéns!",
           imageUrl: 'imagens/dia_doservidor_publico.png',
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

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   


<script src="ajax.js?<?php echo rand(); ?>"></script>



<div class="content-wrapper" style="min-height: 529px;">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-1">
          </div>
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

                          <div class='card card-widget widget-user shadow-lg'>

                            <!-- Add the bg color to the header using any of the bg-* classes -->

                            <div class='widget-user-header text-white' style='background: url(imagens/fundo.jpg)'>



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

                       

                      echo "<!-- Widget: user widget style 1 -->

                          <div class='card card-widget widget-user shadow-lg'>

                            <!-- Add the bg color to the header using any of the bg-* classes -->

                            <div class='widget-user-header text-white' style='background: url(fotos/fundo.jpg)'>



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
      <div class="col-md-1"></div>
      <div class="col-md-10">
 <div class="row">

        <?php 

            $res_video=$conexao->query("SELECT * FROM visualizacao_video order by data_hora asc");
            $minuto_aux=0;
            foreach ($res_video as $key => $value) {
              $minuto_aux=$minuto_aux+($value['minuto']/2); 
             

            }
    ?>


        <div class="col-lg-3 col-6">
          <!-- small card -->
          <div class="small-box bg-danger">

          <a href="mural.php" class="small-box-footer">
            <div class="inner">
              <h5><?php echo number_format(($minuto_aux), 2, '.', ''); ?> Minutos assistidos</h5>
            </div>
            <div class="icon">
              <!-- <i class="fas fa-tag"></i> -->
            </div>
            Total de minutos assistidos em toda a rede <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>         



             <?php 

                $pes_aluno=$conexao->query("SELECT aluno_id ,(SELECT DISTINCT SUM(minuto) ) AS 'minutos' FROM visualizacao_video GROUP BY aluno_id ORDER by minutos DESC limit 3");
              $nome_aluno="";
              $minutos_aluno=0;
              $conta_colocacao=1;
              $array_cores=array('1'=>'success','2'=>'primary','3'=>'info');
                foreach ($pes_aluno as $key => $value) {
                  $aluno_id=$value['aluno_id'];
                  $minutos_aluno=$value['minutos']/2;

                  $res_dados_aluno=$conexao->query("SELECT nome FROM aluno WHERE idaluno= $aluno_id limit 1");
                  foreach ($res_dados_aluno as $key2 => $value2) {
                    $nome_aluno=$value2['nome'];
                  }  
                  $cor=$array_cores[$conta_colocacao];
                  echo"

                  <div class='col-lg-3 col-6'>
                    <!-- small card -->
                    <div class='small-box bg-$cor'>

                    <a href='mural.php' class='small-box-footer'>
                      <div class='inner'>
                        <h5>$conta_colocacao ° lugar com ". number_format(($minutos_aluno), 2, '.', '')." Min assistidos</h5>
                      </div>
                      <div class='icon'>
                        <!-- <i class='fas fa-tag'></i> -->
                      </div>
                       $nome_aluno
                      <i class='fas fa-arrow-circle-right'></i>
                      </a>
                    </div>
                  </div>
                  ";              
                  $conta_colocacao++;
                }
        ?>



      </div>

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
            <select class="form-control" id="idescola" onchange="listar_turmas_coordenador(this.value);" required="">
                
<?php 
                  $res_escola= escola_associada($conexao,$idcoordenador);
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