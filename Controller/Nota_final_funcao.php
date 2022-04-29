<?php
// include '../Model/Conexao.php';
function media_final($conexao,$idescola,$idturma,$iddisciplina,$periodo_id, $idaluno ){
        $result_nota_aula1=$conexao->query("
          SELECT * FROM nota_parecer WHERE
          escola_id=$idescola and
          turma_id=$idturma and
          disciplina_id=$iddisciplina and 
          periodo_id=1 and aluno_id=$idaluno  group by avaliacao,periodo_id ");


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

        if ($nota_tri_1<5 && $nota_rp_1!='' && $nota_rp_1>$nota_av3_1) {
         $nota_tri_1=($nota_tri_1-$nota_av3_1)+$nota_rp_1;
       }

     //  echo "$nota_tri_1";
     

      $result_nota_aula2=$conexao->query("
        SELECT * FROM nota_parecer WHERE
        escola_id=$idescola and
        turma_id=$idturma and
        disciplina_id=$iddisciplina and 
        periodo_id=2 and aluno_id=$idaluno  group by avaliacao,periodo_id ");


      $nota_tri_2=0;
      $nota_av3_2='';
      $nota_rp_2='';
      foreach ($result_nota_aula2 as $key => $value) {

        if ($value['avaliacao']!='RP') {
          $nota_tri_2+=$value['nota'];


        }
          // ***************************************
        if ($value['avaliacao']=='av3') {
          $nota_av3_2=$value['nota'];

        }

        if ($value['avaliacao']=='RP') {
          $nota_rp_2=$value['nota'];


        }

      }

      if ($nota_tri_2<5 && $nota_rp_2!='' && $nota_rp_2>$nota_av3_2) {
       $nota_tri_2=($nota_tri_2-$nota_av3_2)+$nota_rp_2;
     }

//     echo "$nota_tri_2";


   $result_nota_aula3=$conexao->query("
     SELECT * FROM nota_parecer WHERE
     escola_id=$idescola and
     turma_id=$idturma and
     disciplina_id=$iddisciplina and 
     periodo_id=3 and aluno_id=$idaluno  group by avaliacao,periodo_id ");


   $nota_tri_3=0;
   $nota_av3_3='';
   $nota_rp_3='';
   foreach ($result_nota_aula3 as $key => $value) {

     if ($value['avaliacao']!='RP') {
       $nota_tri_3+=$value['nota'];


     }
       // ***************************************
     if ($value['avaliacao']=='av3') {
       $nota_av3_3=$value['nota'];

     }

     if ($value['avaliacao']=='RP') {
       $nota_rp_3=$value['nota'];


     }

   }

   if ($nota_tri_3<5 && $nota_rp_3!='' && $nota_rp_3>$nota_av3_3) {
    $nota_tri_3=($nota_tri_3-$nota_av3_3)+$nota_rp_3;
  }

  $nf= ($nota_tri_1+$nota_tri_2+$nota_tri_3)/3;
  //echo "$nota_tri_3";
  return number_format($nf, 1, '.','');
  }