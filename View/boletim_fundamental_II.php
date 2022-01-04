<?php 
function boletim_fund2($conexao,$idescola,$idturma,$idserie,$idaluno,$numero,$nome_aluno,$nome_escola,$nome_turma,$ano_letivo){
  ?>
 

          

            <table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 width=577
            style='width:432.85pt;border-collapse:collapse;border:none;mso-border-alt:
            solid windowtext .5pt;mso-yfti-tbllook:1184;mso-padding-alt:0cm 3.5pt 0cm 3.5pt;
            mso-border-insideh:.5pt solid windowtext;mso-border-insidev:.5pt solid windowtext'>
            <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:45.75pt'>
              <td width=71 nowrap valign=bottom style='width:53.6pt;border:solid windowtext 1.0pt;
              mso-border-alt:solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:45.75pt'>
              <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'>


                <![if !vml]><span style='mso-ignore:vglayout;
                position:absolute;z-index:251658240;margin-left:13px;margin-top:-60px;
                width:44px;height:58px'><img width=44 height=58
                src="boletim_fundamental_II_arquivos/image002.png" v:shapes="Imagem_x0020_3"></span><span
                  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
                  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
                  mso-fareast-language:PT-BR'><o:p></o:p></span></p>
                </td>
                <td width=506 colspan=6 style='width:379.25pt;border:solid windowtext 1.0pt;
                border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
                solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:45.75pt'>
                <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
                line-height:normal'><b><span style='font-size:12.0pt;font-family:"Arial Black",sans-serif;
                mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
                color:black;mso-fareast-language:PT-BR'>Acompanhamento do Rendimento do Aluno
                / <?php echo $ano_letivo; ?></span></b><span style='mso-ascii-font-family:Calibri;mso-fareast-font-family:
                "Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
                color:black;mso-fareast-language:PT-BR'><o:p></o:p></span></p>
              </td>
            </tr>
            <tr style='mso-yfti-irow:1;height:15.0pt'>
              <td width=347 nowrap colspan=6 style='width:260.6pt;border:solid windowtext 1.0pt;
              border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
              padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
              <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
                style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
                mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
                mso-fareast-language:PT-BR'>ESCOLA MUNICIPAL: <?php echo $nome_escola; ?> <o:p></o:p></span></p>
              </td>
              <td width=230 colspan=1 style='width:162.25pt;border-top:none;border-left:
              none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
              mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
              mso-border-alt:solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
              <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
                style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
                mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
                mso-fareast-language:PT-BR'>INEP:<o:p></o:p></span></p>
              </td>
            </tr>
            <tr style='mso-yfti-irow:2;height:15.0pt'>
              <td width=577 nowrap colspan=7 style='width:402.85pt;border:solid windowtext 1.0pt;
              border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
              padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
              <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
                style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
                mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
                mso-fareast-language:PT-BR'>ALUNO: <?php echo $nome_aluno; ?><o:p></o:p></span></p>
              </td>
            </tr>
            <tr style='mso-yfti-irow:3;height:15.75pt'>
              <td width=577 nowrap colspan=7 valign=bottom style='width:402.85pt;
              border:solid windowtext 1.0pt;border-top:none;mso-border-top-alt:solid windowtext .5pt;
              mso-border-alt:solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
              <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
                style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
                mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
                mso-fareast-language:PT-BR'>TURMA: <?php echo $nome_turma; ?><o:p></o:p></span></p>
              </td>
            </tr>
            <tr style='mso-yfti-irow:4;height:17.25pt;mso-row-margin-right:.75pt'>
              <td width=175 nowrap colspan=2 style='width:130.95pt;border:solid windowtext 1.0pt;
              border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
              padding:0cm 3.5pt 0cm 3.5pt;height:17.25pt'>
              <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
                style='font-size:10.0pt;mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:
                Calibri;mso-bidi-theme-font:minor-latin;color:black;mso-fareast-language:
                PT-BR'>COMPONENTE CURRICULAR</span></b><b><span style='mso-fareast-font-family:
                "Times New Roman";mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin;
                color:black;mso-fareast-language:PT-BR'><o:p></o:p></span></b></p>
              </td>
              <td width=44 nowrap style='width:43.0pt;border-top:none;border-left:none;
              border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
              mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
              mso-border-alt:solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:17.25pt'>
              <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
              line-height:normal'><span style='font-family:"Arabic Typesetting";mso-fareast-font-family:
              "Times New Roman";color:black;mso-fareast-language:PT-BR'>I TRIM.<o:p></o:p></span></p>
            </td>
            <td width=48 nowrap style='width:46.2pt;border-top:none;border-left:none;
            border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
            mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
            mso-border-alt:solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:17.25pt'>
            <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
            line-height:normal'><span style='font-family:"Arabic Typesetting";mso-fareast-font-family:
            "Times New Roman";color:black;mso-fareast-language:PT-BR'>II TRIM.<o:p></o:p></span></p>
          </td>
          <td width=53 nowrap style='width:49.4pt;border-top:none;border-left:none;
          border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
          mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
          mso-border-alt:solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:17.25pt'>
          <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
          line-height:normal'><span style='font-family:"Arabic Typesetting";mso-fareast-font-family:
          "Times New Roman";color:black;mso-fareast-language:PT-BR'>III TRIM.<o:p></o:p></span></p>
        </td>
        <td width=28 nowrap style='width:21.05pt;border-top:none;border-left:none;
        border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
        mso-border-alt:solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:17.25pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
        line-height:normal'><span style='font-family:"Arabic Typesetting";mso-fareast-font-family:
        "Times New Roman";color:black;mso-fareast-language:PT-BR'>NF<o:p> </o:p></span></p>
      </td>
      <td width=229 nowrap valign=top style='width:171.5pt;border-top:none;
      border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
      mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
      mso-border-alt:solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:17.25pt'>
      <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
      line-height:normal'><b><span style='font-size:9.0pt;mso-ascii-font-family:
      Calibri;mso-fareast-font-family:"Times New Roman";mso-hansi-font-family:Calibri;
      mso-bidi-font-family:Calibri;color:black;mso-fareast-language:PT-BR'>PARECER DESCRITIVO
      <o:p></o:p></span></b></p>
    </td>


  </tr>



  <?php 
  $res_disc=listar_disciplina_para_boletim($conexao,$idaluno);
  $conta_parecer=0;
  $linha=0;
  $resultado_final=true;
  $resultado_conselho=false;

  foreach ($res_disc as $key => $value) {
    $iddisciplina=$value['iddisciplina'];
    $nome_disciplina=$value['nome_disciplina'];

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
          SELECT * FROM nota WHERE
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

       //  if ($nota_tri_1<5 && $nota_rp_1!='' && $nota_rp_1>$nota_av3_1) {
       //   $nota_tri_1=($nota_tri_1-$nota_av3_1)+$nota_rp_1;
       // }
      $nota_tri_1=calculos_media_notas($nota_tri_1,$nota_rp_1,$nota_av3_1);

       echo "$nota_tri_1";
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

      $result_nota_aula2=$conexao->query("
        SELECT * FROM nota WHERE
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

     //  if ($nota_tri_2<5 && $nota_rp_2!='' && $nota_rp_2>$nota_av3_2) {
     //   $nota_tri_2=($nota_tri_2-$nota_av3_2)+$nota_rp_2;
     // }
      $nota_tri_2=calculos_media_notas($nota_tri_2,$nota_rp_2,$nota_av3_2);

     echo "$nota_tri_2";
     ?>

   </o:p></span></p>
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
     SELECT * FROM nota WHERE
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

  //  if ($nota_tri_3<5 && $nota_rp_3!='' && $nota_rp_3>$nota_av3_3) {
  //   $nota_tri_3=($nota_tri_3-$nota_av3_3)+$nota_rp_3;
  // }
      $nota_tri_3=calculos_media_notas($nota_tri_3,$nota_rp_3,$nota_av3_3);
  

  echo "$nota_tri_3";
  ?>



 </o:p></span></p>
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

// if (isset($_GET['teste_boletim'])) {
//   // code...
// echo"( $resultado_final )".number_format($total, 1, '.','') ; 
// }else{
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

?></span></p>
</td>
<?php
if ($conta_parecer==0 && $linha==0) {
 ?>


 <td width=150 nowrap rowspan=3 valign=top style='width:171.5pt;border-top:
 none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
 mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
 mso-border-alt:solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt;'>
 <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:9.0pt;mso-ascii-font-family:Calibri;mso-fareast-font-family:
  "Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'>I TRIMESTRE: <?php

        // $result_parecer_tri1=$conexao->query("
        //   SELECT * FROM nota WHERE
        //   escola_id=$idescola and
        //   turma_id=$idturma and
        
        //   periodo_id=1 and aluno_id=$idaluno  group by parecer_descritivo");

// avaliacao,periodo_id 

        $parecer_tri_1="";
      
        // foreach ($result_parecer_tri1 as $key => $value) {
        //   $parecer_tri_1.=$value['parecer_descritivo'];
        // }
     // echo "$parecer_tri_1";

  ?><o:p></o:p></span></p>
</td> 
<?php 
$conta_parecer++;
}else if ($conta_parecer==1 && $linha==3) {
 ?>


 <td width=150 nowrap rowspan=3 valign=top style='width:171.5pt;border-top:
 none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
 mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
 mso-border-alt:solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt;'>
 <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:9.0pt;mso-ascii-font-family:Calibri;mso-fareast-font-family:
  "Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'>II TRIMESTRE:  <o:p></o:p></span></p>
</td> 
<?php 
$conta_parecer++;

}else if ($conta_parecer==2  && $linha==6) {
 ?>


 <td width=150 nowrap rowspan=5 valign=top style='width:171.5pt;border-top:
 none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
 mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
 mso-border-alt:solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt;'>
 <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:9.0pt;mso-ascii-font-family:Calibri;mso-fareast-font-family:
  "Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'>III TRIMESTRE: <o:p></o:p></span></p>
</td> 
<?php 
$conta_parecer++;
}
?>




<?php
$linha++;
}
?>

</tr>



<tr style='mso-yfti-irow:14;height:15.75pt;mso-row-margin-right:.75pt'>
  <td width=175 nowrap colspan=2 style='width:130.95pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
    style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
    mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
    mso-fareast-language:PT-BR'>Total de Faltas<o:p></o:p></span></b></p>
  </td>
  <td width=44 nowrap style='width:33.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:#D9D9D9;mso-background-themecolor:
  background1;mso-background-themeshade:217;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='mso-ascii-font-family:Calibri;mso-fareast-font-family:
  "Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p>

<?php
// faltas trimestre 1
$res_fre_t1=$conexao->query("
SELECT * FROM frequencia WHERE
escola_id=$idescola and
turma_id=$idturma and
presenca=0 and data_frequencia BETWEEN '2021-05-03' and '2021-07-09' and aluno_id=$idaluno  group by data_frequencia");
// disciplina_id=$iddisciplina and 
$quantidade_falta1=0;
foreach ($res_fre_t1 as $key => $value) {
  $quantidade_falta1++;
}

//echo "$quantidade_falta1";
?>
</o:p></span></p>
</td>
<td width=48 nowrap style='width:36.2pt;border-top:none;border-left:none;
border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
mso-border-alt:solid windowtext .5pt;background:#D9D9D9;mso-background-themecolor:
background1;mso-background-themeshade:217;padding:0cm 3.5pt 0cm 3.5pt;
height:15.75pt'>
<p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
line-height:normal'><span style='mso-ascii-font-family:Calibri;mso-fareast-font-family:
"Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
</td>
<td width=53 nowrap style='width:39.4pt;border-top:none;border-left:none;
border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
mso-border-alt:solid windowtext .5pt;background:#D9D9D9;mso-background-themecolor:
background1;mso-background-themeshade:217;padding:0cm 3.5pt 0cm 3.5pt;
height:15.75pt'>
<p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
line-height:normal'><span style='mso-ascii-font-family:Calibri;mso-fareast-font-family:
"Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
</td>
<td width=28 nowrap style='width:21.05pt;border-top:none;border-left:none;
border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
mso-border-alt:solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
<p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
line-height:normal'><span style='mso-ascii-font-family:Calibri;mso-fareast-font-family:
"Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
</td>
  <!--td style='mso-cell-special:placeholder;border:none;border-bottom:solid windowtext 1.0pt'
    width=1><p class='MsoNormal'>&nbsp;</td-->
    </tr>



    <tr style='mso-yfti-irow:15;mso-yfti-lastrow:yes;height:15.75pt'>
      <td width=347 nowrap colspan=5 style='width:260.6pt;border:solid windowtext 1.0pt;
      border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
      padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
      <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
        style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
        mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
        mso-fareast-language:PT-BR'>Mínimo para aprovação: <b>5,0</b><span
        style='mso-spacerun:yes'> </span><o:p></o:p></span></p>
      </td>
      <td width=230 colspan=1 style='width:172.25pt;border-top:none;border-left:
      none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
      mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
      mso-border-alt:solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
      <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
        style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
        mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;

        mso-fareast-language:PT-BR'>Resultado Final:<o:p><?php 
        
        if ($resultado_conselho==true) {
          echo " <b>Apc</b>";

        }elseif ($resultado_final==false) {
          echo " <b>Rep</b>";
        }else{
          echo " <b>Apr</b>";

        }
      ?></o:p></span></p>
      </td>
    </tr>
   
     <tr height=0>
      <td width=71 style='border:none'></td>
      <td width=103 style='border:none'></td>
      <td width=44 style='border:none'></td>
      <td width=48 style='border:none'></td>
      <td width=53 style='border:none'></td>
      <td width=28 style='border:none'></td>
      <td width=229 style='border:none'></td>
      <td width=1 style='border:none'></td>
    </tr>
    
    </table>


<?php 
//$resultado_final=true;

}
?>