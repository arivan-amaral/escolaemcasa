<?php 
function boletim_fund_turma($conexao,$idescola,$idturma,$idserie,$idaluno,$numero,$nome_aluno,$nome_escola,$nome_turma,$ano_letivo){

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
  
?>
          <div class="row">
            <div class="col-md-6"><h6 align="center">ALUNO: <?php echo $nome_aluno; ?></h6></div>
            <div class="col-md-6"><h6>TURMA: <?php echo $nome_turma; ?></h6></div>
            
            
          </div>
          <div class="row">
            <div class="table-responsive">
            <table class="table">
              <thead>
                <th scope="col">COMPONENTE CURRICULAR</th>
                <th scope="col">I TRIM</th>
                <th scope="col">II TRIM</th>
                <th scope="col">III TRIM</th>
                <th scope="col">NF</th>
              </thead>
              <tbody>
                <?php 
                $res_disc=listar_disciplina_para_boletim($conexao,$idturma,$idescola,$ano_letivo);

                // $res_disc=listar_disciplina_para_boletim($conexao,$idturma,$idescola,$ano_letivo);
                // $res_disc=listar_disciplina_para_boletim($conexao,$idaluno,$ano_letivo);
                $conta_parecer=0;
                $linha=0;
                $resultado_final=true;
                $resultado_conselho=false;

                foreach ($res_disc as $key => $value) {
                  $iddisciplina=$value['iddisciplina'];
                  $nome_disciplina=$value['nome_disciplina'];

                  ?>
                  <tr>
                    <td>
                    <label>
                      
                      <?php echo $nome_disciplina; ?>

                    </label>
                    </td>
                    <td>
                  <?php
                  $result_nota_aula1=$conexao->query("
                    SELECT avaliacao,periodo_id,nota FROM nota_parecer WHERE
                    escola_id=$idescola and
                    turma_id=$idturma and
                    disciplina_id=$iddisciplina and 
                    ano_nota=$ano_letivo and
                    periodo_id=1 and aluno_id=$idaluno  group by avaliacao,periodo_id,nota,nota ");

                  $nota_tri_1 = 0;
                  $nota_av_1=0;
                  $nota_av_2=0;
                  $nota_av_3=0;
           
                  foreach ($result_nota_aula1 as $key => $value) {

                    if ($value['avaliacao']=='av1') {
                      $nota_av_1=$value['nota'];
                    }

                     if ($value['avaliacao']=='av2') {
                      $nota_av_2=$value['nota'];
                    }

                     if ($value['avaliacao']=='av3') {
                      $nota_av_3=$value['nota'];
                    }
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

                  //$nota_tri_1=calculos_media_notas($nota_tri_1,$nota_rp_1,$nota_av3_1);

                 echo "AV1: $nota_av_1 <br> AV2: $nota_av_2 <br> AV3: $nota_av_3";
                 ?>
               </td>
               <td>
                 <?php
                  $result_nota_aula2=$conexao->query("
                    SELECT avaliacao,periodo_id,nota FROM nota_parecer WHERE
                    escola_id=$idescola and
                    turma_id=$idturma and
                    ano_nota=$ano_letivo and
                    disciplina_id=$iddisciplina and 
                    periodo_id=2 and aluno_id=$idaluno  group by avaliacao,periodo_id,nota ");

                  $nota_tri_2 = 0;
                  $nota_av_1=0;
                  $nota_av_2=0;
                  $nota_av_3=0;
                  $nota_av3_2='';
                  $nota_rp_2='';
                  foreach ($result_nota_aula2 as $key => $value) {

                    if ($value['avaliacao']=='av1') {
                      $nota_av_1=$value['nota'];
                    }
                     if ($value['avaliacao']=='av2') {
                      $nota_av_2=$value['nota'];
                    }
                     if ($value['avaliacao']=='av3') {
                      $nota_av_3=$value['nota'];
                    }

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

                 echo "AV1: $nota_av_1 <br> AV2:$nota_av_2 <br> AV3:$nota_av_3 ";
                 ?>
               </td>
               <td>
                 <?php

                   $result_nota_aula3=$conexao->query("
                     SELECT avaliacao,periodo_id,nota FROM nota_parecer WHERE
                     escola_id=$idescola and
                     turma_id=$idturma and
                     ano_nota=$ano_letivo and
                     disciplina_id=$iddisciplina and 
                     periodo_id=3 and aluno_id=$idaluno  group by avaliacao,periodo_id,nota ");

                   $nota_tri_3= 0;
                   $nota_av_1=0;
                   $nota_av_2=0;
                   $nota_av_3=0;
                   $nota_av3_3='';
                   $nota_rp_3='';
                   foreach ($result_nota_aula3 as $key => $value) {

                     if ($value['avaliacao']=='av1') {
                       $nota_av_1 =$value['nota'];
                     }

                     if ($value['avaliacao']=='av2') {
                       $nota_av_2 =$value['nota'];
                     }

                     if ($value['avaliacao']=='av3') {
                       $nota_av_3 =$value['nota'];
                     }


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
                      //$nota_tri_3=calculos_media_notas($nota_tri_3,$nota_rp_3,$nota_av3_3);
                   

                  echo "AV1: $nota_av_1 <br> AV2:$nota_av_2 <br> AV3: $nota_av_3 ";
                  ?>
               </td>
               <td>
                 <?php 
                  $total=($nota_tri_1+$nota_tri_2+$nota_tri_3)/3;
                  $total=number_format($total, 1, '.','') ;

                  if ($total <5 ) {
                    $resultado_final=false;
                  //buscar concelho
                            $res_conselho=buscar_aprovar_concelho($conexao,$idescola,$idturma,$iddisciplina,$idaluno);
                            $conta_aprovado=count($res_conselho);
                            
                             if ($conta_aprovado>0 ) {
                                $media_conselho=5.0;
                                $resultado_conselho=true;

                                echo "<b>".number_format($media_conselho, 1, '.', ',')."</b>";

                                $aprovacao_conselho=true;
                            }else{
                                $resultado_conselho=false;

                                echo number_format($total, 1, '.', ',');
                            }

                  //buscar concelho
                  }else{

                    echo"".number_format($total, 1, '.','') ;
                  }


                  // }
  
                  ?>
               </td>
              
               </tr>
              
          
<?php
$linha++;
}
?>
    </tbody>
  </table>
  </div>
</div>



<?php 
//$resultado_final=true;

}
?>