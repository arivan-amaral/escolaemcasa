<?php 
function boletim_fund2_novo($conexao,$idescola,$idturma,$idserie,$idaluno,$numero,$nome_aluno,$nome_escola,$nome_turma,$ano_letivo){

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
 

          

            <table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 width=577
            style='width:432.85pt;border-collapse:collapse;border:none;mso-border-alt:
            solid windowtext .5pt;mso-yfti-tbllook:1184;mso-padding-alt:0cm 3.5pt 0cm 3.5pt;
            mso-border-insideh:.5pt solid windowtext;mso-border-insidev:.5pt solid windowtext'>
            <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:45.75pt'>
       
                 <tr style='mso-yfti-irow:15;mso-yfti-lastrow:yes;height:15.75pt'>
                   <td  nowrap colspan=10 style='width:260.6pt;border:solid windowtext 1.0pt;
                   border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
                   padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
                      ESCOLA: <?php echo "$nome_escola"; ?>
                   </td>
              
                 </tr>
                 <tr style='mso-yfti-irow:15;mso-yfti-lastrow:yes;height:15.75pt'>
                   <td  nowrap colspan=10 style='width:260.6pt;border:solid windowtext 1.0pt;
                   border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
                   padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
                      ALUNO: <?php echo "$nome_aluno"; ?>
                   </td>
              
                 </tr>
                 <tr style='mso-yfti-irow:15;mso-yfti-lastrow:yes;height:15.75pt'>
                   <td  nowrap colspan=10 style='width:260.6pt;border:solid windowtext 1.0pt;
                   border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
                   padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
                      TURMA: <?php echo "$nome_turma"; ?>
                   </td>
              
                 </tr>

                 <tr style='mso-yfti-irow:15;mso-yfti-lastrow:yes;height:15.75pt'>
                   
                   <td  nowrap colspan=2  style='width:260.6pt;border:solid windowtext 1.0pt;
                   border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
                   padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
                     COMPONENTE CURRICULAR
                   </td>                   
                   <td  nowrap   style='width:260.6pt;border:solid windowtext 1.0pt;
                   border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
                   padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
                    I TRIMESTRE
                   </td>                    

                   <td  nowrap  style='width:260.6pt;border:solid windowtext 1.0pt;
                   border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
                   padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
                    FALTAS
                   </td>                   
                   <td  nowrap  style='width:260.6pt;border:solid windowtext 1.0pt;
                   border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
                   padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
                 II TRIMESTRE

                   </td>                      

                   <td  nowrap  style='width:260.6pt;border:solid windowtext 1.0pt;
                   border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
                   padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
                    FALTAS
                   </td> 

                    <td  nowrap  style='width:260.6pt;border:solid windowtext 1.0pt;
                   border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
                   padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
                 III TRIMESTRE

                   </td>
                   <td  nowrap  style='width:260.6pt;border:solid windowtext 1.0pt;
                   border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
                   padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
                    FALTAS
                   </td> 

                   <td  nowrap  style='width:260.6pt;border:solid windowtext 1.0pt;
                   border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
                   padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
                    MF
                   </td>                    

                   <td  nowrap colspan=10 ne;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
                   padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
                    TOTAL DE FALTAS
                   </td> 
              
                 </tr>


  <?php 
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

    ?>
    <tr style='mso-yfti-irow:5;height:15.0pt;mso-row-margin-right:.75pt'>
      <td width=175 nowrap colspan=2 style='width:130.95pt;border:solid windowtext 1.0pt;
      border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
      padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
      <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
        style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
        mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
        mso-fareast-language:PT-BR'>
        
        <?php echo $nome_disciplina; ?>

        <o:p></o:p></span></p>
      </td>
      <td width=44 nowrap style='width:33.0pt;border-top:none;border-left:none;
      border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
      mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
      mso-border-alt:solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
      <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
      line-height:normal'><span style='mso-ascii-font-family:Calibri;mso-fareast-font-family:
      "Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
      color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p> 


        <?php

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
      echo number_format($nota_tri_1, 1, '.', ',');

       ?>
     </o:p></span></p>
   </td>

   <td width=48 nowrap style='width:36.2pt;border-top:none;border-left:none;
   border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
   mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
   mso-border-alt:solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
   <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
   line-height:normal'><span style='mso-ascii-font-family:Calibri;mso-fareast-font-family:
   "Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
   color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p>
    <?php 

    $res_fre1=$conexao->query("
    SELECT COUNT(*) as 'quantidade' FROM frequencia WHERE
    escola_id=$idescola and
    turma_id=$idturma and
    disciplina_id=$iddisciplina and
    presenca=0  
   and data_frequencia BETWEEN '$data_inicio_trimestre1' and '$data_fim_trimestre1' and aluno_id=$idaluno ");
   

    $quantidade1=0;
    foreach ($res_fre1 as $key => $value) {
      $quantidade1=$value['quantidade'];
    }

    echo "$quantidade1";


     ?>
  </o:p>
</span>
</p>
</td>




   <td width=48 nowrap style='width:36.2pt;border-top:none;border-left:none;
   border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
   mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
   mso-border-alt:solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
   <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
   line-height:normal'><span style='mso-ascii-font-family:Calibri;mso-fareast-font-family:
   "Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
   color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p>
      <?php

      $result_nota_aula2=$conexao->query("
        SELECT avaliacao,periodo_id,nota FROM nota_parecer WHERE
        escola_id=$idescola and
        turma_id=$idturma and
        ano_nota=$ano_letivo and
        disciplina_id=$iddisciplina and 
        periodo_id=2 and aluno_id=$idaluno  group by avaliacao,periodo_id,nota ");


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

 
      $nota_tri_2=calculos_media_notas($nota_tri_2,$nota_rp_2,$nota_av3_2);
 
          echo number_format($nota_tri_2, 1, '.', ',');
 
     ?>

   </o:p></span></p>
 </td>



    <td width=48 nowrap style='width:36.2pt;border-top:none;border-left:none;
   border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
   mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
   mso-border-alt:solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
   <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
   line-height:normal'><span style='mso-ascii-font-family:Calibri;mso-fareast-font-family:
   "Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
   color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p>
    <?php 

     $res_fre2=$conexao->query("
 SELECT COUNT(*) as 'quantidade' FROM frequencia WHERE
 escola_id=$idescola and
 turma_id=$idturma and
 disciplina_id=$iddisciplina and
 presenca=0 and data_frequencia BETWEEN '$data_inicio_trimestre2' and '$data_fim_trimestre2' and aluno_id=$idaluno ");
 

 $quantidade2=0;
 foreach ($res_fre2 as $key => $value) {
   $quantidade2=$value['quantidade'];
 }

 echo "$quantidade2";


  ?>
  </o:p>
</span>
</p>
</td>




 <td width=53 nowrap style='width:39.4pt;border-top:none;border-left:none;
 border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
 mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
 mso-border-alt:solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
 <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
 line-height:normal'><span style='mso-ascii-font-family:Calibri;mso-fareast-font-family:
 "Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
 color:black;mso-fareast-language:PT-BR'><o:p>

   <?php

   $result_nota_aula3=$conexao->query("
     SELECT avaliacao,periodo_id,nota FROM nota_parecer WHERE
     escola_id=$idescola and
     turma_id=$idturma and
     ano_nota=$ano_letivo and
     disciplina_id=$iddisciplina and 
     periodo_id=3 and aluno_id=$idaluno  group by avaliacao,periodo_id,nota ");


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
 
      $nota_tri_3=calculos_media_notas($nota_tri_3,$nota_rp_3,$nota_av3_3);
  

          echo number_format($nota_tri_3, 1, '.', ',');
 
  ?>



 </o:p></span></p>
</td>




   <td width=48 nowrap style='width:36.2pt;border-top:none;border-left:none;
   border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
   mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
   mso-border-alt:solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
   <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
   line-height:normal'><span style='mso-ascii-font-family:Calibri;mso-fareast-font-family:
   "Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
   color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p>
      <?php 

       $res_fre3=$conexao->query("
   SELECT COUNT(*) as 'quantidade' FROM frequencia WHERE
   escola_id=$idescola and
   turma_id=$idturma and
   disciplina_id=$iddisciplina and
   presenca=0 and data_frequencia BETWEEN '$data_inicio_trimestre3' and '$data_fim_trimestre3' and aluno_id=$idaluno ");
   

   $quantidade3=0;
   foreach ($res_fre3 as $key => $value) {
     $quantidade3=$value['quantidade'];
   }

   echo "$quantidade3";


    ?>
  </o:p>
</span>
</p>
</td>


<td width=28 nowrap style='width:21.05pt;border-top:none;border-left:none;
border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
mso-border-alt:solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
<p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
line-height:normal'><span style='mso-ascii-font-family:Calibri;mso-fareast-font-family:
"Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
color:black;mso-fareast-language:PT-BR'>
<?php 

$total=($nota_tri_1+$nota_tri_2+$nota_tri_3)/3;
$total=number_format($total, 1, '.','') ;

 
if ($total <5 ) {
  $resultado_final=false;
//buscar concelho
          $res_conselho=buscar_aprovar_concelho($conexao,$idescola,$idturma,$iddisciplina,$idaluno,$ano_letivo);
          $conta_aprovado=count($res_conselho);
          
           if ($conta_aprovado>0 ) {
              $media_conselho=5.0;
              $resultado_conselho=true;
              $conta_conselho++;

              echo "<b>".number_format($media_conselho, 1, '.', ',')."</b>";

              $aprovacao_conselho=true;
          }else{
              $resultado_conselho=false;

              echo number_format($total, 1, '.', ',');
          }

//buscar concelho
}else{
              $conta_apr++;


  echo"".number_format($total, 1, '.','') ;
}


// }

?></span></p>
</td>



   <td width=48 nowrap style='width:36.2pt;border-top:none;border-left:none;
   border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
   mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
   mso-border-alt:solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
   <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
   line-height:normal'><span style='mso-ascii-font-family:Calibri;mso-fareast-font-family:
   "Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
   color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p>
    <?php 
      echo($quantidade1+$quantidade2+$quantidade3);
     ?>
  </o:p>
</span>
</p>
</td>
<?php
if ($conta_parecer==0 && $linha==0) {
 ?>




<?php
$linha++;
}



}
?>

</tr>






    <tr style='mso-yfti-irow:15;mso-yfti-lastrow:yes;height:15.75pt'>
      <td  nowrap colspan=10 style='width:260.6pt;border:solid windowtext 1.0pt;
      border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
      padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
 <center>
 
        Resultado Final:

 

        <?php 
             $conta_total=($conta_conselho+$conta_apr);
             if ($conta_dis==$conta_total && $conta_conselho>0) {
               echo " <b>Aprovado(a) pelo concelho</b>";

             }elseif ($conta_apr==$conta_dis) {
               echo " <b>Aprovado(a)</b>";
             }else{
               echo " <b>Reprovado(a)</b>";

             }
 
           ?>
   
 </center>
      </td>
 
    </tr>
   
  
    
    </table>


<?php 
 

}
?>