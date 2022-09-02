<?php 
 function boletim_maternal_1_2($conexao,$idescola,$idturma,$idserie,$idaluno,$numero,$nome_aluno,$nome_escola,$nome_turma,$nome_professor,$ano_letivo){
?>


<div class=WordSection1>
  <table  class="tabela_serie123">
<!-- 
<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=996
 style='width:746.8pt;border-collapse:collapse;mso-yfti-tbllook:1184;
 mso-padding-alt:0cm 3.5pt 0cm 3.5pt'> -->
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:26.55pt'>
  <td width=84 nowrap rowspan=7 style='width:62.7pt;border:solid windowtext 1.0pt;
  border-bottom:none;mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:
  solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;padding:
  0cm 3.5pt 0cm 3.5pt;height:26.55pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='mso-no-proof:yes'>

    <![if !vml]><img width=62 height=74
  src="imagens/logo.png" v:shapes="Imagem_x0020_2"> </span><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;'><o:p></o:p></span></p>
  </td>
  <td width=912 colspan=10 valign=bottom style='width:684.1pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:26.55pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:16.0pt;mso-ascii-font-family:
  Calibri;mso-fareast-font-family:"Times New Roman";mso-hansi-font-family:Calibri;
  mso-bidi-font-family:Calibri;color:black;mso-fareast-language:PT-BR'>PREFEITURA
  DE LUÍS EDUARDO MAGALHÃES</span></b><span style='mso-ascii-font-family:Calibri;
  mso-fareast-font-family:"Times New Roman";mso-hansi-font-family:Calibri;
  mso-bidi-font-family:Calibri;color:black;mso-fareast-language:PT-BR'><br>
  SECRETARIA MUNICIPAL DE EDUCAÇÃO<br>
  </span><b><span style='font-size:16.0pt;mso-ascii-font-family:Calibri;
  mso-fareast-font-family:"Times New Roman";mso-hansi-font-family:Calibri;
  mso-bidi-font-family:Calibri;color:black;mso-fareast-language:PT-BR'>BOLETIM
  DE DESEMPENHO</span></b><span style='mso-ascii-font-family:Calibri;
  mso-fareast-font-family:"Times New Roman";mso-hansi-font-family:Calibri;
  mso-bidi-font-family:Calibri;color:black;mso-fareast-language:PT-BR'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1;height:8.75pt'>
  <td width=912 colspan=10 valign=bottom style='width:684.1pt;border:none;
  border-right:solid windowtext 1.0pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:8.75pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:9.0pt;mso-ascii-font-family:Calibri;mso-fareast-font-family:
  "Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'>UNIDADE ESCOLAR: <?php echo $nome_escola; ?><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2;height:8.75pt'>
  <td width=912 colspan=10 valign=bottom style='width:684.1pt;border-top:solid windowtext 1.0pt;
  border-left:none;border-bottom:none;border-right:solid windowtext 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:8.75pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:9.0pt;mso-ascii-font-family:Calibri;mso-fareast-font-family:
  "Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'>ENDEREÇO:<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3;height:8.75pt'>
  <td width=300 valign=bottom style='width:225.15pt;border-top:solid windowtext 1.0pt;
  border-left:none;border-bottom:none;border-right:solid windowtext 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:8.75pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:9.0pt;mso-ascii-font-family:Calibri;mso-fareast-font-family:
  "Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'>PERÍODO LETIVO:<o:p></o:p></span></p>
  </td>
  <td width=300 colspan=5 valign=bottom style='width:225.15pt;border-top:solid windowtext 1.0pt;
  border-left:none;border-bottom:none;border-right:solid windowtext 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:8.75pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:9.0pt;mso-ascii-font-family:Calibri;mso-fareast-font-family:
  "Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'><?php echo $ano_letivo; ?><o:p></o:p></span></p>
  </td>
  <td width=312 colspan=4 valign=bottom style='width:233.8pt;border-top:solid windowtext 1.0pt;
  border-left:none;border-bottom:none;border-right:solid windowtext 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:8.75pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:9.0pt;mso-ascii-font-family:Calibri;mso-fareast-font-family:
  "Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'><?php echo $nome_turma; ?><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4;height:8.75pt'>
  <td width=912 colspan=10 valign=bottom style='width:684.1pt;border-top:solid windowtext 1.0pt;
  border-left:none;border-bottom:none;border-right:solid windowtext 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:8.75pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:9.0pt;mso-ascii-font-family:Calibri;mso-fareast-font-family:
  "Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'>REGENTE:<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5;height:8.75pt'>
  <td width=912 colspan=10 valign=bottom style='width:684.1pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:8.75pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:9.0pt;mso-ascii-font-family:Calibri;mso-fareast-font-family:
  "Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'>PROFESSOR (A):<o:p>

    <?php
        echo $nome_professor;
     ?>
  </o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6;height:8.75pt'>
  <td width=912 colspan=10 valign=bottom style='width:684.1pt;border:none;
  border-right:solid windowtext 1.0pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:8.75pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:9.0pt;mso-ascii-font-family:Calibri;mso-fareast-font-family:
  "Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'>ALUNO: <?php echo $nome_aluno; ?><o:p></o:p></span></p>
  </td>
 </tr>



<!-- *************************************************************************************  -->


 <tr style='mso-yfti-irow:7;height:15.75pt'>
  <td width=394 nowrap colspan=3 rowspan=2 style='width:295.75pt;border:solid windowtext 1.0pt;
  border-bottom:solid black 1.0pt;mso-border-top-alt:windowtext .5pt;
  mso-border-left-alt:windowtext 1.0pt;mso-border-bottom-alt:black 1.0pt;
  mso-border-right-alt:windowtext .5pt;mso-border-style-alt:solid;background:
  #D9D9D9;padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:9.0pt;font-family:"Arial",sans-serif;
  mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
  PT-BR'>I. O EU, O OUTRO E NÓS</span></b><b><span style='font-size:10.0pt;
  font-family:"Arial",sans-serif;mso-fareast-font-family:"Times New Roman";
  color:black;mso-fareast-language:PT-BR'><o:p></o:p></span></b></p>
  </td>
  <td width=71 nowrap colspan=3 style='width:53.4pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
  PT-BR'>TRIMESTRE<o:p></o:p></span></b></p>
  </td>
  <td width=434 colspan=2 rowspan=2 style='width:325.55pt;border-top:solid windowtext 1.0pt;
  border-left:none;border-bottom:none;border-right:solid windowtext 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  background:#D9D9D9;padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:9.0pt;font-family:"Arial",sans-serif;
  mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
  PT-BR'>IV- ESCUTA, FALA, PENSAMENTO E IMAGINAÇÃO</span></b><b><span
  style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
  "Times New Roman";color:black;mso-fareast-language:PT-BR'><o:p></o:p></span></b></p>
  </td>
  <td width=96 colspan=3 style='width:72.1pt;border-top:solid windowtext 1.0pt;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid black 1.0pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
  PT-BR'>TRIMESTRE</span></b><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
  mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
  PT-BR'><o:p></o:p></span></b></p>
  </td>
 </tr>


 <tr style='mso-yfti-irow:8;height:15.75pt'>
  <td width=24 nowrap style='width:17.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
  mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
  PT-BR'>1º<o:p></o:p></span></b></p>
  </td>
  <td width=24 nowrap style='width:17.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
  mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
  PT-BR'>2º<o:p></o:p></span></b></p>
  </td>
  <td width=24 nowrap style='width:17.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
  mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
  PT-BR'>3º<o:p></o:p></span></b></p>
  </td>
  <td width=32 style='width:24.0pt;border:none;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-right-alt:solid windowtext .5pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.75pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
  style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
  "Times New Roman";color:black;mso-fareast-language:PT-BR'>1º</span></b><span
  style='font-size:10.0pt;font-family:"Times New Roman",serif;mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:PT-BR'><o:p></o:p></span></p>
  </td>
  <td width=32 style='width:24.05pt;border-top:solid windowtext 1.0pt;
  border-left:none;border-bottom:none;border-right:solid windowtext 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  background:white;padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
  style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
  "Times New Roman";color:black;mso-fareast-language:PT-BR'>2º</span></b><span
  style='font-size:10.0pt;font-family:"Times New Roman",serif;mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:PT-BR'><o:p></o:p></span></p>
  </td>
  <td width=32 style='width:24.05pt;border-top:solid windowtext 1.0pt;
  border-left:none;border-bottom:none;border-right:solid windowtext 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  background:white;padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
  style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
  "Times New Roman";color:black;mso-fareast-language:PT-BR'>3º</span></b><span
  style='font-size:10.0pt;font-family:"Times New Roman",serif;mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:PT-BR'><o:p></o:p></span></p>
  </td>
 </tr>




  <?php 
    $res_parec1=$conexao->query("SELECT parecer_disciplina.descricao,parecer_disciplina.id FROM parecer_disciplina WHERE serie_id =$idserie and disciplina_id=40  and parecer_disciplina.ano=$ano_letivo ");   
      $parece_o_eu=array();
      $parece_escuta_fala=array();

      $array_parece_o_eu=array();
      $array_parece_escuta_fala=array();

      $conta=0;

    $array_parece_o_eu=array();
    foreach ($res_parec1 as $key => $value) {
      $parecer_disciplina_id=$value['id'];
      $descricao=$value['descricao'];
      $parece_o_eu[$conta]=$descricao;

      $array_parece_o_eu[$conta]=$parecer_disciplina_id;
     
      $conta++;
    }

    $res_parec2=$conexao->query("SELECT parecer_disciplina.descricao,parecer_disciplina.id FROM
    parecer_disciplina WHERE serie_id =$idserie and disciplina_id=42  and parecer_disciplina.ano=$ano_letivo ");
    $conta2=0;
     // arivan 03 $parece_escuta_fala=array();
    // 
    foreach ($res_parec2 as $key => $value) {
      $parecer_disciplina_id=$value['id'];
      $descricao=$value['descricao']; 
      $parece_escuta_fala[$conta2]=$descricao;
      $array_parece_escuta_fala[$conta2]=$parecer_disciplina_id;
      $conta2++;
    }
    
    $maior=$conta2;
    if ($conta>$conta2) {
     $maior=$conta;
    }
    $conta_row=0;

    for ($i=0; $i < $maior ; $i++) {

      echo" <tr style='mso-yfti-irow:9;height:26.25pt'>";
      if ($i<$conta ) {
       
   ?>

        <td width=394 colspan=3 style='width:295.75pt;border:solid windowtext 1.0pt;
        border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
        mso-border-left-alt:solid windowtext 1.0pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
        height:26.25pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
        style='font-size:8.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
        "Times New Roman";color:black;mso-fareast-language:PT-BR'>
        <?php echo $parece_o_eu[$i]; ?>
        <o:p></o:p></span></p>
        </td>
        <td width=24 nowrap style='width:17.8pt;border-top:none;border-left:none;
        border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
        mso-border-alt:solid windowtext .5pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
        height:26.25pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
        line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
        mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
        PT-BR'><o:p>
   <?php
          $parecer_disciplina_id1=$array_parece_o_eu[$i];

            $result_nota_aula1=$conexao->query("
            SELECT * FROM nota_parecer WHERE
            escola_id=$idescola and
            turma_id=$idturma and
            ano_nota=$ano_letivo and
            avaliacao='av3' and periodo_id=1 and parecer_disciplina_id=$parecer_disciplina_id1 and aluno_id=$idaluno ");
            $nota_tri_1='';
            foreach ($result_nota_aula1 as $key => $value) {
            $nota_tri_1=$value['sigla'];
            }

            echo "$nota_tri_1";

            // 1=====
            ?>
        </o:p></span></b></p>
        </td>
        <td width=24 nowrap style='width:17.8pt;border-top:none;border-left:none;
        border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
        mso-border-alt:solid windowtext .5pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
        height:26.25pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
        line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
        mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
        PT-BR'>&nbsp;<o:p>

          <?php
                 $parecer_disciplina_id1=$array_parece_o_eu[$i];

                   $result_nota_aula2=$conexao->query("
                   SELECT * FROM nota_parecer WHERE
                   escola_id=$idescola and
                   turma_id=$idturma and
                   ano_nota=$ano_letivo and
                   avaliacao='av3' and periodo_id=2 and parecer_disciplina_id=$parecer_disciplina_id1 and aluno_id=$idaluno ");
                   $nota_tri_2='';
                   foreach ($result_nota_aula2 as $key => $value) {
                   $nota_tri_2=$value['sigla'];
                   }

                   echo "$nota_tri_2";

                   // 1=====
                   ?>

        </o:p></span></b></p>
        </td>
        <td width=24 nowrap style='width:17.8pt;border-top:none;border-left:none;
        border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
        mso-border-alt:solid windowtext .5pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
        height:26.25pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
        line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
        mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
        PT-BR'><o:p>
              <?php
                 $parecer_disciplina_id1=$array_parece_o_eu[$i];

                   $result_nota_aula3=$conexao->query("
                   SELECT * FROM nota_parecer WHERE
                   escola_id=$idescola and
                   turma_id=$idturma and
                   ano_nota=$ano_letivo and
                   avaliacao='av3' and periodo_id=3 and parecer_disciplina_id=$parecer_disciplina_id1 and aluno_id=$idaluno ");
                   $nota_tri_3='';
                   foreach ($result_nota_aula3 as $key => $value) {
                     $nota_tri_3=$value['sigla'];
                   }


                   echo "$nota_tri_3";

                   // 1=====
              ?>

        </o:p></span></b></p>
        </td>
    <?php 
      }else{
    ?>
       


 <td width=394 colspan=3 style='width:295.75pt;border:solid windowtext 1.0pt;
        border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
        mso-border-left-alt:solid windowtext 1.0pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
        height:26.25pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
        style='font-size:8.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
        "Times New Roman";color:black;mso-fareast-language:PT-BR'>
       
        <o:p></o:p></span></p>
        </td>
        <td width=24 nowrap style='width:17.8pt;border-top:none;border-left:none;
        border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
        mso-border-alt:solid windowtext .5pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
        height:26.25pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
        line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
        mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
        PT-BR'>&nbsp;<o:p></o:p></span></b></p>
        </td>
        <td width=24 nowrap style='width:17.8pt;border-top:none;border-left:none;
        border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
        mso-border-alt:solid windowtext .5pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
        height:26.25pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
        line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
        mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
        PT-BR'>&nbsp;<o:p></o:p></span></b></p>
        </td>
        <td width=24 nowrap style='width:17.8pt;border-top:none;border-left:none;
        border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
        mso-border-alt:solid windowtext .5pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
        height:26.25pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
        line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
        mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
        PT-BR'>&nbsp;<o:p></o:p></span></b></p>
        </td>




<?php 
      }

    if ($i<$conta2 ) {
  ?>

    <td width=434 colspan=2 rowspan="" style='width:325.55pt;border:solid windowtext 1.0pt;
    border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
    solid windowtext .5pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
    height:26.25pt'>
    <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
    style='font-size:8.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
    "Times New Roman";color:black;mso-fareast-language:PT-BR'><?php echo $parece_escuta_fala[$i]; ?><o:p></o:p></span></p>
    </td>
    <td width=32 style='width:24.0pt;border:solid windowtext 1.0pt;border-left:
    none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
    background:white;padding:0cm 3.5pt 0cm 3.5pt;height:26.25pt'>
    <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
    style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
    "Times New Roman";color:black;mso-fareast-language:PT-BR'><o:p>
      <b>
<?php 

 $parecer_disciplina_id2=$array_parece_escuta_fala[$i];

  $result_nota_aula1=$conexao->query("
  SELECT * FROM nota_parecer WHERE
  escola_id=$idescola and
  turma_id=$idturma and
  ano_nota=$ano_letivo and
  avaliacao='av3' and periodo_id=1 and parecer_disciplina_id=$parecer_disciplina_id2 and aluno_id=$idaluno ");
  $nota_tri_1='';
  foreach ($result_nota_aula1 as $key => $value) {
  $nota_tri_1=$value['sigla'];
  }

   echo " $nota_tri_1";
  // 2======
 ?>
   
</b>
 </o:p>
  </span></p>
    </td>
    <td width=32 style='width:24.05pt;border:solid windowtext 1.0pt;border-left:
    none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
    background:white;padding:0cm 3.5pt 0cm 3.5pt;height:26.25pt'>
    <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
    style='font-size:8.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
    "Times New Roman";color:black;mso-fareast-language:PT-BR'><o:p>

      <?php 

       $parecer_disciplina_id2=$array_parece_escuta_fala[$i];

        $result_nota_aula2=$conexao->query("
        SELECT * FROM nota_parecer WHERE
        escola_id=$idescola and
        turma_id=$idturma and
        ano_nota=$ano_letivo and
        avaliacao='av3' and periodo_id=2 and parecer_disciplina_id=$parecer_disciplina_id2 and aluno_id=$idaluno ");
        $nota_tri_2='';
        foreach ($result_nota_aula2 as $key => $value) {
        $nota_tri_2=$value['sigla'];
        }

         echo " $nota_tri_2";
        // 2======
       ?>

    </o:p></span></p>
    </td>



    <td width=32 style='width:24.05pt;border:solid windowtext 1.0pt;border-left:
    none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
    background:white;padding:0cm 3.5pt 0cm 3.5pt;height:26.25pt'>
    <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
    style='font-size:8.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
    "Times New Roman";color:black;mso-fareast-language:PT-BR'><o:p>
      
      <?php 
       $parecer_disciplina_id2=$array_parece_escuta_fala[$i];

        $result_nota_aula3=$conexao->query("
        SELECT * FROM nota_parecer WHERE
        escola_id=$idescola and
        turma_id=$idturma and
        ano_nota=$ano_letivo and
        avaliacao='av3' and periodo_id=3 and parecer_disciplina_id=$parecer_disciplina_id2 and aluno_id=$idaluno ");
        $nota_tri_3='';
        foreach ($result_nota_aula3 as $key => $value) {
        $nota_tri_3=$value['sigla'];
        }

         echo " $nota_tri_3";
        // 2======
      ?>


    </o:p></span></p>
    </td>
    <?php 
    }
   ?>
   </tr>

<?php 
}
?>


<!-- 2 ************************************************************************************* 2 -->


 <tr style='mso-yfti-irow:7;height:15.75pt'>
  <td width=394 nowrap colspan=3 rowspan=2 style='width:295.75pt;border:solid windowtext 1.0pt;
  border-bottom:solid black 1.0pt;mso-border-top-alt:windowtext .5pt;
  mso-border-left-alt:windowtext 1.0pt;mso-border-bottom-alt:black 1.0pt;
  mso-border-right-alt:windowtext .5pt;mso-border-style-alt:solid;background:
  #D9D9D9;padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:9.0pt;font-family:"Arial",sans-serif;
  mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
  PT-BR'>II-CORPO, GESTOS E MOVIMENTOS</span></b><b><span style='font-size:10.0pt;
  font-family:"Arial",sans-serif;mso-fareast-font-family:"Times New Roman";
  color:black;mso-fareast-language:PT-BR'><o:p></o:p></span></b></p>
  </td>
  <td width=71 nowrap colspan=3 style='width:53.4pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
  PT-BR'>TRIMESTRE<o:p></o:p></span></b></p>
  </td>
  <td width=434 colspan=2 rowspan=2 style='width:325.55pt;border-top:solid windowtext 1.0pt;
  border-left:none;border-bottom:none;border-right:solid windowtext 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  background:#D9D9D9;padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:9.0pt;font-family:"Arial",sans-serif;
  mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
  PT-BR'>V- ESPAÇO, TEMPOS, QUANTIDADES, RELAÇÕES E TRANSFORMAÇÕES</span></b><b><span
  style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
  "Times New Roman";color:black;mso-fareast-language:PT-BR'><o:p></o:p></span></b></p>
  </td>
  <td width=96 colspan=3 style='width:72.1pt;border-top:solid windowtext 1.0pt;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid black 1.0pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
  PT-BR'>TRIMESTRE</span></b><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
  mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
  PT-BR'><o:p></o:p></span></b></p>
  </td>
 </tr>


 <tr style='mso-yfti-irow:8;height:15.75pt'>
  <td width=24 nowrap style='width:17.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
  mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
  PT-BR'>1º<o:p></o:p></span></b></p>
  </td>
  <td width=24 nowrap style='width:17.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
  mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
  PT-BR'>2º<o:p></o:p></span></b></p>
  </td>
  <td width=24 nowrap style='width:17.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
  mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
  PT-BR'>3º<o:p></o:p></span></b></p>
  </td>
  <td width=32 style='width:24.0pt;border:none;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-right-alt:solid windowtext .5pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.75pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
  style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
  "Times New Roman";color:black;mso-fareast-language:PT-BR'>1º</span></b><span
  style='font-size:10.0pt;font-family:"Times New Roman",serif;mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:PT-BR'><o:p></o:p></span></p>
  </td>
  <td width=32 style='width:24.05pt;border-top:solid windowtext 1.0pt;
  border-left:none;border-bottom:none;border-right:solid windowtext 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  background:white;padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
  style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
  "Times New Roman";color:black;mso-fareast-language:PT-BR'>2º</span></b><span
  style='font-size:10.0pt;font-family:"Times New Roman",serif;mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:PT-BR'><o:p></o:p></span></p>
  </td>
  <td width=32 style='width:24.05pt;border-top:solid windowtext 1.0pt;
  border-left:none;border-bottom:none;border-right:solid windowtext 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  background:white;padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
  style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
  "Times New Roman";color:black;mso-fareast-language:PT-BR'>3º</span></b><span
  style='font-size:10.0pt;font-family:"Times New Roman",serif;mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:PT-BR'><o:p></o:p></span></p>
  </td>
 </tr>




  <?php 
    $res_parec1=$conexao->query("SELECT parecer_disciplina.descricao,parecer_disciplina.id FROM parecer_disciplina WHERE serie_id =$idserie and disciplina_id=41  and parecer_disciplina.ano=$ano_letivo ");   
      $parece_o_eu=array();
      $parece_escuta_fala=array();
      $conta=0;

    foreach ($res_parec1 as $key => $value) {
      $parecer_disciplina_id=$value['id'];
      $descricao=$value['descricao'];
      $parece_o_eu[$conta]=$descricao;
      $array_parece_o_eu[$conta]=$parecer_disciplina_id;
     
      $conta++;
    }

//arivan 01
    $res_parec3=$conexao->query("SELECT parecer_disciplina.descricao,
      parecer_disciplina.id FROM
    parecer_disciplina WHERE serie_id =$idserie and disciplina_id=44  and parecer_disciplina.ano=$ano_letivo ");
    $conta2=0;
      
      $parece_espaco_tempo=array();
      $parece_escuta_fala=array();

    foreach ($res_parec3 as $key => $value) {
      $parecer_disciplina_id=$value['id'];
      $descricao=$value['descricao']; 
      $parece_espaco_tempo[$conta2]=$parecer_disciplina_id;
      $parece_escuta_fala[$conta2]=$descricao;
      $conta2++;

     // echo "arivan é foda : $parecer_disciplina_id";
    }
    
    $maior=$conta2;
    if ($conta>$conta2) {
     $maior=$conta;
    }
    $conta_row=0;

    for ($i=0; $i < $maior ; $i++) {

      echo" <tr style='mso-yfti-irow:9;height:26.25pt'>";
      if ($i<$conta ) {
       
   ?>

        <td width=394 colspan=3 style='width:295.75pt;border:solid windowtext 1.0pt;
        border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
        mso-border-left-alt:solid windowtext 1.0pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
        height:26.25pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
        style='font-size:8.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
        "Times New Roman";color:black;mso-fareast-language:PT-BR'>
        <?php echo $parece_o_eu[$i]; ?>
        <o:p></o:p></span></p>
        </td>
        <td width=24 nowrap style='width:17.8pt;border-top:none;border-left:none;
        border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
        mso-border-alt:solid windowtext .5pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
        height:26.25pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
        line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
        mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
        PT-BR'>&nbsp;<o:p>

<?php 
 $parecer_disciplina_id1=$array_parece_o_eu[$i];
  $result_nota_aula1=$conexao->query("
  SELECT * FROM nota_parecer WHERE
  escola_id=$idescola and
  turma_id=$idturma and
  ano_nota=$ano_letivo and
  avaliacao='av3' and periodo_id=1 and parecer_disciplina_id=$parecer_disciplina_id1 and aluno_id=$idaluno ");
  $nota_tri_1='';
  foreach ($result_nota_aula1 as $key => $value) {
  $nota_tri_1=$value['sigla'];
  }
  echo " $nota_tri_1";

  // 3========
 ?>
        </o:p></span></b></p>
        </td>
        <td width=24 nowrap style='width:17.8pt;border-top:none;border-left:none;
        border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
        mso-border-alt:solid windowtext .5pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
        height:26.25pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
        line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
        mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
        PT-BR'><o:p>

          <?php 
           $parecer_disciplina_id1=$array_parece_o_eu[$i];

            $result_nota_aula2=$conexao->query("
            SELECT * FROM nota_parecer WHERE
            escola_id=$idescola and
            turma_id=$idturma and
            ano_nota=$ano_letivo and
            avaliacao='av3' and periodo_id=2 and parecer_disciplina_id=$parecer_disciplina_id1 and aluno_id=$idaluno ");
            $nota_tri_2='';
            foreach ($result_nota_aula2 as $key => $value) {
            $nota_tri_2=$value['sigla'];
            }
            echo " $nota_tri_2";

            // 3========
          ?>
        </o:p></span></b></p>
        </td>
        <td width=24 nowrap style='width:17.8pt;border-top:none;border-left:none;
        border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
        mso-border-alt:solid windowtext .5pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
        height:26.25pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
        line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
        mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
        PT-BR'><o:p>

          <?php 
           $parecer_disciplina_id1=$array_parece_o_eu[$i];

            $result_nota_aula3=$conexao->query("
            SELECT * FROM nota_parecer WHERE
            escola_id=$idescola and
            turma_id=$idturma and
            ano_nota=$ano_letivo and
            avaliacao='av3' and periodo_id=3 and parecer_disciplina_id=$parecer_disciplina_id1 and aluno_id=$idaluno ");
            $nota_tri_3='';
            foreach ($result_nota_aula3 as $key => $value) {
            $nota_tri_3=$value['sigla'];
            }
            echo "$nota_tri_3";

            // 3========
           ?>
        </o:p></span></b></p>
        </td>
    <?php 
      }else{
    ?>
       


 <td width=394 colspan=3 style='width:295.75pt;border:solid windowtext 1.0pt;
        border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
        mso-border-left-alt:solid windowtext 1.0pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
        height:26.25pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
        style='font-size:8.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
        "Times New Roman";color:black;mso-fareast-language:PT-BR'>
       
        <o:p></o:p></span></p>
        </td>
        <td width=24 nowrap style='width:17.8pt;border-top:none;border-left:none;
        border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
        mso-border-alt:solid windowtext .5pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
        height:26.25pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
        line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
        mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
        PT-BR'>&nbsp;<o:p></o:p></span></b></p>
        </td>
        <td width=24 nowrap style='width:17.8pt;border-top:none;border-left:none;
        border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
        mso-border-alt:solid windowtext .5pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
        height:26.25pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
        line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
        mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
        PT-BR'>&nbsp;<o:p></o:p></span></b></p>
        </td>
        <td width=24 nowrap style='width:17.8pt;border-top:none;border-left:none;
        border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
        mso-border-alt:solid windowtext .5pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
        height:26.25pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
        line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
        mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
        PT-BR'>&nbsp;<o:p></o:p></span></b></p>
        </td>




<?php 
      }

    if ($i<$conta2 ) {
  ?>
<!-- arivan 02 -->

    <td width=434 colspan=2 rowspan="" style='width:325.55pt;border:solid windowtext 1.0pt;
    border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
    solid windowtext .5pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
    height:26.25pt'>
    <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
    style='font-size:8.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
    "Times New Roman";color:black;mso-fareast-language:PT-BR'><?php echo $parece_escuta_fala[$i]; ?><o:p></o:p></span></p>
    </td>
    <td width=32 style='width:24.0pt;border:solid windowtext 1.0pt;border-left:
    none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
    background:white;padding:0cm 3.5pt 0cm 3.5pt;height:26.25pt'>
    <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
    style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
    "Times New Roman";color:black;mso-fareast-language:PT-BR'><o:p>
      
<?php 

 $parecer_disciplina_id2=$array_parece_escuta_fala[$i];

  $result_nota_aula1=$conexao->query("
  SELECT * FROM nota_parecer WHERE
  escola_id=$idescola and
  turma_id=$idturma and
  ano_nota=$ano_letivo and
  avaliacao='av3' and periodo_id=1 and parecer_disciplina_id=$parecer_disciplina_id2 and aluno_id=$idaluno ");
  $nota_tri_1='';
  foreach ($result_nota_aula1 as $key => $value) {
  $nota_tri_1=$value['sigla'];
  }

   echo "$nota_tri_1";
  // 4=========

 ?>

    </o:p></span></p>
    </td>
    <td width=32 style='width:24.05pt;border:solid windowtext 1.0pt;border-left:
    none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
    background:white;padding:0cm 3.5pt 0cm 3.5pt;height:26.25pt'>
    <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
    style='font-size:8.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
    "Times New Roman";color:black;mso-fareast-language:PT-BR'><o:p>

<?php 

 $parecer_disciplina_id2=$array_parece_escuta_fala[$i];

  $result_nota_aula2=$conexao->query("
  SELECT * FROM nota_parecer WHERE
  escola_id=$idescola and
  turma_id=$idturma and
  ano_nota=$ano_letivo and
  avaliacao='av3' and periodo_id=2 and parecer_disciplina_id=$parecer_disciplina_id2 and aluno_id=$idaluno ");
  $nota_tri_2='';
  foreach ($result_nota_aula2 as $key => $value) {
  $nota_tri_2=$value['sigla'];
  }

   echo "$nota_tri_2";
  // 4=========

 ?>
    </o:p></span></p>
    </td>
    <td width=32 style='width:24.05pt;border:solid windowtext 1.0pt;border-left:
    none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
    background:white;padding:0cm 3.5pt 0cm 3.5pt;height:26.25pt'>
    <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
    style='font-size:8.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
    "Times New Roman";color:black;mso-fareast-language:PT-BR'><o:p>

      <?php 
// arivan 05
       $parecer_disciplina_id2=$parece_espaco_tempo[$i];

        $result_nota_aula3=$conexao->query("
        SELECT * FROM nota_parecer WHERE
        escola_id=$idescola and
        turma_id=$idturma and
        ano_nota=$ano_letivo and
        avaliacao='av3' and periodo_id=3 and parecer_disciplina_id=$parecer_disciplina_id2 and aluno_id=$idaluno ");
        $nota_tri_3='';
        foreach ($result_nota_aula3 as $key => $value) {
          $nota_tri_3=$value['sigla'];
        }
        echo "$nota_tri_3";
        // 4=========

       ?>


    </o:p></span></p>
    </td>
    <?php 
    }
   ?>
   </tr>

<?php 
}
?>


<!-- 3 *************************************************************************************  3 -->


 <tr style='mso-yfti-irow:7;height:15.75pt'>
  <td width=394 nowrap colspan=3 rowspan=2 style='width:295.75pt;border:solid windowtext 1.0pt;
  border-bottom:solid black 1.0pt;mso-border-top-alt:windowtext .5pt;
  mso-border-left-alt:windowtext 1.0pt;mso-border-bottom-alt:black 1.0pt;
  mso-border-right-alt:windowtext .5pt;mso-border-style-alt:solid;background:
  #D9D9D9;padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:9.0pt;font-family:"Arial",sans-serif;
  mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
  PT-BR'>III TRAÇOS, SONS, CORES E FORMAS</span></b><b><span style='font-size:10.0pt;
  font-family:"Arial",sans-serif;mso-fareast-font-family:"Times New Roman";
  color:black;mso-fareast-language:PT-BR'><o:p></o:p></span></b></p>
  </td>
  <td width=71 nowrap colspan=3 style='width:53.4pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
  PT-BR'>TRIMESTRE<o:p></o:p></span></b></p>
  </td>
 
  <td width=434 colspan=5 rowspan=2 style='width:325.55pt;border-top:solid windowtext 1.0pt;
  border-left:none;border-bottom:none;border-right:solid windowtext 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  background:#D9D9D9;padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:9.0pt;font-family:"Arial",sans-serif;
  mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
  PT-BR'>OBSERVAÇÕES</span></b><b><span
  style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
  "Times New Roman";color:black;mso-fareast-language:PT-BR'><o:p></o:p></span></b></p>
  </td>
 </tr>


 <tr style='mso-yfti-irow:8;height:15.75pt'>
  <td width=24 nowrap style='width:17.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
  mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
  PT-BR'>1º<o:p></o:p></span></b></p>
  </td>
  <td width=24 nowrap style='width:17.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
  mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
  PT-BR'>2º<o:p></o:p></span></b></p>
  </td>
  <td width=24 nowrap style='width:17.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
  mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
  PT-BR'>3º<o:p></o:p></span></b></p>
  </td>
 </tr>




  <?php 
    $res_parec1=$conexao->query("SELECT parecer_disciplina.descricao,parecer_disciplina.id FROM parecer_disciplina WHERE serie_id =$idserie and disciplina_id=43  and parecer_disciplina.ano=$ano_letivo ");   
      $parece_o_eu=array();
      $parece_escuta_fala=array();

      $array_parece_o_eu=array();
      $conta=0;

    foreach ($res_parec1 as $key => $value) {
      $parecer_disciplina_id=$value['id'];
      $descricao=$value['descricao'];
      $parece_o_eu[$conta]=$descricao;
      $array_parece_o_eu[$conta]=$parecer_disciplina_id;
     
      $conta++;
    }


    $res_parec2=$conexao->query("SELECT parecer_disciplina.descricao,parecer_disciplina.id FROM
    parecer_disciplina WHERE serie_id =$idserie and disciplina_id=0  and parecer_disciplina.ano=$ano_letivo ");
    $conta2=0;
    foreach ($res_parec2 as $key => $value) {
      $parecer_disciplina_id=$value['id'];
      $descricao=$value['descricao']; 
      $parece_escuta_fala[$conta2]=$descricao;

      $array_parece_o_eu[$conta2]=$parecer_disciplina_id;
      $conta2++;
    }
    
    $maior=$conta2;
    if ($conta>$conta2) {
     $maior=$conta;
    }
    $conta_row=0;

    for ($i=0; $i < $maior ; $i++) {

      echo" <tr style='mso-yfti-irow:9;height:26.25pt'>";
      if ($i<$conta ) {
       
   ?>

        <td width=394 colspan=3 style='width:295.75pt;border:solid windowtext 1.0pt;
        border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
        mso-border-left-alt:solid windowtext 1.0pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
        height:26.25pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
        style='font-size:8.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
        "Times New Roman";color:black;mso-fareast-language:PT-BR'>
        <?php echo $parece_o_eu[$i]; ?>
        <o:p></o:p></span></p>
        </td>
        <td width=24 nowrap style='width:17.8pt;border-top:none;border-left:none;
        border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
        mso-border-alt:solid windowtext .5pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
        height:26.25pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
        line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
        mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
        PT-BR'>&nbsp;<o:p>

          <?php 

           $parecer_disciplina_id1=$array_parece_o_eu[$i];

            $result_nota_aula1=$conexao->query("
            SELECT * FROM nota_parecer WHERE
            escola_id=$idescola and
            turma_id=$idturma and
            ano_nota=$ano_letivo and
            avaliacao='av3' and periodo_id=1 and parecer_disciplina_id=$parecer_disciplina_id1 and aluno_id=$idaluno ");
            $nota_tri_1='';
            foreach ($result_nota_aula1 as $key => $value) {
            $nota_tri_1=$value['sigla'];
            }

             echo " $nota_tri_1";
            // 5========

           ?>

          </o:p></span></b></p>
        </td>

        <td width=24 nowrap style='width:17.8pt;border-top:none;border-left:none;
        border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
        mso-border-alt:solid windowtext .5pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
        height:26.25pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
        line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
        mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
        PT-BR'><o:p>

          <?php 

           $parecer_disciplina_id1=$array_parece_o_eu[$i];

            $result_nota_aula2=$conexao->query("
            SELECT * FROM nota_parecer WHERE
            escola_id=$idescola and
            turma_id=$idturma and
            ano_nota=$ano_letivo and
            avaliacao='av3' and periodo_id=2 and parecer_disciplina_id=$parecer_disciplina_id1 and aluno_id=$idaluno ");
            $nota_tri_2='';
            foreach ($result_nota_aula2 as $key => $value) {
            $nota_tri_2=$value['sigla'];
            }

             echo " $nota_tri_2";
            // 5========

           ?>

        </o:p></span></b></p>
        </td>
        <td width=24 nowrap style='width:17.8pt;border-top:none;border-left:none;
        border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
        mso-border-alt:solid windowtext .5pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
        height:26.25pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
        line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
        mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
        PT-BR'><o:p>

          <?php 

           $parecer_disciplina_id1=$array_parece_o_eu[$i];

            $result_nota_aula3=$conexao->query("
            SELECT * FROM nota_parecer WHERE
            escola_id=$idescola and
            turma_id=$idturma and
            ano_nota=$ano_letivo and
            avaliacao='av3' and periodo_id=3 and parecer_disciplina_id=$parecer_disciplina_id1 and aluno_id=$idaluno ");
            $nota_tri_3='';
            foreach ($result_nota_aula3 as $key => $value) {
              $nota_tri_3=$value['sigla'];
            }

             echo " $nota_tri_3";
            // 5========

          ?>

        </o:p></span></b></p>
        </td>
    <?php 
      }else{
    ?>
       
       
<?php 
      }

      if ($i==0) {
        // code...
?>
    <td nowrap colspan=5 rowspan="1" style='border-top:none;border-right:solid windowtext 1.0pt;' >
      <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
      style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
      "Times New Roman";color:black;mso-fareast-language:PT-BR'>

      <?php

            $result_parecer_tri1=$conexao->query("
              SELECT avaliacao,periodo_id,parecer_descritivo FROM nota_parecer WHERE
              escola_id=$idescola and
              turma_id=$idturma and
              ano_nota=$ano_letivo and
              periodo_id=1 and aluno_id=$idaluno and parecer_descritivo !='' group by avaliacao,periodo_id,parecer_descritivo ");

            $observacao="";
            $parecer_tri_1="";
            foreach ($result_parecer_tri1 as $key => $value) {
              $parecer_tri_1=$value['parecer_descritivo'];
            }

          // echo"I TRIMESTRE: </br>";
          
          $parecer_tri_1 = wordwrap($parecer_tri_1, 80, "<br />\n");

          //echo "$parecer_tri_1";

            $result_parecer_tri2=$conexao->query("
              SELECT avaliacao,periodo_id,parecer_descritivo FROM nota_parecer WHERE
              escola_id=$idescola and
              turma_id=$idturma and
              ano_nota=$ano_letivo and
              periodo_id=2 and aluno_id=$idaluno and parecer_descritivo !='' group by avaliacao,periodo_id,parecer_descritivo ");

            $parecer_tri_2="";
            foreach ($result_parecer_tri2 as $key => $value) {
              $parecer_tri_2=$value['parecer_descritivo'];
            }

            //echo"<br>II TRIMESTRE: </br>";
            
            $parecer_tri_2 = wordwrap($parecer_tri_2, 80, "<br />\n");
            
            //echo "$parecer_tri_2";

            $result_parecer_tri3=$conexao->query("
              SELECT avaliacao,periodo_id,parecer_descritivo FROM nota_parecer WHERE
              escola_id=$idescola and
              turma_id=$idturma and
              ano_nota=$ano_letivo and
              periodo_id=3 and aluno_id=$idaluno and parecer_descritivo !=''  group by avaliacao,periodo_id,parecer_descritivo ");

            $parecer_tri_3="";
            foreach ($result_parecer_tri3 as $key => $value) {
              $parecer_tri_3=$value['parecer_descritivo'];
            }

           // echo"<br>III TRIMESTRE: <br>";
            $parecer_tri_3 = wordwrap($parecer_tri_3, 80, "<br />\n");
           
           // echo "$parecer_tri_3";

      ?>
  <o:p>
      </td>

  </tr>

<?php 
  
      }
}
?>

   


 <tr style='mso-yfti-irow:29;mso-yfti-lastrow:yes;height:16.5pt'>
  <td width=996 nowrap colspan=11 style='width:746.8pt;border:solid windowtext 1.0pt;
  border-top:solid windowtext 1pt;mso-border-top-alt:solid windowtext 1pt;mso-border-top-alt:
  .5pt;mso-border-left-alt:1.0pt;mso-border-bottom-alt:1.0pt;mso-border-right-alt:
  .5pt;mso-border-color-alt:windowtext;mso-border-style-alt:solid;background:
  white;padding:0cm 3.5pt 0cm 3.5pt;height:16.5pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
  style='font-size:12.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
  "Times New Roman";color:black;mso-fareast-language:PT-BR'>Legenda: <span
  style='mso-spacerun:yes'></span>&nbsp;&nbsp;&nbsp;Sim (<span class=GramE>S)<span
  style='mso-spacerun:yes'></span></span><span
  style='mso-spacerun:yes'></span><span
  style='mso-spacerun:yes'></span><span
  style='mso-spacerun:yes'></span><span
  style='mso-spacerun:yes'></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Não (N)<span
  style='mso-spacerun:yes'> </span><span
  style='mso-spacerun:yes'></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Desenvolvimento
  <span style='mso-spacerun:yes'></span>(D)<o:p></o:p></span></b></p>
  </td>
 </tr>
 <![if !supportMisalignedColumns]>
 <tr height=0>
  <td width=84 style='border:none'></td>
  <td width=300 style='border:none'></td>
  <td width=11 style='border:none'></td>
  <td width=24 style='border:none'></td>
  <td width=24 style='border:none'></td>
  <td width=24 style='border:none'></td>
  <td width=218 style='border:none'></td>
  <td width=216 style='border:none'></td>
  <td width=32 style='border:none'></td>
  <td width=32 style='border:none'></td>
  <td width=32 style='border:none'></td>
 </tr>
 <![endif]>
</table>

<p class=MsoNormal><span style='color:black;mso-color-alt:windowtext'><br
clear=all style='mso-special-character:line-break'>
</span></p>

</div>

<?php 
}
?>