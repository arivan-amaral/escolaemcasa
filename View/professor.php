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

if (!isset($_COOKIE['aviso_nota'])) {
  setcookie('aviso_nota', 1, (time()+(300*24*3600)));
 // setcookie('conteudo', 1, (time()+(300*24*3600)));
}else{
     setcookie('aviso_nota', $_COOKIE['aviso_nota']+1);
}


if (!isset($_SESSION['idprofessor'])) {

       header("location:index.php?status=0");

}else{

  $idprofessor=$_SESSION['idprofessor'];

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

  include_once '../Model/Professor.php';
  include_once '../Model/Coordenador.php';

  

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


//if ($_COOKIE['aviso_nota']<5) {
  ?>
     <!-- <script>
     function aviso_nota(){
       Swal.fire({
         title: '',
         width: 700,
         height: 1400,
         padding: '8em',
         background: '#fff url(nota_duplicada.png)',
         backdrop: `
           rgba(0,0,123,0.4)
           url('atencao.gif')
           left top
           no-repeat
         `
       });
     }

     aviso_nota();
     </script> -->
   <?php 
 // }
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

              echo $_SESSION['idfuncionario']." - ".$_SESSION['nome'];  

            } 

             ?></b></h1>

          </div><!-- /.col -->

 <!-- /.col -->

        </div><!-- /.row -->

      </div><!-- /.container-fluid -->

    </div>

    <!-- /.content-header -->

<script>
     
        // Swal.fire({
        //   position: 'center',
        //   icon: 'info',
        //   title: 'ATENÇÃO PROFESSOR(A)',
        //      text: 'Informamos que os trabalhos, atividades, avaliações e simulados do ano letivo 2021 serão excluídos da plataforma dia 10/03/2022. Caso queiram ter acesso após essa data, orientamos que façam o download do material.',
        //   showConfirmButton: true
        // });
  
</script>

    <!-- Main content -->

    <section class="content">

      <div class="container-fluid">

        <!-- Info boxes -->
 
     

        <div class="row">

                   <!-- .row -->

              <div class="col-md-1"></div>



              <div class="col-md-10">

                <?php 

                  $res_dados_aluno=dados_professor($conexao,$idprofessor);
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

                          

                            <div class='widget-user-header text-white' >

                              <h3 class='widget-user-username text-right'>$nome</h3>

                              <h5 class='widget-user-desc text-right'>Professor(a) </h5>

                            </div>



                            <div class='widget-user-image'>

                              <img class='img-circle' src='fotos/$imagem' alt='User Avatar'>

                            </div>

                            <div class='card-footer'>

     

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

                            <div class='widget-user-header text-black' >



                              <h3 class='widget-user-username text-right'>".$_SESSION['nome']." </h3>

                              <h5 class='widget-user-desc text-right'>Professor(a) </h5>

                            </div>



                            <div class='widget-user-image'>

                              <img class='img-circle' src='fotos/user.png' alt='User Avatar'>

                            </div>

                            <div class='card-footer'>


                           

                          


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

                    <div class="card">

                      <div class="card-header">

                        <h3 class="card-title">Clique na disciplina desejada</h3>

                      </div>

                      <!-- /.card-header -->

                      <div class="card-body">

                        <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->

                        <div id="accordion">


                                  <a  href='cadastrar_questionario.php' class='btn btn-danger btn-block btn-flat'>

                                            <i class='fa fa-edit'></i>

                                              Provas                                           

                                    </a>
                                    <br>


                          <?php 
     
                          $result=listar_disciplina_professor($conexao,$idprofessor,$_SESSION['ano_letivo']);


                          $conta=0;
                          $array_disciplina_regente_creche = array('0' => 40,'1' => 42,'2' => 43,'3' => 44);

                          $array_disciplina_regente_pre_escola = array('0' => 40,'1' => 42,'2' => 44);        

                            $array_turma_regente_creche = array();
                            $array_turma_regente_pre_escola = array();

                            $conta_disciplina_regetes_cheche=1;
                            $conta_disciplina_regetes_pre_escola=1;

                            foreach ($result as $key => $value) {

                            $disciplina=($value['nome_disciplina']);
                            $nome_escola=($value['nome_escola']);
                            $idescola=($value['idescola']);
                            $iddisciplina=$value['iddisciplina'];
                            $iddisciplina_aux=$value['iddisciplina'];
                            $idturma=$value['idturma'];
                            $turma=($value['nome_turma']);
                            $idserie=$value['serie_id'];


                            if(($idserie==1 || $idserie==16) && $iddisciplina==40 && (!in_array($idturma, $array_turma_regente_creche)) ){
                                include"menu_disciplina_regente.php";
                                // echo "carregando 1";
                            }elseif( $idserie==2 && $iddisciplina==40 ){
                                include"menu_disciplina_regente.php";
                                // echo "carregando 2";


                            } elseif( ($idserie==2 || $idserie==16 ) && $iddisciplina==43  ){
                                include "menu_disciplina_nao_regente.php";
                                // echo "carregando 3";

          }elseif( ($idserie==1 || $idserie==16 ) && ($iddisciplina==41 || ($iddisciplina==43 && $idescola==20 ) ) ){
                              include "menu_disciplina_nao_regente.php";
                                // echo "carregando 4";


                            }
                            else if ( $iddisciplina != 43 && !(in_array($iddisciplina, $array_disciplina_regente_creche)) && !(in_array($iddisciplina, $array_disciplina_regente_pre_escola )) ) {

                              include "menu_nao_infanfil.php";

                                // echo "carregando 4";


                            }//else se não for cheche ou pre escola



                            if ($idserie==1 && (in_array($iddisciplina, $array_disciplina_regente_creche)) ){
                            // $array_turma_regente_creche[$turma]=$idturma;
                            }
                            else
                            if ($idserie==2 && (in_array($iddisciplina_aux, $array_disciplina_regente_pre_escola))){
                            // $array_turma_regente_pre_escola[$conta]=$idturma;
                            // echo "$idturma = $conta_disciplina_regetes_pre_escola <br>";
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

  <!-- /.control-sidebar -->




  <style>
   #imagem_whats{position:fixed;right:0;bottom:0;display:block;cursor:pointer;z-index:9999999;float:right}
   #imagem_whats2{position:fixed;right:0;bottom:0;display:block;cursor:pointer;z-index:9999999;float:right;display:none} @media only screen and (max-width: 999px) and (min-width: 100px){#imagem_whats{display:none}#imagem_whats2{display:block}}</style>

  <img id="imagem_whats" src="https://www.ellodigital.com.br/images/whatsapp.png" onClick="window.open('https://web.whatsapp.com/send?phone=+557799323906&amp;text=OLÁ, PODE ME AJUDAR COM A PLATAFORMA EDUCA LEM?!', '_blank');">

  <img id="imagem_whats2" src="https://www.ellodigital.com.br/images/whatsapp.png" onClick="window.open('https://api.whatsapp.com/send?phone=+557799323906&amp;text=OLÁ, PODE ME AJUDAR COM A PLATAFORMA EDUCA LEM?!', '_blank');"><div class="preloader"> <div class="preloaderimg"></div></div>


  <div class="modal fade" id="modal-conteudo">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">AVISO! <?php echo $_COOKIE['conteudo']; ?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <div class="modal-body">
         <!-- INICIO CORPO -->
      
         <div class="row">

          <div class="col-md-12">



            <div class="card card-default">
              <div class="card-header callout callout-danger">
                <h3 class="card-title">
                  <i class="fas fa-bullhorn"></i>
                  ATENÇÃO, Melhorias na forma de registro dos conteúdos das aulas, assista o vídeo!
                </h3>
              </div>

              <div class='card-body'>
       <center>

         <!-- <h1>ATENÇÃO, NÃO LANÇAR NOTA ANTES DAS 20:30, <font color="RED">SERVIDOR EM MANUTENÇÃO</font></h1> -->
          <iframe width="380" height="315" src="https://www.youtube.com/embed/ub_1CMDrb8Q" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
       </center>
              </div>


              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>        
        </div>

         <!-- FIM CORPO -->
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

 <?php 

    include_once 'rodape.php';

 ?>