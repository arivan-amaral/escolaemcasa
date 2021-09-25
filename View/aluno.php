<?php
  include 'seguranca_aluno.php';

  include "cabecalho.php";
  include "alertas.php";
  include "barra_horizontal.php";

  include 'menu.php';

  include '../Controller/Conversao.php';

  include '../Model/Conexao.php';
  include '../Model/Disciplina.php';

  include '../Model/Aluno.php';
  $idescola=$_SESSION['escola_id'];
  $idturma=$_SESSION['turma_id'];
  $idserie=$_SESSION['serie_id'];
  $etapa_id="";
  if (isset($_SESSION['etapa_id'])) {
    $etapa_id=$_SESSION['etapa_id'];
  }
  $data_atual=date("Y-m-d H:i:s");
  $data=date("Y-m-d");
  $hora_atual=date("H:i:s");



  if (isset($_GET['idquestionario'])){
    $idquestionario=$_GET['idquestionario'];
    $conexao->exec("INSERT into questionario_finalizado (aluno_id,questionario_id)  values ($idaluno,$idquestionario)");
  }

  if (isset($_GET['simulado_id'])){
    $simulado_id=$_GET['simulado_id'];
    $conexao->exec("INSERT into questionario_simulado_finalizado (aluno_id,questionario_id)  values ($idaluno,$simulado_id)");
  }

?>
<script src="ajax.js?<?php echo rand(1,100); ?>"></script>

<?php 

  $result_prova=$conexao->query("SELECT * FROM questionario WHERE escola_id=$idescola and turma_id=$idturma and data<='$data' and data_fim>='$data' and status=1");

$prova_ativa=0;
echo "
<div class='modal fade' id='modal-prova'>
    <div class='modal-dialog'>
      <div class='modal-content'>
        <div class='modal-header'>
          <h4 class='modal-title'>ATENÇÃO!</h4>
          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        

          <div class='modal-body'>
                 <h2>Você tem prova/simulado disponível.</h2>

";
$quantidade_questionario=1;
$result_prov="";
   $hora_inicio="";
   $hora_fim="";

foreach ($result_prova as $key_questionario => $value_questionario) {

$quantidade_questionario++;

    $questionario_id=$value_questionario['id'];
    $titulo=$value_questionario['nome'];
    $iddisciplina=$value_questionario['disciplina_id'];
    $nome_disciplina="";
    
    $res_dis=pesquisar_disciplina_id($conexao,$iddisciplina);
    foreach ($res_dis as $key_dis => $value_dis) {
      $nome_disciplina=$value_dis['nome_disciplina'];
    }
    $idturma=$value_questionario['turma_id'];

   $res_finalizado=$conexao->query("SELECT * FROM questionario_finalizado WHERE aluno_id=$idaluno and questionario_id=$questionario_id");
   $questionario_finalizado=0;
   foreach ($res_finalizado as $key => $value) {
      $questionario_finalizado++;
   }

if ($questionario_finalizado==0) {

    $result_horario_prova=$conexao->query("SELECT * FROM horario_individual_questionario WHERE horario_individual_questionario.aluno_id=$idaluno AND
     '$hora_atual' >= horario_individual_questionario.hora_inicio  AND '$hora_atual' <= horario_individual_questionario.hora_fim and questionario_id=$questionario_id limit 1");

    foreach ($result_horario_prova as $key2 => $value2) {
         $hora_inicio=$value2['hora_inicio'];
              $hora_fim=$value2['hora_fim'];

              $result_prov.= "
                   <a  href='responder_questionario.php?questionario_id=$questionario_id&disc=$iddisciplina&turm=$idturma' class='btn btn-info btn-block btn-flat'>
                           <i class='fa fa-edit'></i>

                            RESPONDER PROVA $nome_disciplina: $titulo  $hora_inicio ~~ $hora_fim                                         

                   </a> 
                   
                   <br>

                    <!-- /corpo -->          
             ";


      $prova_ativa++;

    }
  }


}



if ($idserie==16 && $etapa_id!="") {
  $result_simulado=$conexao->query("SELECT * FROM questionario_simulado WHERE
    etapa_id=$etapa_id
   and escola_id=$idescola 
   and turma_id=$idturma
    and data<='$data_atual' 
    and data_fim>='$data_atual'
     and status=1");
}else{  
$result_simulado=$conexao->query("SELECT * FROM questionario_simulado WHERE escola_id=$idescola and serie_id=$idserie and data<='$data_atual' and data_fim>='$data_atual' and status=1");
}

$conta_simulado=0;   


  foreach ($result_simulado as $key_simulado => $value_simulado) {
    $idsumulado=$value_simulado['id'];
    $titulo=$value_simulado['nome'];

    $res_simulado_finalizado=$conexao->query("SELECT * FROM questionario_simulado_finalizado WHERE aluno_id=$idaluno and questionario_id=$idsumulado");
       $simulado_finalizado=0;
       foreach ($res_simulado_finalizado as $key => $value) {
          $simulado_finalizado++;
       }

    if ($simulado_finalizado==0) {
                $result_prov.= "
                     <a  href='responder_questionario_simulado.php?questionario_id=$idsumulado' class='btn btn-info btn-block btn-flat'>
                             <i class='fa fa-edit'></i>RESPONDER SIMULADO: $titulo</a>
                     <br>        
               ";

        $conta_simulado++;
    }
  
}


echo "$result_prov";





echo "
   </div>
          <button type='button' class='btn btn-default' data-dismiss='modal'><font style='vertical-align: inherit;'><font style='vertical-align: inherit;'>Fechar</font></font></button>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

    ";

if ($prova_ativa>0 || $conta_simulado>0) {
        echo"

      <script type='text/javascript'>

          function modal_prova() {
              $(document).ready(function() {
                  $('#modal-prova').modal('show');
                });
          }

          setTimeout('modal_prova();',300);
          
      </script>";
}

if ($prova_ativa==0 && $conta_simulado ==0) {
    $result_reuniao=$conexao->query("SELECT * FROM video_chamada WHERE escola_id=$idescola and turma_id=$idturma and  hora_inicio <='$data_atual'  and hora_fim >'$data_atual' limit 1");
    foreach ($result_reuniao as $key => $value) {
      echo"
      <script type='text/javascript'>
          function modal_reuniao() {
              $(document).ready(function() {
                  $('#modal-reuniao-videochamada').modal('show');
                });
          }

          setTimeout('modal_reuniao();',800);
          
      </script>";



    }
}

?>







 

<div class="modal fade" id="modal-reuniao-videochamada">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">LINKS DE REUNIÕES/VÍDEO CHAMADAS DA TURMA, DISPONÍVEIS!</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        

          <div class="modal-body">
              <!-- corpo -->
              <?php 

              $listando_links=$conexao->query("SELECT * FROM video_chamada,disciplina WHERE  
                disciplina_id=iddisciplina AND
                escola_id=$idescola and turma_id=$idturma and hora_inicio <='$data_atual'  and hora_fim >'$data_atual'order by id desc");
              $cont_reuniao=0;
              foreach ($listando_links as $key => $value) {

                $id=$value['id'];
                $nome_disciplina=$value['nome_disciplina'];
                $descricao=$value['titulo'];
                $link=$value['link'];
                $data_visivel=converte_data_hora($value['hora_inicio']);
                $data_visivel_fim=converte_data_hora($value['hora_fim']);

                echo"       
                <div class='time-label'>
                <b>LINK DA DISCIPLINA: $nome_disciplina DISPONÍVEL DE: $data_visivel ÀS $data_visivel_fim</b>
                </div>";

                echo "
                <p> <a href='$link' target='_blank'>$link</a> </p>
  
                $descricao";
              }

              ?>



              <!-- /corpo -->          
          </div>
      <button type="button" class="btn btn-default" data-dismiss="modal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Fechar</font></font></button>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

 
 

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

              echo "  ".$_SESSION['nome'];  

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

        <!-- Info boxes -->



        <!-- .row -->

        

    <div class="row">

               <!-- .row -->

          <div class="col-md-1"></div>

          <div class="col-md-10">

            <?php 

              $res_dados_aluno=dados_aluno($conexao,$idaluno);

              $cont=0;

              foreach ($res_dados_aluno as $key => $value) {

                

                $nome=$value['nome'];

                $imagem=$value['foto'];

                



                  echo "<!-- Widget: user widget style 1 -->

                      <div class='card card-widget widget-user shadow-lg'>

                        <!-- Add the bg color to the header using any of the bg-* classes -->

                        <div class='widget-user-header text-white' style='background: url(imagens/fundo.jpg)'>



                          <h3 class='widget-user-username text-right'>$nome</h3>

                          <h5 class='widget-user-desc text-right'> Aluno(a) </h5>

                        </div>



                        <div class='widget-user-image'>

                          <img class='img-circle' src='fotos/$imagem' alt='Minha foto de perfil' >

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

                $cont++;

              }



              if ($cont==0) {

                   

                  echo "<!-- Widget: user widget style 1 -->

                      <div class='card card-widget widget-user shadow-lg'>

                        <!-- Add the bg color to the header using any of the bg-* classes -->

                        <div class='widget-user-header text-white' style='background: url(imagens/fundo.jpg)'>



                          <h3 class='widget-user-username text-right'>".$_SESSION['nome']."</h3>

                          <h5 class='widget-user-desc text-right'>Aluno(a) </h5>

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
      <div class="col-md-12">




 <div class="row">
                 
                  
                  <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-info">

                    <a href="mural.php" class="small-box-footer">
                      <div class="inner">
                        <h3>Mural</h3>

                        
                      </div>
                      <div class="icon">
                        <i class="fas fa-tag"></i>
                      </div>
                      Aqui fica os Recados/orientações coletivas <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>                  
<?php 

if ($prova_ativa!=0) {

 ?>
              <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-secondary">

                    <a onclick="modal_prova();" class="small-box-footer">
                      <div class="inner">
                        <h3>Prova</h3>

                        
                      </div>
                      <div class="icon">
                        <i class="fas fa-tag"></i>
                      </div>
                      Clique para ver as provas que estão disponíveis <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>

<?php 
}

if ($idserie>2) {

 ?>

                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-success">
                      <a href="chat.php" class="small-box-footer">
                      <div class="inner">
                        <h3>Bate papo</h3>
                        <h3></h3>
                        <script type="text/javascript">
                              setInterval("chat_receber();",5000);
                        </script>
                      
                      </div>
                      <div class="icon">
                        <i class="far fa-comment"></i>
                      </div>
                      <br>
                        Ver sobre isso <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>
                  <!-- ./col -->
                <!--   <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                      <a href="video_nao_visualizado.php" class="small-box-footer">

                      <div class="inner">
                        <h3>Vídeos  -->
                          <?php
                          //   $res_pendencia_v=$conexao->query("SELECT * FROM video WHERE escola_id=$idescola and id_turma=$idturma");
                          //   $cont_video=0;
                          //   foreach ($res_pendencia_v as $key => $value) {
                          //     $idvideo=$value['id'];
                          //     $res_v=$conexao->query("SELECT * FROM visualizacao_video WHERE video_id=$idvideo and aluno_id=$idaluno limit 1");
                             
                          //     $cont_v=0;
                          //     foreach ($res_v as $key => $value) {
                          //       $cont_v++;
                          //     }
                          //     if ($cont_v==0) {
                          //       $cont_video=$cont_video + 1;
                          //     }
                          // }
                          // echo $cont_video;                                  

                          ?>
<!-- 
                        </h3>

                        
                      </div>
                      <div class="icon">
                        <i class="fas fa-video"></i>
                      </div>
                        Ver sobre isso <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div> -->
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-danger">
                      <a href="trabalho_nao_respondido.php" class="small-box-footer">

                      <div class="inner">
                        <h3>
                          Trabalhos 
                          <?php
                            $res_pendencia=$conexao->query("SELECT * FROM trabalho WHERE escola_id=$idescola and turma_id=$idturma");
                            $cont_trabalho=0;
                            foreach ($res_pendencia as $key => $value) {
                              $idtrabalho=$value['id'];
                              $res=$conexao->query("SELECT * FROM trabalho_entregue WHERE trabalho_id=$idtrabalho  and aluno_id=$idaluno  limit 1");
                             
                              $cont=0;
                              foreach ($res as $key => $value) {
                                $cont++;
                              }
                              if ($cont==0) {
                                $cont_trabalho=$cont_trabalho+ 1;
                              }
                          }
                                                           

                          ?>
                        </h3>

                        
                      </div>
                      <div class="icon">
                        <i class="fa fa-book"></i>
                      </div>
                      <br>

                        Veja sobre isso <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>


               <?php 
                }
               ?>
                  <!-- ./col -->
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

                       

                          
                <?php 
                          $diasemana = array('Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado');

                          // $diasemana_numero = date('w', strtotime($data));
                          // echo $diasemana[$diasemana_numero];

                      if ($idserie<8) {
                            // code...
                      }
                            $result=listar_disciplina_aluno($conexao,$idaluno);
                            $conta=0;

                            foreach ($result as $key => $value) {

                              $disciplina=($value['nome_disciplina']);

                              $nome_professor=($value['nome_professor']);

                              $iddisciplina=$value['iddisciplina'];

                              $idturma=$value['idturma'];

                              $turma=($value['nome_turma']);
                          
                           if ($conta==0) {      

                                    $numero='';
                                     $nome_aluno=$_SESSION['nome'];
                                     $nome_escola=$_SESSION['nome_escola'];
                                     $nome_turma=$turma;

                        
                              echo "<div class='card card-warning'>

                                <div class='card-header'>

                                  <h4 class='card-title w-100'>
                                
                               
                                     <a href='boletim_individual.php?idescola=$idescola&idturma=$idturma&idserie=$idserie&idaluno=$idaluno&numero=$numero&nome_aluno=$nome_aluno&nome_escola=$nome_escola&nome_turma=$nome_turma' class='d-block w-100 collapsed' >
                                    
                                    MEU BOLETIM <b class='text-warning'> </b> 

                                   
                                      
                                      
                                    </a>
                                  </h4>
                                </div>
                              </div>";
                            }
                            
                            if ($idserie<3) {
                              if ($conta==0) {
                                foreach ($diasemana as $key_semana=> $value_semana) {
                                  
                                  if ($key_semana>0) {

                                   $disciplina=$value_semana;
                                   $iddisciplina=$key_semana;
                                   $nome_professor="";

                                    echo "

                                    <div class='card card-primary'>

                                      <div class='card-header'>

                                        <h4 class='card-title w-100'>



                                          <a class='d-block w-100 collapsed' data-toggle='collapse' href='#collapseOne$iddisciplina' aria-expanded='false'>

                                           $nome_professor  <b class='text-warning'> $disciplina</b>

                                            <i class='right fas fa-angle-left'></i>

                                          </a>

                                        </h4>

                                      </div>

                                      <div id='collapseOne$iddisciplina' class='collapse' data-parent='#accordion' style=''>

                                        <div class='card-body'>

                                            

                                            <a class='btn btn-info btn-block btn-flat'

                                             href='todos_os_videos.php?diasemana=$key_semana&&turma=Vídeos &disciplina=$value_semana' >



                                              <font style='vertical-align: inherit;'>

                                                <font style='vertical-align: inherit;'> 

                                                    <i class='fa fa-play'></i>

                                                      Ver Videoaulas     

                                                  </font>

                                              </font>

                                            </a> 



                                           


                                            <a  href='trabalhos.php?diasemana=$key_semana&disc=$iddisciplina&turm=$idturma&turma=Trabalhos&disciplina=$value_semana' class='btn btn-info btn-block btn-flat'>

                                                    <i class='fa fa-book'></i>

                                                      Trabalhos/Atividades                                           

                                            </a> ";




                                    echo"</div>

                                  </div>

                                </div>

                                ";
                              }

                                }
                              }     

                                 
                            }else{

                              echo "

                              <div class='card card-primary'>

                                <div class='card-header'>

                                  <h4 class='card-title w-100'>



                                    <a class='d-block w-100 collapsed' data-toggle='collapse' href='#collapseOne$iddisciplina' aria-expanded='false'>

                                     $nome_professor - <b class='text-warning'> $disciplina</b>

                                      <i class='right fas fa-angle-left'></i>

                                    </a>

                                  </h4>

                                </div>

                                <div id='collapseOne$iddisciplina' class='collapse' data-parent='#accordion' style=''>

                                  <div class='card-body'>

                                      

                                      <a class='btn btn-info btn-block btn-flat'

                                       href='videoaulas.php?disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina' >



                                        <font style='vertical-align: inherit;'>

                                          <font style='vertical-align: inherit;'> 

                                              <i class='fa fa-play'></i>

                                                Ver Videoaulas     

                                            </font>

                                        </font>

                                      </a> 



                                     


                                      <a  href='trabalhos.php?disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina' class='btn btn-info btn-block btn-flat'>

                                              <i class='fa fa-book'></i>

                                                Trabalhos/Atividades                                           

                                      </a> ";

                                      if ($idserie>2) {
                                      

                                         echo "                                     

                                          

                                           <a   href='material_apoio.php?iddisciplina=$iddisciplina&idturma=$idturma&nome_disciplina=$disciplina&nome_turma=$turma' class='btn btn-info btn-block btn-flat'>
                                            <ion-icon name='document-text'></ion-icon> 
                                            MATERIAL DE APOIO
                                          </a>"; 

                                      }

                                  echo"</div>

                                </div>

                              </div>

                              ";

                            }

                        $conta++;
                            }
                      

                ?>

                              



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
<style type="text/css">
.star-wrapper {
    width: 180px;
    height: 40px;
    border: 1px solid #ccf;
}
.star {
    width: 35px;
    height: 30px;
    overflow: hidden;
    float: left;
}
.star img {
    height: 30px;
}
.full img {
    margin-left: -40px;
}
</style>

  <script type="text/javascript">

$(function () {
    var estrelas = $('.star');
    var escolhida = 0;

    function repaint(e) {
        var indice = $(this).index() + 1;
        if (e.type == 'click') escolhida = indice;
        estrelas.removeClass('full');
        var upTo = $(this).hasClass('star-wrapper') ? escolhida : indice;
        estrelas.slice(0, upTo).addClass('full');
    }

    $('.star-wrapper').on('mouseleave', repaint);
    estrelas.on('mouseenter mouseleave click', repaint);
});

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