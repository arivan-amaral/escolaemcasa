<?php 
session_start();
$idserie=$_GET['idserie']; 
$idserie_t=$_GET['idserie']; 
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

if (!isset($_SESSION['idprofessor']) && !isset($_GET['idprofessor'])) {
       header("location:index.php?status=0");

}else if (isset($_GET['idprofessor'])) {
  // code...
  $idprofessor= $_GET['idprofessor'];
  $idfuncionario=$_SESSION['idfuncionario'];

}else{ 

  $idprofessor=$_SESSION['idprofessor'];
  $idfuncionario=$_SESSION['idprofessor'];

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

  include_once '../Model/Aluno.php';
  include_once '../Model/Professor.php';
  include_once '../Model/Turma.php';

  $idescola=$_GET['idescola']; 
  $idescola_get=$_GET['idescola']; 
  $idturma=$_GET['turm']; 
  $idturma_get=$_GET['turm']; 
  $iddisciplina=$_GET['disc']; 
  $iddisciplina_get=$_GET['disc'];
  $ano_letivo=$_SESSION['ano_letivo']; 


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

 $res_seg=$conexao->query("SELECT * FROM turma WHERE idturma=$idturma LIMIT 1");
   $seguimento='';

 foreach ($res_seg as $key => $value) {
   $seguimento=$value['seguimento'];
   // code...
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
                        <a href='diario_frequencia.php?idprofessor=$idprofessor&disc=$iddisciplina&turm=$idturma&turma=$nome_turma&disciplina=$nome_disciplina&idescola=$idescola&idserie=$idserie' class='small-box-footer' target='_blanck'>
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
                        <a  href='acompanhamento_pedagogico.php?idprofessor=$idprofessor&ddisc=$iddisciplina&turm=$idturma&turma=$nome_turma&disciplina=$nome_disciplina&idescola=$idescola&idserie=$idserie' class='small-box-footer' target='_blanck'>
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

                  </div>";
                  ?>  
      <!-- ################################################################################# -->
  <form action="../Controller/Cadastrar_conteudo.php" method="post">
    <input type="hidden" name="url_get" value="<?php echo $url_get; ?>">
    <input type="hidden" name="idprofessor" id="idprofessor" value="<?php echo $idprofessor; ?>">
    <input type="hidden" name="idfuncionario" id="idfuncionario" value="<?php echo $idfuncionario; ?>">

    <input type="hidden" name="idserie" id="idserie" value="<?php echo $idserie; ?>">
    <input type="hidden" name="idescola" id="idescola" value="<?php echo $idescola; ?>">
    <input type="hidden" name="idturma" id="idturma" value="<?php echo $idturma; ?>">
    <input type="hidden" id="iddisciplina" value="<?php echo $iddisciplina; ?>">
    <input type="hidden" id="seguimento" value="<?php echo $seguimento; ?>">


      <div class="row">

        <div class="col-sm-3">
          <div class="form-group">
            <label for="exampleInputEmail1">Data da aula</label>
            <input type="date" class="form-control" name="data_frequencia" id="data_frequencia" required="" min="<?php echo date("Y")."01-01"; ?>" max="<?php echo  date("Y")."12-31"; ?>" onchange="verifica_dia_letivo('data_frequencia');lista_conteudo_aluno();">
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
              if ($idserie<3 || ( $idserie==16 && $seguimento<2 )) {
                $iddisciplina="";
       
                $resultado=listar_conteudo_aula_cadastrado_regente($conexao, $iddisciplina, $idturma, $idescola, $idprofessor ,$ano_letivo);
              }else{

                $resultado=listar_conteudo_aula_cadastrado($conexao, $iddisciplina, $idturma, $idescola, $idprofessor,$ano_letivo);
              }
          
                $array_aulas = array();

                foreach ($resultado as $key => $value) {
                  $data=$value['data'];
                  $aula=$value['aula'];
                  $array_aulas[$data]=$aula;
                  // $res_freq=verificar_frequencia_na_data_conteudo($conexao,$idescola,$idturma,$iddisciplina,$data,$aula);
                  $background='';
                  // foreach ($res_freq as $key => $value) {
                  //   $background='#2E8B57; color: white;';

                  // }

                  if ($idserie>=3) {
                      echo"<option value='$data' style='background-color: $background'>".converte_data($data)." - $aula </option>";
                    // code...
                  }

                }
                if ($idserie <3) {
                    foreach ($array_aulas as $key => $value) {
                       
                      echo"<option value='$key' style='background-color: $background'>".converte_data($key)." - $value </option>";
                    }
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
                                <?php 
                                  $resultado=listar_trimestre($conexao,$ano_letivo);
                                  foreach ($resultado as $key => $value) {
                                    $idperiodo=$value['id'];
                                    $descricao=$value['descricao'];
                                    $inicio=$value['inicio'];
                                    $fim=$value['fim'];
                                    if ($idperiodo !=6) {
                                   
                                    
                                  

                                  echo " <div class='row' onclick='buscar_datas_conteudos($idperiodo);'>";
                                 ?>

                                  <input type="hidden" id="periodo_inicio<?php echo $idperiodo ;?>" value="<?php echo $inicio; ?>">
                                  <input type="hidden" id="periodo_fim<?php echo $idperiodo ;?>" value="<?php echo $fim; ?>">
                                   <input type="hidden" id="periodo<?php echo $idperiodo ;?>" value="0">
                                   
                                   <div class='col-sm-12'>
                                     <div class='card card-info'>
                                       <div class='card-header' data-card-widget='collapse'>
                                         <h3 class='card-title'>  <?php echo $descricao; ?> </h3>

                                         <div class='card-tools'>
                                           <button type='button' class='btn btn-tool' data-card-widget='collapse'>
                                             <i class='fas fa-plus'></i>
                                           </button>
                                         </div>
                                         <!-- /.card-tools -->
                                       </div>
                                       <!-- /.card-header -->
                                       <div class='card-body' style='display: none;'>

                                          <span id="resultado<?php echo $idperiodo ;?>"></span>  
 
                
                                           </div>
                                         </div>
                                       </div>
                                     </div>

                                  <?php 
                                      }
                                    }
                                  ?>
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

  function duplica_texto_em_campos_selecionados_mesmo_conteudo_acima_inicias(id_sendo_digitado){
   var mesma_serie_mesma_disciplina= document.getElementById("mesma_"+id_sendo_digitado).value;
    var mesmo_conteudo_regente = document.querySelectorAll(".mesmo_conteudo"+mesma_serie_mesma_disciplina);
    mesmo_conteudo_regente.forEach(function(elemento_mesmo_conteudo_regente) {
      if(elemento_mesmo_conteudo_regente.id !=id_sendo_digitado){
        elemento_mesmo_conteudo_regente.value=document.getElementById(id_sendo_digitado).value

      }
    });
   console.log(mesma_serie_mesma_disciplina);
             
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

    include_once 'rodape.php';

 ?>