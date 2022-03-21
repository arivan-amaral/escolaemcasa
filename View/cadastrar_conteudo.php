<?php 
session_start();
$idserie=$_GET['idserie']; 
$ano_letivo=$_SESSION['ano_letivo'];

 
// if ($idserie< 8 && !isset($_COOKIE['notificado'])) {
    
//   echo "<script type='text/javascript'>
//       function modal_video() {
//           $(document).ready(function() {
//               $('#modal-video-frequencia').modal('show');
//             });
//       }

//       setTimeout('modal_video();',1000);
      
//   </script>";
 
  
// }

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
  $idescola_get=$_GET['idescola']; 
  $idturma=$_GET['turm']; 
  $idturma_get=$_GET['turm']; 
  $iddisciplina=$_GET['disc']; 
  $iddisciplina_get=$_GET['disc']; 

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

          <div class="col-sm-12 alert alert-info text-center">

            <h1 class="m-0"><b> ÁREA DE REGISTRO DE CONTEÚDO</b></h1>

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
            <button class="btn btn-block btn-lg btn-secondary" id="descricao_escola_turma"><?php

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
  <form action="../Controller/Cadastrar_conteudo.php" method="post">

      <div class="row">

        <div class="col-sm-3">
          <div class="form-group">
            <label for="exampleInputEmail1">Data da aula</label>
            <input type="date" class="form-control" name="data_frequencia" id="data_frequencia" required="" min="<?php echo $_SERVER['ano_letivo']."01-01"; ?>" max="<?php echo $_SERVER['ano_letivo']."12-31"; ?>" onchange="verifica_dia_letivo('data_frequencia');">
            <!-- <input type="date" class="form-control" name="data_frequencia" id="data_frequencia" required="" onchange="lista_frequencia_aluno();"> -->
          </div>
        </div>   

        <div class="col-sm-3">
          <div class="form-group">
            <label for="exampleInputEmail1">Escolha a aula</label>

            <select class="form-control" id='aula' required  name='aula' onchange="lista_conteudo_aluno();">
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
      
        <div class="col-sm-6">
          <div class="form-group">
            <label for="exampleInputEmail1">Datas dos conteúdos lançadas</label>

            <select class="form-control" id="data_ja_lancada" onchange="listar_conteudo_cadastrado(this.value);" >
              <option></option>
              <?php  
              if ($idserie<3) {
                $iddisciplina="";
                // $array_disciplina_regente_creche = array('0' => 40,'1' => 42,'2' => 43,'3' => 44);
                // $array_disciplina_regente_pre_escola = array('0' => 40,'1' => 42,'2' => 44);        

                //   if ($idserie==1) {
                //     $iddisciplina=" disciplina_id = 40 or disciplina_id = 42 or  disciplina_id = 43 or disciplina_id = 44  ";

                //   }else{
                //     $iddisciplina=" disciplina_id = 40 or  disciplina_id = 42 or disciplina_id = 44  ";
                //   }
                $resultado=listar_conteudo_aula_cadastrado_regente($conexao, $iddisciplina, $idturma, $idescola, $idprofessor ,$ano_letivo);
              }else{

                $resultado=listar_conteudo_aula_cadastrado($conexao, $iddisciplina, $idturma, $idescola, $idprofessor,$ano_letivo);
              }

                foreach ($resultado as $key => $value) {
                  $data=$value['data'];
                  $aula=$value['aula'];
                  //echo"<option value='$data' >".converte_data($data)." - $aula </option>";
                  
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
    <div class="col-md-10">


              <?php 
                if ($idserie>=8) {
              ?>
               
                  <?php


                  //   $result_disciplinas=listar_disciplina_professor($conexao,$idprofessor,$_SESSION['ano_letivo']);



                  //   foreach ($result_disciplinas as $key => $value) {

                  //     $disciplina=($value['nome_disciplina']);
                  //     $nome_escola=($value['nome_escola']);
                  //     $turma=($value['nome_turma']);
                  //     $idescola=($value['idescola']);
                  //     $iddisciplina=$value['iddisciplina'];
                  //     $idturma=$value['idturma'];
                  //     $idserie=$value['serie_id'];
                  //      if ($idturma==$idturma_get && $idescola==$idescola_get && $iddisciplina=$iddisciplina_get) {
                  //         echo"
                  //         <div class='custom-control custom-checkbox'>
                  //         <input class='custom-control-input check' name='escola_turma_disciplina[]' type='checkbox' id='customCheckbox$idturma$idescola$iddisciplina' value='$idescola+$idturma+$iddisciplina+$idserie' required checked>
                  //         <label for='customCheckbox$idturma$idescola$iddisciplina' class='custom-control-label'> $nome_escola - <font style='color:#8B0000'>$turma -$disciplina</font> </label>
                  //         </div>";
                  //       }else{
                  //         echo"
                  //         <div class='custom-control custom-checkbox'>
                  //         <input class='custom-control-input check' name='escola_turma_disciplina[]' type='checkbox' id='customCheckbox$idturma$idescola$iddisciplina' value='$idescola+$idturma+$iddisciplina+$idserie'>
                  //         <label for='customCheckbox$idturma$idescola$iddisciplina' class='custom-control-label'> $nome_escola - <font style='color:#8B0000'>$turma -$disciplina</font> </label>
                  //         </div>";
                  //       }




                  // }


                  // $result_disciplinas=listar_turmas_com_mesma_disciplinas_do_professor($conexao,$idescola,$idprofessor,$idserie,$iddisciplina);

                  //  foreach ($result_disciplinas as $key => $value) {
                  //      $turma_id=$value['idturma'];
                  //      $nome_turma=$value['nome_turma'];
                  //      $nome_disciplina=$value['nome_disciplina'];
                    
                  //      if ($idturma==$turma_id) {
                  //         echo"
                  //         <div class='custom-control custom-checkbox'>
                  //             <input class='custom-control-input' name='idturma_conteudo[]' type='checkbox' id='customCheckbox$turma_id' value='$turma_id' required checked>
                  //             <label for='customCheckbox$turma_id' class='custom-control-label'>$nome_turma - $nome_disciplina</label>
                  //         </div>";

                  //      } else {
                  //       echo"
                  //       <div class='custom-control custom-checkbox'>
                  //           <input class='custom-control-input' name='idturma_conteudo[]' type='checkbox' id='customCheckbox$turma_id' value='$turma_id'  >
                  //           <label for='customCheckbox$turma_id' class='custom-control-label'>$nome_turma - $nome_disciplina</label>
                  //       </div>";

                        
                  //     }
                  // }

                  ?>


      <?php 

      }

      ?>
    </div>

</div>

<?php 
if ($idserie>2) {

?>
 
          <div class="row">
          <div class="col-sm-12">

          <div class="form-group">
            <label for="exampleInputEmail1" style="color:red;">ATALHO PARA DIÁRIO DE CONTEÚDO EM OUTRAS TURMAS/DISCIPLINAS</label>

            <select multiple="multiple" class="form-control" id="atalho" >
              <?php
              $result=listar_disciplina_professor($conexao,$idprofessor,$_SESSION['ano_letivo']);


              $conta=1;
              foreach ($result as $key => $value) {

                $disciplina=($value['nome_disciplina']);
                $nome_escola_atalho=($value['nome_escola']);
                $idescola_atalho=($value['idescola']);
                $iddisciplina_atalho=$value['iddisciplina'];
                $idturma_atalho=$value['idturma'];
                $nome_turma_atalho=($value['nome_turma']);
                $idserie_atalho=$value['serie_id'];

                echo "
                <option value='cadastrar_conteudo.php?disc=$iddisciplina_atalho&turm=$idturma_atalho&turma=$nome_turma_atalho&disciplina=$disciplina&idescola=$idescola_atalho&idserie=$idserie_atalho' onclick='atalho();' >
                    Mudar para turma =>  $nome_turma_atalho - $disciplina  
                  </option> 

                ";
                $conta++;
              }


              ?>
            </select>
          </div>
        </div>


</div>

        <?php 


          // code...
}
?>


<div class="row">

    <div class="col-md-1"></div>



    <div class="col-md-10">

                <div class="card">

                  <div class="card-header">

                    <h3 class="card-title">CONTEÚDOS CADASTRADOS</h3>

                  </div>

                  <!-- /.card-header -->

                  <div class="card-body">

                    <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->

                    <div id="accordion">



       

                          <div class='card card-primary'>

                            <div class='card-header'>

                              <h4 class='card-title w-100'>



                                <a class='d-block w-100 collapsed' data-toggle='collapse' href='#collapseOne' aria-expanded='false'><b class='text-warning'>
                                    CLIQUE AQUI PARA VER OS CONTEÚDOS CADASTRADOS 
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
                                                <th>Conteúdo</th>
                                                <th>
                                                Opções
                                                </th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <?php 

                                              if ($idserie<3) {
                                                $iddisciplina="";
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
                                                    $conta=1;
                                                foreach ($resultado as $key => $value) {
                                                    $professor_id=$value['professor_id'];
                                                    $conteudo_aula_id=$value['id'];
                                                   $nome_disciplina="";
                                                    if (isset($value['nome_disciplina'])) {
                                                      $nome_disciplina=$value['nome_disciplina'];
                                                    }
                                                    $data=$value['data'];
                                                    $aula=$value['aula'];
                                                    echo"
                                                    <tr>
                                                    <td>
                                                    $conta
                                                    <input type='hidden' id='conteudo_aula_id$conta' value='$conteudo_aula_id'>
                                                    </td>
                                                      <td>$nome_disciplina $aula - ".converte_data($data)."<br>
                                                      ";
                                                      $res_prof=pesquisar_professor_por_id_status($conexao,$idprofessor);
                                                      foreach ($res_prof as $key => $value) {
                                                        $nome_funcionario=$value['nome'];
                                                        
                                                        echo"<b>Professor: $professor_id - $nome_funcionario </b>";
                                                      }

                                                      echo "
                                                      </td>
                                                      <td><a onclick='excluir_frequencia($conta);' class='btn btn-danger'>EXCLUIR</a></td>
                                                    </tr>";
                                                    $conta++;
                                                  }


                                              ?>

                                            </tbody>
                                      </table>
                                  
              

                            </div>

                          </div>

                               



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


<!-- ####################################################################### -->


<input type="hidden" id="url_get" value="<?php echo $url_get; ?>">
          <input type="hidden" id="local" value="cadastrar_conteudo">


<?php 


?>

  <div class="row" id="listagem_frequencia">


  </div>



   <div class="row" id="inputs"></div>


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


  function duplica_texto_em_capos_selecionados(id_sendo_digitado){
   
    var mesmo_conteudo_regente = document.querySelectorAll('.mesmo_conteudo_regente');
    mesmo_conteudo_regente.forEach(function(elemento_mesmo_conteudo_regente) {
      if(elemento_mesmo_conteudo_regente.id !=id_sendo_digitado){
        elemento_mesmo_conteudo_regente.value=document.getElementById(id_sendo_digitado).value

      }
    });
             
  }


  function seleciona_tudo(){

      var checkBoxes = document.querySelectorAll('.checkbox');

      var selecionados = 0;
      checkBoxes.forEach(function(el) {
         if(el.checked) {
             //selecionados++;
            el.checked=false;
         }else{
           
            el.checked=true;
         }
        
      });
      console.log(selecionados);

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



 <?php 

    include 'rodape.php';

 ?>