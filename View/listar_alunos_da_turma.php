<?php 
session_start();
if (!isset($_SESSION['idfuncionario'])) {
 header("location:index.php?status=0");

}else{

  $idcoordenador=$_SESSION['idfuncionario'];
  $idfuncionario=$_SESSION['idfuncionario'];

}
include "cabecalho.php";
include "alertas.php";
include "barra_horizontal.php";

include 'menu.php';

include '../Controller/Conversao.php';
include '../Controller/Cauculos_notas.php';

include '../Model/Conexao.php';

include '../Model/Aluno.php';
include '../Model/Coordenador.php';
include '../Model/Escola.php';
include '../Model/Serie.php';
include '../Model/Nota.php';
include '../Model/Turma.php';

$idturma=$_GET['idturma']; 
$idescola=$_GET['idescola'];
$idescola_get=$_GET['idescola'];

$rematricula_escola_id=$_GET['idescola']; 
$serie_id=$_GET['idserie']; 
$idserie=$_GET['idserie']; 
$idserie_atual=$_GET['idserie']; 

$array_url=explode('php?', $_SERVER["REQUEST_URI"]);
$url_get=$array_url[1];

?>



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
             if (isset($nome_escola_global)) {
              echo $nome_escola_global; 
            }
            ?>

            <?php if (isset($_SESSION['nome'])) {

              echo " ".$_SESSION['nome'];  

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
    <!-- .row -->
    <div class="row">
      <div class="col-sm-1"></div>
      <div class="col-sm-10">
        <button class="btn btn-block btn-lg btn-secondary">
          <?php
          $nome_turma_global='';
          $nome_disciplina='';
          $res_turma=lista_de_turmas_por_id($conexao,$idturma);

          foreach ($res_turma as $key => $value) {
            $nome_turma_global=$value['nome_turma'];
          }           

          $nome_escola_global='';
    $res_escola=buscar_escola_por_id($conexao,$idescola);
    $nome_escola_global="";
    foreach ($res_escola as $key => $value) {
      $nome_escola_global=$value['nome_escola'];
    }    


          echo "$nome_escola_global-  <b class='text-warning'>$nome_turma_global </b>"  ; ?></button>
        </div>
      </div>
      <br>


      <?php 
      // if (isset($_GET['teste'])) { 
        if ($_SESSION['ano_letivo']==$_SESSION['ano_letivo_vigente']) {
      
        ?>
        <div class="row">
          <div class="col-sm-3">
            <a  class="btn btn-block btn-danger" onclick="mudar_action_form('Solicitacao_transferencia.php');"  data-toggle='modal' data-target='#modal_transferencia'>Transferir selecionados</a>
          </div>
          <?php
        }
   // }
        if ($_SESSION['ano_letivo']!=$_SESSION['ano_letivo_vigente']) {
         ?>
         <div class="col-sm-3">
          <a href="" class="btn btn-block btn-success" onclick="mudar_action_form('Rematricular_aluno.php');"  data-toggle='modal' data-target='#modal_rematricula'>Rematricular selecionados</a>
        </div> 

        <?php 
      } 
      ?>  
      <?php 
      if ($_SESSION['ano_letivo']==$_SESSION['ano_letivo_vigente']) {
       ?>
       <div class="col-sm-3">
        <a href="" class="btn btn-block btn-primary" onclick="mudar_action_form('Troca_aluno_de_turma.php');"  data-toggle='modal' data-target='#modal_troca_de_turma'>Trocar de turma os selecionados</a>
      </div>
      <?php 
    }
    ?>

  </div>



  <form action="" name="procedimentos" id="procedimentos" method="post">




    <div class="row">

     <div class="card-body">

      <table class="table table-bordered">

        <thead>
          <tr>
            <th style="width: 20px">
              Todos
              <input type='checkbox' id='checkTodos' class='checkbox' name='checkTodos' onclick='seleciona_todos_alunos();'> 
            </th>


            <th style="width: 50px">Situação Matrícula</th>
            <th>Dados do Aluno</th>
            <th>Resultado</th>
            <th>Opção</th>
          </tr>
        </thead>

        <tbody>
          <?php
          $conta_aluno=1; 
          $matricula="";

          if ($_SESSION['ano_letivo']==$_SESSION['ano_letivo_vigente']) {
            $result=listar_aluno_da_turma_ata_resultado_final($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
          }else{
            $result=listar_aluno_da_turma_ata_resultado_final_matricula_concluida($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
          }

          foreach ($result as $key => $value) {
            $nome_aluno=($value['nome_aluno']);
            $nome_turma=($value['nome_turma']);
            $id=$value['idaluno'];
            $idaluno=$value['idaluno'];
            $status_aluno=$value['status_aluno'];
            $email=$value['email'];
            $data_nascimento=converte_data($value['data_nascimento']);
            $senha=$value['senha'];
            $matricula_aluno=$value['matricula'];

            $res_movimentacao=pesquisar_aluno_da_turma_ata_resultado_final($conexao,$matricula_aluno,$_SESSION['ano_letivo']);

            $data_evento="";
            $descricao_procedimento="";
            $procedimento="";
            // $matricula="";
            foreach ($res_movimentacao as $key => $value) {
              $datasaida=($value['datasaida']);     
              $procedimento=$value['procedimento'];

              if ($datasaida!="") {
                $datasaida=converte_data($datasaida);
              }
            }
            $res_solicitacao_trasferencia=pesquisar_solicitacao_transferencia_por_aluno($conexao,$matricula_aluno,0);

            $verificar_aluno_na_turna_rematricula=verificar_aluno_na_turna_rematricula($conexao,$idaluno,$_SESSION['ano_letivo_vigente']);
            
          echo "<tr id='linha$idaluno'>
              <input type='hidden' id='matricula$idaluno' name='matricula$idaluno' value='$matricula_aluno'>
              ";
            if ($procedimento!="") {
             echo "

             <td>
             $conta_aluno
             </td>        
             <td>
             $procedimento 
             </td>
             <td  valign=top style='border:solid black 1.0pt;
             $conta_aluno -  
             padding:0cm 0cm 0cm 0cm;height:11.3pt; '>
             $nome_aluno
             Data nascimento: $data_nascimento <BR>
             </td>


             <td colspan='100%' valign=top style='border:solid black 1.0pt;
             ;padding:0cm 0cm 10pt 0cm;height:11.3pt; '>
             $datasaida 
             </td> ";


           }else{
           
           
            if (count($res_solicitacao_trasferencia)==0 && count($verificar_aluno_na_turna_rematricula)==0) {

              echo " <td>$conta_aluno - <p><input type='checkbox' class='checkbox' name='idaluno[]' value='$idaluno'>   </p></td>";
              echo "<td><B>MATRICULADO</B</td>";

            }else{

              if ( count($verificar_aluno_na_turna_rematricula)>0 && $_SESSION['ano_letivo'] == $_SESSION['ano_letivo_vigente']) {
                echo "<td>$conta_aluno -  <p><input type='checkbox' class='checkbox' name='idaluno[]' value='$idaluno'></p> </td>";
                echo "<td><B>ALUNO REMATRICULADO</B></td>";

              }elseif ( count($res_solicitacao_trasferencia)>0) {
                echo "<td>$conta_aluno - </td>";
                echo "<td>  <B>SOLICITADO TRANSFERÊNCIA</B</td>";

              }
    
              elseif (count($verificar_aluno_na_turna_rematricula)>0 && $_SESSION['ano_letivo_vigente']) {

                echo"<td>
                $conta_aluno - 
                </td>";
                echo "<td><B>REMATRICULADO</B</td>";

              }
              elseif (count($verificar_aluno_na_turna_rematricula)==0) {
                echo"<td>
                $conta_aluno - 
                </td>";
                echo "<td><B>MATRICULADO</B</td>";

              }
            }


            echo"
            <td>$id -
            <b class='text-success'> $nome_aluno </b> <BR>
            Data nascimento: $data_nascimento <BR>

            <b class='text-primary'> $nome_turma</b><BR>
            <b class='text-danger'>$email  </b><BR>
            <b class='text-danger'>Senha: $senha  </b><BR>


            </td>";

          
            
          echo"<td> ";   
##############################################################
            $iddisciplina="";
            $media_aprovacao=false;
            $aprovacao_conselho=false;
            $res_disc=listar_disciplina_para_ata($conexao,$idescola,$idturma,$_SESSION['ano_letivo']);
            foreach ($res_disc as $key => $value) {
             $media_aprovacao=false;
             $aprovacao_conselho=false;
             $iddisciplina=$value['iddisciplina'];

             if ($idserie>3) {

               $result_nota_aula1=pesquisa_nota_por_periodo($conexao,$idescola,$idturma,$iddisciplina,$idaluno,1);;

               $nota_tri_1=0;
               $nota_av3_1='';
               $nota_rp_1='';
               foreach ($result_nota_aula1 as $key => $value) {
                 if ($value['avaliacao']!='RP') {
                   $nota_tri_1+=$value['nota'];
                 }
        // _______________________________
                 if ($value['avaliacao']=='av3') {
                   $nota_av3_1=$value['nota'];
                 }
                 if ($value['avaliacao']=='RP') {
                   $nota_rp_1=$value['nota'];
                 }
               }

               $nota_tri_1=calculos_media_notas($nota_tri_1,$nota_rp_1,$nota_av3_1);

// ****************************************************

               $result_nota_aula2=pesquisa_nota_por_periodo($conexao,$idescola,$idturma,$iddisciplina,$idaluno,2);

               $nota_tri_2=0;
               $nota_av3_2='';
               $nota_rp_2='';
               foreach ($result_nota_aula2 as $key => $value) {

                if ($value['avaliacao']!='RP') {
                  $nota_tri_2+=$value['nota'];


                }

                if ($value['avaliacao']=='av3') {
                  $nota_av3_2=$value['nota'];

                }

                if ($value['avaliacao']=='RP') {
                  $nota_rp_2=$value['nota'];


                }

              }

              $nota_tri_2=calculos_media_notas($nota_tri_2,$nota_rp_2,$nota_av3_2);

// ****************************************************
              $result_nota_aula3=pesquisa_nota_por_periodo($conexao,$idescola,$idturma,$iddisciplina,$idaluno,3);


              $nota_tri_3=0;
              $nota_av3_3='';
              $nota_rp_3='';
              foreach ($result_nota_aula3 as $key => $value) {

               if ($value['avaliacao']!='RP') {
                 $nota_tri_3+=$value['nota'];
               }
       //______________________________

               if ($value['avaliacao']=='av3') {
                 $nota_av3_3=$value['nota'];
               }

               if ($value['avaliacao']=='RP') {
                 $nota_rp_3=$value['nota'];
               }

             }

             $nota_tri_3=calculos_media_notas($nota_tri_3,$nota_rp_3,$nota_av3_3);

             $media=($nota_tri_3+$nota_tri_2+$nota_tri_1)/3;
//arivan
             $media=number_format($media, 1, '.', ',');
             if ($media >= 5) {
 // echo number_format($media, 1, '.', ',');
              $media_aprovacao=true;

            }else{
              $res_conselho=buscar_aprovar_concelho($conexao,$idescola,$idturma,$iddisciplina,$idaluno);
              $conta_aprovado=count($res_conselho);

              if ($conta_aprovado>0 ) {
                $media_conselho=number_format('5', 1, '.', ',');
      //echo "<b>$media_conselho</b>";

                $media_aprovacao=false;
                $aprovacao_conselho=true;
              }else{
     // echo number_format($media, 1, '.', ',');
                $media_aprovacao=false;

              }

            }

}//se serie for menor que 3
else{
  $media_aprovacao=true;

}

}// foreche disciplinas


$resultado="";
if($idserie<3){
  echo "<b style='color: green;'>Apr</b>";
  $resultado="Apr";

}elseif ($aprovacao_conselho == true) {
  echo "<b style='color: blue;'>Apc </b>";
  $resultado="Apc";

}elseif ($media_aprovacao == true) {
  echo "<b style='color: green;'>Apr</b>";
  $resultado="Apr";

}elseif ($media_aprovacao == false){
  $media_aprovacao=false;
  echo "<b style='color: red;'>Rep</b>";
  $resultado="Rep";

}


echo "<input type='hidden' name='nome_aluno$idaluno' value='$nome_aluno'>";
echo "<input type='hidden' name='matricula_aluno$idaluno' value='$matricula_aluno'>";
echo "<input type='hidden' name='resultado$idaluno' value='$resultado'>";
echo "<input type='hidden' name='idturma' value='$idturma'>";
echo "<input type='hidden' name='url_get' value='$url_get'>";

##############################################################
echo"</td> ";



echo"<td> ";
if ( count($verificar_aluno_na_turna_rematricula)==0 && $_SESSION['ano_letivo'] == $_SESSION['ano_letivo_vigente']) {
  echo "<a class='btn btn-danger' onclick='excluir_aluno_matriculado($idaluno);' >Excluir aluno</a> <br> <br>";

}elseif ( count($verificar_aluno_na_turna_rematricula)>0 && $_SESSION['ano_letivo'] == $_SESSION['ano_letivo_vigente']) {
  echo "<a class='btn btn-danger' onclick='cancelar_rematricula($idaluno);' >Cancelar rematricula</a> <br> <br>";

}

if ($status_aluno =='Ativo') {
  echo"<div class='form-group'>
  <div class='custom-control custom-switch custom-switch-on-success custom-switch-off-danger'>
  <input type='checkbox' class='custom-control-input' id='customSwitch3$id' onclick='mudar_status_aluno(0,$id)' checked>

  <label class='custom-control-label' for='customSwitch3$id' id='customSwitch3$id' ></label>
  </div>
  </div>";
}else{
  echo"<div class='form-group'>
  <div class='custom-control custom-switch custom-switch-off-danger custom-switch-on-success '>
  <input type='checkbox' class='custom-control-input' id='customSwitch3$id' onclick='mudar_status_aluno(1,$id)'>

  <label class='custom-control-label' for='customSwitch3$id'></label>
  </div>
  </div>";
}


echo"</td>

</tr>
";
            }//procedimento ==""
            $conta_aluno++;
          }
          ?>



        </tbody>

      </table>

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

  function seleciona_todos_alunos(){

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


<!--   <script>
function removerChecked(id) {
    var ele = document.getElementByName(id);
    for(var i=0;i<ele.length;i++){
       ele[i].checked = false;
    }
}

function addChecked(id) {
    var ele = document.getElementByName(id);
    for(var i=0;i<ele.length;i++){
       ele[i].checked = true;
    }
}
</script> -->


<div class="modal fade bd-example-modal-lg" id="modal_transferencia">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header alert alert-danger">
        <h4 class="modal-title">PROCEDIMENTO TRANSFERÊNCIA</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">    

        <div class="row">
            <input type="hidden" name="escola_id_origem" id="escola_id_origem" value="<?php echo $idescola_get; ?>">  
            <input type="hidden" name="turma_id_origem" id="turma_id_origem" value="<?php echo $idturma; ?>">
                 <div class="col-sm-2">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Ano letivo</label>
                    <select  id="ano_letivo" class="form-control" onchange="mudar_ano_letivo(this.value);">
                     <?php 
                     if (isset($_SESSION['ano_letivo'])) {    
                      $ano_letivo_vigente=$_SESSION['ano_letivo_vigente'];
                      echo "<option value='$ano_letivo_vigente' selected>$ano_letivo_vigente</option>";                            
                    }
                    ?>

                  </select>
                </div>
              </div> 


          <div class="col-sm-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Escola pretendida</label>
              <select class="form-control"  name="escola_id" id="escola"  onchange="listar_vagas_turma_transferencia_aluno()">
                <option></option>
                <!-- ESCOLA FORA DO MUNICÍPIO -->
                <option value='0' style='color: black; background-color:#D2691E;'>ESCOLA FORA DA REDE </option>
                <?php 
                $res_turma=escola_associada($conexao,$idfuncionario); 
                $array_escolas_coordenador=array();
                $conta_escolas=0;
                foreach ($res_turma as $key => $value) {
                  $array_escolas_coordenador[$conta_escolas]=$value['idescola'];
                  $conta_escolas++;
                }

                $res_escola=lista_escola($conexao);
                foreach ($res_escola as $key => $value) {
                 $idescola=$value['idescola'];
                 $nome_escola=$value['nome_escola'];
                  if ($idescola_get != $idescola) {
                    // code...
                     if (in_array($idescola, $array_escolas_coordenador) ) { 
                      echo"<option value='$idescola' style='color: white; background-color:#A9A9A9;'>$nome_escola </option>";
                    }else{
                      echo"<option value='$idescola'>$nome_escola </option>";
                    }

                  }

                  }
              ?>
            </select>
          </div>
        </div>
    <div class="col-sm-3">
      <div class="form-group">
        <label for="exampleInputEmail1">Série</label>
        <select class="form-control"  name="serie_id" id="serie" >


          <?php 
          $res_serie=pesquisar_serie_por_id($conexao,$serie_id);
          foreach ($res_serie as $key => $value) {
            $id=$value['id'];
            $nome_serie=$value['nome'];
            echo "<option value='$id'>$nome_serie </option>";
          }
          ?>
        </select>
      </div>
    </div>       
    <div class="col-sm-8">
      <div class="form-group">
        <label for="exampleInputEmail1">Observação <b class="text-danger"> ( Obrigatório )</b></label>
        <textarea class="form-control"  name="observacao" rows="5"><?php echo "Solicito a aceitação da transferência do aluno que está sendo transferido da ESCOLA: $nome_escola_global e TURMA: $nome_turma_global"; ?></textarea>
      </div>
    </div>

  </div>
  <div class="row">
    <div class="col-sm-12" id="resultado">
    </div>
  </div>




  <div class="modal-footer justify-content-between">
   <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
   <!-- onclick='carregando_login()' -->
   <div id="botao_continuar">
     <button type="submit" class="btn btn-primary" >TRANSFERIR SELECIONADOS</button>
   </div>
 </div>

 <!-- /corpo -->
</div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>



<div class="modal fade bd-example-modal-lg" id="modal_rematricula">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header alert alert-success">
        <h4 class="modal-title">PROCEDIMENTO REMATRÍCULA</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">    

        <div class="row">

         <div class="col-sm-2">
          <div class="form-group">
            <label for="exampleInputEmail1">Ano letivo</label>
            <select  id="ano_letivo" class="form-control" onchange="mudar_ano_letivo(this.value);">
             <?php 
             if (isset($_SESSION['ano_letivo'])) {    
              $ano_letivo_vigente=$_SESSION['ano_letivo_vigente'];
              echo "<option value='$ano_letivo_vigente' selected>$ano_letivo_vigente</option>";                            
            }
            ?>

          </select>
        </div>
      </div>  
      <div class="col-sm-2">
        <div class="form-group">
          <input type="hidden" name="rematricula_escola_id" id="rematricula_escola_id" value="<?php echo $rematricula_escola_id; ?>">
          <label for="exampleInputEmail1">Série atual</label>
          <select class="form-control"  name="rematricula_serie_id" id="serie" >


            <?php 
            $res_serie=pesquisar_serie_por_id($conexao,$serie_id);
            foreach ($res_serie as $key => $value) {
              $id=$value['id'];
              $nome_serie=$value['nome'];

              echo "<option value='$id'>$nome_serie </option>";

            }
            ?>
          </select>
        </div>
      </div>    

      <div class="col-sm-3">
        <div class="form-group">

          <label for="exampleInputEmail1">Turno</label>
          <select class="form-control" onchange="lista_turma_escola_por_serie('lista_de_turmas_rematricula');" name="rematricula_turno" id="rematricula_turno" >
            <option></option>
            <option value="MATUTINO">MATUTINO</option>
            <option value="VESPERTINO">VESPERTINO</option>
            <option value="NOTURNO">NOTURNO</option>
            <option value="INTEGRAL">INTEGRAL</option>
          </select>
        </div>
      </div>              

      <div class="col-sm-2">
        <div class="form-group">
          <label for="exampleInputEmail1" class="text-danger">Nova Série</label>
          <select class="form-control"  name="rematricula_nova_serie" id="rematricula_nova_serie"  onchange="lista_turma_escola_por_serie('lista_de_turmas_rematricula');" >
            <option></option>
            <?php 
            $res_destino_rematricula=lista_ordem_serie_rematricula($conexao,$serie_id);
            foreach ($res_destino_rematricula as $key_re => $value_re) {
                $possivel_destino=$value_re['possivel_destino'];

                $res_serie=pesquisar_serie_por_id($conexao,$possivel_destino);
                foreach ($res_serie as $key => $value) {
                  $id=$value['id'];
                  $nome_serie=$value['nome'];
                  echo "<option value='$id'>$nome_serie </option>";
                } 
            }      

            // $res_serie=pesquisar_serie_por_id($conexao,$serie_id+1);
            // foreach ($res_serie as $key => $value) {
            //   $id=$value['id'];
            //   $nome_serie=$value['nome'];
            //   echo "<option value='$id'>$nome_serie </option>";
            // }
            ?>
          </select>
        </div>
      </div>



      <div class="col-sm-3">
        <div class="form-group" id="">
         <label for='exampleInputEmail1' class='text-danger'>Turma pretendida</label>
         <select class='form-control' name='rematricula_turma' id='lista_de_turmas_rematricula' onchange="quantidade_vaga_turma('lista_de_turmas_rematricula');">
         </select>

       </div>
     </div>       

     <div class="col-sm-6">
      <div class="form-group" >
        <label for='exampleInputEmail1' class='text-danger'>Vagas restantes na turma</label>

        <input type="text"  name="quantidade_vagas_restante" id="quantidade_vagas_restante" value="0" readonly class="alert alert-secondary">

      </div>
    </div>
  </div>



  <div class="modal-footer justify-content-between">
   <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
   <!-- onclick='carregando_login()' -->
   <div id="botao_continuar" >
     <button type="submit" class="btn btn-primary" >REMATRICULAR SELECIONADOS</button>
   </div>
 </div>

 <!-- /corpo -->
</div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>  


<div class="modal fade bd-example-modal-lg" id="modal_troca_de_turma">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">PROCEDIMENTO TROCA DE TURMA</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">    

        <div class="row">
          <div class="col-sm-3">
            <div class="form-group">
              <label for="exampleInputEmail1">Ano letivo</label>
              <select  id="ano_letivo" class="form-control" onchange="mudar_ano_letivo(this.value);">
               <?php 
               if (isset($_SESSION['ano_letivo_vigente'])) {    
                $ano_letivo_vigente=$_SESSION['ano_letivo_vigente'];
                echo "<option value='$ano_letivo_vigente' selected>$ano_letivo_vigente</option>";                            
              }
              ?>

            </select>
          </div>
        </div>   

        <div class="col-sm-2">
          <div class="form-group">
            <label for="exampleInputEmail1">Série atual</label>
            <select class="form-control"  name="troca_turma_serie_id_antiga" id="" >


              <?php 
              $res_serie=pesquisar_serie_por_id($conexao,$serie_id);
              foreach ($res_serie as $key => $value) {
                $id=$value['id'];
                $nome_serie=$value['nome'];
                echo "<option value='$id'>$nome_serie </option>";
              }
              ?>
            </select>
          </div>
        </div>    




        <div class="col-sm-3">
         <div class="form-group">

           <label for="exampleInputEmail1" class="text-danger">Novo Turno</label>
           <select class="form-control" onchange="troca_de_turma_escola_por_serie('troca_turma');" name="troca_turma_turno" id="troca_turma_turno"  >
             <option></option>
             <option value="MATUTINO">MATUTINO</option>
             <option value="VESPERTINO">VESPERTINO</option>
             <option value="NOTURNO">NOTURNO</option>
             <option value="INTEGRAL">INTEGRAL</option>
           </select>
         </div>
       </div> 


       <div class="col-sm-2">
         <div class="form-group">
           <label for="exampleInputEmail1" class="text-danger">Nova Série</label>
           <select class="form-control"  name="troca_turma_serie_id" id="troca_turma_serie_id"  onchange="troca_de_turma_escola_por_serie();" >
             <option></option>
             <?php 
             $res_destino_rematricula=lista_ordem_serie_rematricula($conexao,$serie_id);
             foreach ($res_destino_rematricula as $key_re => $value_re) {
                 $possivel_destino=$value_re['possivel_destino'];

                 $res_serie=pesquisar_serie_por_id($conexao,$possivel_destino);
                 foreach ($res_serie as $key => $value) {
                   $id=$value['id'];
                   $nome_serie=$value['nome'];
                   echo "<option value='$id'>$nome_serie </option>";
                 } 
             }      
             ?>
           </select>
         </div>
       </div>
       <div class="col-sm-3">
         <div class="form-group" >
            <label class="text-danger">Nova turma</label>
            <select id="lista_de_turmas_troca_turma" name="lista_de_turmas_troca_turma" class="form-control" onchange="quantidade_vaga_turma('troca_turma');">

            </select>
         </div>
       </div> 
        <div class="col-sm-4">
         <div class="form-group" >
           <label for='exampleInputEmail1' class='text-danger'>Vagas restantes na turma</label>

           <input type="text"  name="quantidade_vagas_restante_troca_turma" id="quantidade_vagas_restante_troca_turma" value="0" readonly class="alert alert-secondary">

         </div>
       </div>

     </div>



     <div class="modal-footer justify-content-between">
       <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
       <!-- onclick='carregando_login()' -->
       <div id="botao_continuar" >
         <button type="submit" class="btn btn-primary" >TOCAR DE TURMA ALUNOS SELECIONADOS</button>
       </div>
     </div>

     <!-- /corpo -->
   </div>
 </div>
 <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>

</form>

<script>
  function mudar_action_form(procedimento){
    document.procedimentos.action = "../Controller/"+procedimento+"";
  }  


</script>

<?php 

include 'rodape.php';

?>