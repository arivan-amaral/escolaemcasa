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
  $ano_letivo=$_SESSION['ano_letivo'];

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
          $nome_turma='';
          $nome_disciplina='';
          $res_turma=lista_de_turmas_por_id($conexao,$idturma);

          foreach ($res_turma as $key => $value) {
            $nome_turma=$value['nome_turma'];
          }           

          $nome_escola='';
    $res_escola=buscar_escola_por_id($conexao,$idescola);
    $nome_escola="";
    foreach ($res_escola as $key => $value) {
      $nome_escola=$value['nome_escola'];
    }    


          echo "$nome_escola - <b class='text-warning'>$nome_turma </b>"  ; ?></button>
        </div>
      </div>
      <br>


    



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
            $res_disc=listar_disciplina_para_ata($conexao,$idescola,$idturma,$ano_letivo);
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
 

if ($status_aluno =='Ativo') {
  echo "ATIVO"; 
}else{
  echo"DESATIVADO";
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

 

<?php 

include 'rodape.php';

?>