<?php 
session_start();
$ano_letivo=$_SESSION['ano_letivo'];

$idserie=$_GET['idserie']; 
 
if ($idserie< 8 && !isset($_COOKIE['notificado'])) {
    
  // echo "<script type='text/javascript'>
  //     function modal_video() {
  //         $(document).ready(function() {
  //             $('#modal-video-frequencia').modal('show');
  //           });
  //     }

  //     setTimeout('modal_video();',1000);
      
  // </script>";
 
  
}

if (!isset($_SESSION['idprofessor'])) {
       header("location:index.php?status=0");

}else{

  $idprofessor=$_SESSION['idprofessor'];

}
  include "cabecalho.php";
  include "alertas.php";
  include "barra_horizontal.php";

  include 'menu.php';

  include '../Controller/Conversao.php';

  include '../Model/Conexao.php';

  include '../Model/Aluno.php';
  include '../Model/Professor.php';
  include '../Model/Turma.php';

  $idescola=$_GET['idescola']; 
  $idturma=$_GET['turm']; 
  $iddisciplina=$_GET['disc']; 

 $array_url=explode('p?', $_SERVER["REQUEST_URI"]);
 $url_get=$array_url[1];

 $nome_turma='';
 $nome_disciplina='';
 if (isset($_GET['turma'])) {
   $nome_turma=$_GET['turma'];
 } 
 if (isset($_GET['disciplina'])) {
    $nome_disciplina=$_GET['disciplina'];

 }
?>



<script src="ajax.js?<?php echo rand(); ?>"></script>

<script type="text/javascript">

</script>

<div class="content-wrapper" style="min-height: 529px;">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-12 alert alert-success text-center">

            <h1 class="m-0"><b> ÁREA DE REGISTRO DE FREQUÊNCIA</b></h1>

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
        <!-- .row -->

       
      <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <button class="btn btn-block btn-lg btn-secondary"><?php

            $nome_turma='';
            $nome_disciplina='';
            if (isset($_GET['turma'])) {
              $nome_turma=$_GET['turma'];
            } 
            if (isset($_GET['disciplina'])) {
               $nome_disciplina=$_GET['disciplina'];

            }

             echo $nome_turma ." - ". $nome_disciplina; ?></button>
        </div>
      </div>
      <br>
      <br>

      <!-- ################################################################################# -->

                  <?php
                  echo "<div class='row'>
                    <div class='col-lg-3 col-6'>
                      <!-- small card -->
                      <div class='small-box bg-info'>
                        <div class='inner'>
                          <h3></h3>

                          <p></p>
                        </div>
                        <div class='icon'>

                        </div>
                        <a  href='cadastrar_conteudo.php?disc=$iddisciplina&turm=$idturma&turma=$nome_turma&disciplina=$nome_disciplina&idescola=$idescola&idserie=$idserie' class='small-box-footer' target='_blanck'>
                          Conteúdo <ion-icon name='document-text'></ion-icon>
                        </a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class='col-lg-3 col-6'>
                      <!-- small card -->
                      <div class='small-box bg-success'>
                        <div class='inner'>
                          <h3> </h3>

                          <p></p>
                        </div>
                        <div class='icon'>
                          <i class='ion ion-stats-bars'></i>
                        </div>
                        <a href='diario_frequencia.php?disc=$iddisciplina&turm=$idturma&turma=$nome_turma&disciplina=$nome_disciplina&idescola=$idescola&idserie=$idserie' class='small-box-footer' target='_blanck'>
                          Frequência <i class='fa fa-calendar'></i>
                        </a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class='col-lg-3 col-6'>
                      <!-- small card -->
                      <div class='small-box bg-secondary'>
                        <div class='inner'>
                          <h3></h3>

                          <p> </p>
                        </div>
                        <div class='icon'>

                        </div>
                        <a  href='acompanhamento_pedagogico.php?disc=$iddisciplina&turm=$idturma&turma=$nome_turma&disciplina=$nome_disciplina&idescola=$idescola&idserie=$idserie' class='small-box-footer' target='_blanck'>
                          Ocorrência  <ion-icon name='bookmark-outline'></ion-icon>
                        </a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class='col-lg-3 col-6'>
                      <!-- small card -->
                      <div class='small-box bg-danger'>
                        <div class='inner'>
                          <h3></h3>

                          <p></p>
                        </div>
                        <div class='icon'>

                        </div>
                        <a  href='diario_avaliacao.php?disc=$iddisciplina&turm=$idturma&turma=$nome_turma&disciplina=$nome_disciplina&idescola=$idescola&idserie=$idserie' class='small-box-footer' target='_blanck'>
                          Avaliação <i class='fas fa-chart-pie'></i>
                        </a>
                      </div>
                    </div>

                  </div>

                                                          <div class='col-sm-12'>
                                          <div class='card card-secondary collapsed-card'>
                                            <div class='card-header' data-card-widget='collapse'>
                                              <h3 class='card-title'>RESULTADOS/CONTEÚDOS</h3>

                                              <div class='card-tools'>
                                                <button type='button' class='btn btn-tool' data-card-widget='collapse'>
                                                  <i class='fas fa-plus'></i>
                                                </button>
                                              </div>
                                              <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class='card-body' style='display: none;'>
        
                                              <a href='diario_conteudo.php?idturma=$idturma&idescola=$idescola&idserie=$idserie' class='btn btn-secondary btn-block btn-flat'>
                                              <i class='fa fa-edit'></i> 
                                              CONTEÚDOS DE AULAS
                                              </a>";
                                              
                                                if ($idserie<3) {
                                                  echo "<a href='parecer_descritivo.php?idturma=$idturma&idescola=$idescola&idserie=$idserie' class='btn btn-secondary btn-block btn-flat'>
                                                  <i class='fa fa-edit'></i> 
                                                  PARECER DESCRITIVO
                                                  </a>"; 
                                                }

                                             echo " <a class='btn btn-secondary btn-block btn-flat' href='boletim.php?idescola=$idescola&idturma=$idturma&disciplina=$nome_disciplina&idescola=$idescola&idserie=$idserie&tokem_teste=reee' >
                                                    <font style='vertical-align: inherit;'>
                                                     <font style='vertical-align: inherit;'> 
                                                       <i class='fa fa-calendar'></i>
                                                        BOLETIM
                                                        </font>
                                                      </font>
                                              </a>                                       


                                              <a   href='diario_rendimento.php?iddisciplina=$iddisciplina&idturma=$idturma&idescola=$idescola&idserie=$idserie&periodo_id=1' class='btn btn-secondary btn-block btn-flat'>
                                              <i class='fa fa-calendar'></i> 
                                              RESULTADO ANUAL
                                              </a>


                                              <a   href='impressao_diario_frequencia.php?iddisciplina=$iddisciplina&idturma=$idturma&idescola=$idescola&idserie=$idserie&periodo_id=1' class='btn btn-secondary btn-block btn-flat'>
                                              <i class='fa fa-calendar'></i> 
                                              FICHA DE RENDIMENTO TRI I
                                              </a> 

                                              <a   href='impressao_diario_frequencia.php?iddisciplina=$iddisciplina&idturma=$idturma&idescola=$idescola&idserie=$idserie&periodo_id=2' class='btn btn-secondary btn-block btn-flat'>
                                              <i class='fa fa-calendar'></i> 
                                              FICHA DE RENDIMENTO TRI II
                                              </a>   
                                              <a   href='impressao_diario_frequencia.php?iddisciplina=$iddisciplina&idturma=$idturma&idescola=$idescola&idserie=$idserie&periodo_id=3' class='btn btn-secondary btn-block btn-flat'>
                                              <i class='fa fa-calendar'></i> 
                                              FICHA DE RENDIMENTO TRI III
                                              </a>
                                            </div>
                                          <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                      </div> 
                                                                    

                                  </div>";
                  ?>  
      <!-- ################################################################################# -->
  <form action="../Controller/Cadastrar_frequencia.php" method="post">

      <div class="row">
        <div class="col-sm-1"></div>
        
       <div class="col-sm-4" hidden>
          <div class="form-group">
             <label for="exampleInputEmail1">Data da aula</label>
            <input  type="date" class="form-control" name="data_frequencia" id="data_frequencia" required="" min="2021-01-01" >
           <!--  <input type="date" class="form-control" name="data_frequencia" id="data_frequencia" required="" onchange="lista_frequencia_aluno();"> -->
           </div>
        </div>    

        <div class="col-sm-4" hidden>
          <div class="form-group">
            <label for="exampleInputEmail1" hidden>Escolha a aula</label>

            <select  class="form-control" id='aula' required  name='aula' onchange="lista_frequencia_aluno();">
              <?php
              if ($idserie<8) {
                echo "
                <option></option>
                <option value='AULA-1'>AULA-1</option>";
              }else{
                echo"
                <option></option>
                <option value='AULA-1'>AULA-1</option>
                <option value='AULA-2'>AULA-2</option>
                <option value='AULA-3'>AULA-3</option>
                <option value='AULA-4'>AULA-4</option>
                ";
              }
              

              ?>
            </select>
          </div>
        </div>
      
        <div class="col-sm-4">
          <div class="form-group">
            <label class="text-danger" >Datas dos contéudos lançados</label>

            <select class="form-control" id="data_ja_lancada" onchange="data_frequencia_ja_cadastrada(this.value);" >
              <option></option>
              <?php 
                // $resultado=listar_conteudo_aula_cadastrado($conexao, $iddisciplina, $idturma, $idescola, $idprofessor,$ano_letivo);

                if ($idserie<3) {
                  // $iddisciplina="";
                  // $array_disciplina_regente_creche = array('0' => 40,'1' => 42,'2' => 43,'3' => 44);
                  // $array_disciplina_regente_pre_escola = array('0' => 40,'1' => 42,'2' => 44);        

                  //   if ($idserie==1) {
                  //     $iddisciplina=" disciplina_id = 40 or disciplina_id = 42 or  disciplina_id = 43 or disciplina_id = 44  ";

                  //   }else{
                  //     $iddisciplina=" disciplina_id = 40 or  disciplina_id = 42 or disciplina_id = 44  ";
                  //   }
                  $resultado=listar_conteudo_aula_cadastrado_regente($conexao, $iddisciplina, $idturma, $idescola, $idprofessor,$ano_letivo);
                }else{

                  $resultado=listar_conteudo_aula_cadastrado($conexao, $iddisciplina, $idturma, $idescola, $idprofessor,$ano_letivo);
                }
                foreach ($resultado as $key => $value) {
                  $data=$value['data'];
                  $aula=$value['aula'];
                  // $res_freq=verificar_frequencia_na_data_conteudo($conexao,$idescola,$idturma,$iddisciplina,$data,$aula);
                  $background='';
                  // foreach ($res_freq as $key => $value) {
                  //   $background='#2E8B57; color: white;';

                  // }

                  echo"<option value='$data' style='background-color: $background'>".converte_data($data)." - $aula </option>";
                  
                }

               ?>
            </select>
          </div>
        </div>


      </div>

<!-- ####################################################################### -->




<div class="row">

    <div class="col-md-1"></div>
      <div class="col-sm-10">

          <!-- <div class="form-group">
            <label for="exampleInputEmail1" style="color:red;">ATALHO PARA DIÁRIO DE FREQUÊNCIA EM OUTRAS TURMAS/DISCIPLINAS</label>

            <select multiple="multiple" class="form-control" id="atalho" > -->
              <?php
              // $result=listar_disciplina_professor($conexao,$idprofessor,$_SESSION['ano_letivo']);


              // $conta=1;
              // foreach ($result as $key => $value) {

              //   $disciplina=($value['nome_disciplina']);
              //   $nome_escola_atalho=($value['nome_escola']);
              //   $idescola_atalho=($value['idescola']);
              //   $iddisciplina_atalho=$value['iddisciplina'];
              //   $idturma_atalho=$value['idturma'];
              //   $nome_turma_atalho=($value['nome_turma']);
              //   $idserie_atalho=$value['serie_id'];

              //   echo "
              //   <option value='diario_frequencia.php?disc=$iddisciplina_atalho&turm=$idturma_atalho&turma=$nome_turma_atalho&disciplina=$nome_disciplina&idescola=$idescola_atalho&idserie=$idserie_atalho' onclick='atalho();' >
              //       Mudar para turma =>  $nome_turma_atalho - $disciplina  
              //     </option> 

              //   ";
              //   $conta++;
              // }


              ?>
           <!--  </select>
          </div> -->
        </div>


</div>



<div class="row">

    <div class="col-md-1"></div>



    <div class="col-md-10">

      

                <!-- <div class="card">

                  <div class="card-header">

                    <h3 class="card-title">FREQUÊNCIAS CADASTRADAS</h3>

                  </div>

            
                  <div class="card-body">

                 
                    <div id="accordion">



       

                          <div class='card card-primary'>

                            <div class='card-header'>

                              <h4 class='card-title w-100'>



                                <a class='d-block w-100 collapsed' data-toggle='collapse' href='#collapseOne' aria-expanded='false'><b class='text-warning'>
                                    CLIQUE AQUI PARA VER AS FREQUÊNCIAS CADASTRADAS 
                                  </b>

                                </a>

                              </h4>

                            </div>

                            <div id='collapseOne' class='collapse' data-parent='#accordion' style=''>

                              <div class='card-body'>


                          

                                       <table class='table table-primary'>
                                            <thead>
                                              <tr>
                                                <th style='width: 10px'>#</th>
                                                <th>Frequências</th>
                                                <th>
                                                Opções
                                                </th>
                                              </tr>
                                            </thead>
                                            <tbody> -->
                                              <?php 
                                              // $resultado=listar_conteudo_aula_cadastrado($conexao, $iddisciplina, $idturma, $idescola, $idprofessor,$ano_letivo);
                                              //       $conta=1;
                                              //     foreach ($resultado as $key => $value) {
                                              //       $conteudo_aula_id=$value['id'];
                                              //       $data=$value['data'];
                                              //       $aula=$value['aula'];
                                              //       echo"
                                              //       <tr>
                                              //       <td>
                                              //       $conta
                                              //       <input type='hidden' id='conteudo_aula_id$conta' value='$conteudo_aula_id'>
                                              //       </td>
                                              //         <td>$aula - ".converte_data($data)."</td>
                                              //         <td>
                                              //         <!-- a onclick='excluir_frequencia($conta);' class='btn btn-danger'>EXCLUIR FREQUÊNCIA</a -->

                                              //         </td>
                                              //       </tr>";
                                              //       $conta++;
                                              //     }


                                              ?>

                                    <!--         </tbody>
                                      </table>
                                  
               -->

                            </div>

                          </div>

                               


<!-- 
                    </div>

                  </div> -->



        

   <!--              </div>
 

              </div> -->

        <!-- </div> -->







    <!-- Main row -->

    <!-- /.row -->

  <!-- </div> -->


<!-- ####################################################################### -->


<input type="hidden" id="url_get" value="<?php echo $url_get; ?>">
          <input type="hidden" id="local" value="diario_frequencia">


<?php 


?>

  <div class="row" id="listagem_frequencia">


  </div>


   
          <input type="hidden" name="url_get" value="<?php echo $url_get; ?>">

          <input type="hidden" name="idserie" id="idserie" value="<?php echo $idserie; ?>">
          <input type="hidden" name="idescola" id="idescola" value="<?php echo $idescola; ?>">
          <input type="hidden" name="idturma" id="idturma" value="<?php echo $idturma; ?>">
          <input type="hidden" id="iddisciplina" value="<?php echo $iddisciplina; ?>">

      <div class="row" id="botao_continuar">
        
      </div>
      
 </form>



        <!-- Main row -->

        <!-- /.row -->

      </div>





    </div>

  </section>

</div>
<script type="text/javascript">

  function seleciona_tudo(){

      var checkBoxes = document.querySelectorAll('.checkbox');
      var selecionados = 0;
      checkBoxes.forEach(function(el) {
         if(el.checked) {
             //selecionados++;
             console.log(el.value);
            el.checked=false;
         }else{
           
            el.checked=true;
         }
        
      });
     // console.log(selecionados);

    }

// $("#checkTodos__").change(function () {
//     $("input:checkbox").prop('checked', $(this).prop("checked"));
// });

// $("#checkTodos__").click(function(){
//     $('input:checkbox').not(this).prop('checked', this.checked);
// });

// var checkTodos = $("#checkTodos");
// checkTodos.click(function () {
//   if ( $(this).is(':checked') ){
//     $('input:checkbox').prop("checked", true);
//   }else{
//     $('input:checkbox').prop("checked", false);
//   }
// });

</script>


<div class="modal fade" id="modal-video-frequencia">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">VEJA O QUE MUDOU</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        

          <div class="modal-body">
              <!-- /corpo -->
          <center>

            <!-- <h1>ATENÇÃO, NÃO LANÇAR NOTA ANTES DAS 20:30, <font color="RED">SERVIDOR EM MANUTENÇÃO</font></h1> -->
             <iframe width="390" height="315" src="https://www.youtube.com/embed/21hzdV28sR8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </center>
          <br>
           <a href="modal_diario_frequencia.php?<?php echo $url_get; ?>" class="btn btn-block btn-danger">Não quero ver essa notificação novamente</a>
          <br>

          <!-- /corpo -->
        </div>
           <br>
      <button type="button" class="btn btn-default" data-dismiss="modal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Fechar</font></font></button>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>




 <?php 

    include 'rodape.php';

 ?>