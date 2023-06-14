<?php 
set_time_limit(0);
session_start();
  include"../Controller/Conversao.php";
  include"../Model/Conexao.php";
  include"../Model/Aluno.php";
  include"../Model/Escola.php";
  include"../Model/Turma.php";
  include"../Model/Professor.php";

  include"boletim_maternall_II.php";
  include"boletim_serie_1ano_id_3.php";
  include"boletim_fundamental_II.php";
  include"boletim_fundamental_turma.php";
  include"teste_boletim.php";
  include"../Controller/Cauculos_notas.php";
  //include('mpdf/mpdf60/mpdf.php');

$idescola=$_GET['idescola'];
$idturma=$_GET['idturma'];
$idserie=$_GET['idserie'];
$res_escola=buscar_escola_por_id($conexao,$idescola);
$nome_escola="";
$nome_turma="";
$ano_letivo=$_SESSION['ano_letivo'];

foreach ($res_escola as $key => $value) {
  $nome_escola=$value['nome_escola'];
}
$res_turma=lista_de_turmas_por_id($conexao,$idturma);

foreach ($res_turma as $key => $value) {
  $nome_turma=$value['nome_turma'];
}

include_once"cabecalho_boletim.php";
?>

<!-- ################################################################################ -->
<p class="no-print">
  <br>
  <br>
  
<a href='#'class="btn btn-block btn-primary " onclick='print();'>IMPRIMIR</a> 

</p>
<!-- <h1>PÁGINA EM MANUTENÇÃO</h1> -->

   
<!-- <a href="#" onclick="demoFromHTML();">BAIXAR BOLETINS</a> -->
<div id="employee_detail">

<?php



  $res_calendario=listar_data_periodo($conexao,$ano_letivo);
  foreach ($res_calendario as $key => $value) {
  
      if ($value['periodo_id']==1) {
          $data_inicio_trimestre1=$value['inicio'];
          $data_fim_trimestre1=$value['fim'];
      }elseif ($value['periodo_id']==2){
          $data_inicio_trimestre2=$value['inicio'];
          $data_fim_trimestre2=$value['fim'];
      }elseif ($value['periodo_id']==3){
          $data_inicio_trimestre3=$value['inicio'];
          $data_fim_trimestre3=$value['fim'];
      }

    
  }


$numero=1; 

 if ($idserie > 8) {
    //echo "<H1> <font color='red'>PÁGINA EM MANUTENÇÃO</font> </H1><BR>";
    $numero=1;
        echo "<input type='hidden' name='$numero' value='$numero'>";
        echo "<input type='hidden' name='uuuunumero' value='numero'>";
    if ($_SESSION['ano_letivo']==$_SESSION['ano_letivo_vigente']) {
      $res_alunos=listar_aluno_da_turma_ata_resultado_final($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
    }else{
     $res_alunos=listar_aluno_da_turma_ata_resultado_final_matricula_concluida($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
    }

      // $res_alunos=listar_aluno_da_turma_professor($conexao,$idturma,$idescola);
      foreach ($res_alunos as $key => $value) {
        $idaluno=$value['idaluno'];
        $nome_aluno=($value['nome_aluno']);
      


          $res_disc=listar_disciplina_para_boletim($conexao,$idturma,$idescola,$ano_letivo);

          
          $conta_parecer=0;
          $linha=0;
          $resultado_final=true;
          $resultado_conselho=false;
          
          $conta_dis=0;
          $conta_conselho=0;
          $conta_apr=0;



          foreach ($res_disc as $key => $value) {
            $iddisciplina=$value['iddisciplina'];
            $nome_disciplina=$value['nome_disciplina'];
            $conta_dis++;


              $result_nota_aula1=$conexao->query("
                SELECT avaliacao,periodo_id,nota FROM nota_parecer WHERE
                escola_id=$idescola and
                turma_id=$idturma and
                disciplina_id=$iddisciplina and 
                ano_nota=$ano_letivo and
                periodo_id=1 and aluno_id=$idaluno  group by avaliacao,periodo_id,nota,nota ");


              $nota_tri_1=0;
              $nota_av3_1='';
              $nota_rp_1='';
              foreach ($result_nota_aula1 as $key => $value) {

                if ($value['avaliacao']!='RP') {
                  $nota_tri_1+=$value['nota'];


                }
                  // ***************************************
                if ($value['avaliacao']=='av3') {
                  $nota_av3_1=$value['nota'];

                }

                if ($value['avaliacao']=='RP') {
                  $nota_rp_1=$value['nota'];


                }

              }

           
            $nota_tri_1=calculos_media_notas($nota_tri_1,$nota_rp_1,$nota_av3_1);

             // echo "$nota_tri_1";
            echo "nota: ".number_format($nota_tri_1, 1, '.', ',');


          }


      
      }
      
}

?>
</div>
 


</body>
</html>