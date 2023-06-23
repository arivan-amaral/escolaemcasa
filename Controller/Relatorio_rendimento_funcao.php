<?php 
set_time_limit(0);
session_start();
include_once '../Model/Conexao.php';
include_once '../Model/Coordenador.php';
include_once '../Model/Turma.php';
include_once '../Model/Aluno.php';
include_once '../Model/Escola.php';
include_once 'Cauculos_notas.php';

$idturma=$_GET['idturma'];
$idescola=$_GET['idescola'];
$idperiodo=$_GET['periodo'];
$ano_letivo=$_SESSION['ano_letivo'];
$idturmas=" IN(-1";
$idturma_aux=" IN(-1";




  if (isset($_GET['idturma'])) {
    $idturma = $_GET['idturma'];

    // Explode a string em um array usando a vírgula como delimitador
    $valoresSelecionados = explode(',', $idturma);

    $idturma_aux.=",".$valoresSelecionados[0];

    foreach ($valoresSelecionados as $value) {
      $idturmas.=",".$value;
    }


  }

  $idturma_aux.=") ";
  $idturmas.=") ";

  $res_periodo=listar_data_por_periodo($conexao,$ano_letivo,$idperiodo);
  $nome_periodo="";

  foreach ($res_periodo as $key => $value) {
    $nome_periodo=$value['descricao'];
  }

  $res2=lista_de_turmas_relatorio($conexao,$idturmas);
  $nome_turma="";
  foreach ($res2 as $key => $value) {
    $nome_turma.=$value['nome_turma'].", ";
  }




    $res_calendario=listar_data_periodo($conexao,$ano_letivo);
    $data_inicio_trimestre1="";
    $data_fim_trimestre1="";    
    $data_inicio_trimestre2="";
    $data_fim_trimestre2="";

    $data_inicio_trimestre3="";
    $data_fim_trimestre3="";
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


 

<table class= border=0 cellspacing=0 cellpadding=0 align=left
 width=783 style='width:587.45pt;border-collapse:collapse;mso-yfti-tbllook:
 1184;mso-table-lspace:7.05pt;margin-left:4.8pt;mso-table-rspace:7.05pt;
 margin-right:4.8pt;mso-table-anchor-vertical:page;mso-table-anchor-horizontal:
 margin;mso-table-left:left;mso-table-top:40.55pt;mso-padding-alt:0cm 3.5pt 0cm 3.5pt'>

 
 <tr style='mso-yfti-irow:7;height:15.35pt'>
  <td width=769 nowrap colspan=23 rowspan=2 style='width:100%;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;background:#C5D9F1;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><b><span
  style='font-size:14.0pt;font-family:"Cambria",serif;mso-fareast-font-family:
  "Times New Roman";mso-bidi-font-family:Calibri;color:black;mso-fareast-language:
  PT-BR'>FICHA DE DESEMPENHO ESCOLAR POR TURMA - <?php echo $_SESSION['ano_letivo']; ?><o:p></o:p></span></b></p>
  </td>
 
 </tr>
 <tr style='mso-yfti-irow:8;height:12.3pt'>
  <td width=14 nowrap colspan=2 valign=bottom style='width:10.6pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:12.3pt'></td>
   
 </tr>
 <tr style='mso-yfti-irow:9;height:15.35pt'>
  <td width=166 nowrap colspan=4 style='width:124.65pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  background:#C5D9F1;padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><b><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>PERIODO DE REFERENCIA<o:p></o:p></span></b></p>
  </td>
  <td width=105 nowrap colspan=3 style='width:79.1pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  background:#C5D9F1;padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><b><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>ANO<o:p></o:p></span></b></p>
  </td>
  <td width=111 nowrap colspan=3 style='width:83.35pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  background:#C5D9F1;padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><b><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>TURMA<o:p></o:p></span></b></p>
  </td>
  <td width=204 nowrap colspan=6 style='width:153.35pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  background:#C5D9F1;padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><b><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>GRAU<o:p></o:p></span></b></p>
  </td>
  
 </tr>
 <tr style='mso-yfti-irow:10;height:15.35pt'>
  <td width=166 nowrap colspan=4 rowspan=2 style='width:124.65pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><b><span
  style='font-family:"Arial",sans-serif;mso-fareast-font-family:"Times New Roman";
  color:black;mso-fareast-language:PT-BR'> <?php echo $nome_periodo; ?> <o:p></o:p></span></b></p>
  </td>
  <td width=105 nowrap colspan=3 rowspan=2 style='width:79.1pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><b><span
  style='font-family:"Arial",sans-serif;mso-fareast-font-family:"Times New Roman";
  color:black;mso-fareast-language:PT-BR'><?php echo "$nome_turma"; ?> <o:p></o:p></span></b></p>
  </td>
  <td width=111 nowrap colspan=3 rowspan=2 style='width:83.35pt;border-top:
  none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><b><span
  style='font-family:"Arial",sans-serif;mso-fareast-font-family:"Times New Roman";
  color:black;mso-fareast-language:PT-BR'> <?php echo $nome_turma; ?><o:p></o:p></span></b></p>
  </td>
  <td width=204 nowrap colspan=6 rowspan=2 style='width:153.35pt;border-top:
  none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><b><span
  style='font-family:"Arial",sans-serif;mso-fareast-font-family:"Times New Roman";
  color:black;mso-fareast-language:PT-BR'><!-- FUNDAMENTAL II --><o:p></o:p></span></b></p>
  </td>
  <td width=182 nowrap colspan=7 rowspan=2 style='width:136.3pt;border-top:
  none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><b><span
  style='font-family:"Arial",sans-serif;mso-fareast-font-family:"Times New Roman";
  color:black;mso-fareast-language:PT-BR'><!-- MATUTINO --><o:p></o:p></span></b></p>
  </td>


 </tr>
 <tr style='mso-yfti-irow:11;height:15.35pt'>



 </tr>
 <tr style='mso-yfti-irow:12;height:15.35pt'>
  <td width=769 nowrap colspan=23 valign=bottom style='width:576.85pt;
  border:none;border-right:solid black 1.0pt;mso-border-right-alt:solid black .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal;mso-element:
  frame;mso-element-frame-hspace:7.05pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:40.55pt;mso-height-rule:
  exactly'>
  
  
  


    <span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'><o:p></o:p></span></p>
  <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 align=left
   style='mso-cellspacing:0cm;mso-yfti-tbllook:1184;margin-left:-2.25pt;
   margin-right:-2.25pt;mso-table-anchor-vertical:page;mso-table-anchor-horizontal:
   margin;mso-table-left:left;mso-padding-alt:0cm 0cm 0cm 0cm'>
   <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes;
    height:16.15pt'>
    <td width=263 nowrap style='width:197.05pt;border:solid windowtext 1.0pt;
    border-right:solid black 1.0pt;mso-border-alt:solid windowtext .5pt;
    mso-border-right-alt:solid black .5pt;background:#C5D9F1;padding:0cm 0cm 0cm 0cm;
    height:16.15pt'>
    <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
    line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
    mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
    margin;mso-element-top:40.55pt;mso-height-rule:exactly'><span
    style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
    mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
    mso-fareast-language:PT-BR'><span style='mso-spacerun:yes'> </span><b>APROVEITAMENTO
    POR DISCIPLINA</b><o:p></o:p></span></p>
    </td>
   </tr>
  </table>
  </td>
 
 </tr>
 <tr style='mso-yfti-irow:13;height:15.35pt;mso-row-margin-right:1.35pt'>
  <td width=90 nowrap colspan=2 rowspan=2 style='width:67.75pt;border-top:windowtext;
  border-left:windowtext;border-bottom:black;border-right:black;border-style:
  solid;border-width:1.0pt;mso-border-top-alt:windowtext;mso-border-left-alt:
  windowtext;mso-border-bottom-alt:black;mso-border-right-alt:black;mso-border-style-alt:
  solid;mso-border-width-alt:.5pt;background:#C5D9F1;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><b><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>Disciplinas<o:p></o:p></span></b></p>
  </td>

  <!-- //disciplinas -->
  <?php 
  $res_disc=listar_disciplina_para_relatorio($conexao,$idturma_aux,$idescola,$ano_letivo);

   
  $conta_parecer=0;
  $linha=0;
  $resultado_final=true;
  $resultado_conselho=false;
  
  $conta_dis=0;
  $conta_conselho=0;
  $conta_apr=0;


  $qnt_displina=0;
  $array_disciplina = array();
  foreach ($res_disc as $key => $value) {
    $iddisciplina=$value['iddisciplina'];
    $nome_disciplina=$value['nome_disciplina'];
    $conta_dis++;
    $qnt_displina++;
    $array_disciplina[$iddisciplina]=$nome_disciplina;

  ?>

  <td width=76 colspan=2 rowspan=2 style='width:56.9pt;border-top:solid windowtext 1.0pt;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-top-alt:windowtext;
  mso-border-left-alt:windowtext;mso-border-bottom-alt:black;mso-border-right-alt:
  black;mso-border-style-alt:solid;mso-border-width-alt:.5pt;background:#C5D9F1;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><b><span
  style='font-size:10.5pt;mso-ascii-font-family:Calibri;mso-fareast-font-family:
  "Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'><?php echo "$nome_disciplina"; ?><o:p></o:p></span></b></p>
  <?php

   }
  ?>

<!-- 
  <td width=45 nowrap colspan=2 rowspan=2 style='width:33.85pt;border-top:solid windowtext 1.0pt;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-top-alt:windowtext;
  mso-border-left-alt:windowtext;mso-border-bottom-alt:black;mso-border-right-alt:
  black;mso-border-style-alt:solid;mso-border-width-alt:.5pt;background:#C5D9F1;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><b><span
  style='font-size:10.5pt;mso-ascii-font-family:Calibri;mso-fareast-font-family:
  "Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></b></p>
  </td> -->
 
 </tr>
 <tr style='mso-yfti-irow:14;height:15.35pt;mso-row-margin-right:1.35pt'>

 </tr>
 <tr style='mso-yfti-irow:15;height:15.35pt;mso-row-margin-right:1.5pt'>
  <td width=90 nowrap colspan=2 style='width:67.75pt;border-top:none;
  border-left:solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;
  border-right:solid black 1.0pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;mso-border-right-alt:solid black .5pt;
  background:#C5D9F1;padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><b><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>Resultados<o:p></o:p></span></b></p>
  </td>
  <?php 

for ($i=0; $i < $qnt_displina; $i++) { 
   ?>
  <td width=29 nowrap style='width:21.45pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>N <o:p></o:p></span></p>
  </td>
  <td width=47 nowrap style='width:35.4pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>%<o:p></o:p></span></p>
  </td>
  <?php 
}
   ?>

 </tr>



 <tr style='mso-yfti-irow:16;height:15.35pt;mso-row-margin-right:1.5pt'>
  <td width=90 nowrap colspan=2 rowspan=2 style='width:67.75pt;border-top:none;
  border-left:solid windowtext 1.0pt;border-bottom:solid black 1.0pt;
  border-right:solid black 1.0pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-top-alt:windowtext;mso-border-left-alt:windowtext;mso-border-bottom-alt:
  black;mso-border-right-alt:black;mso-border-style-alt:solid;mso-border-width-alt:
  .5pt;background:#C5D9F1;padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><b><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>Aprovados<o:p></o:p></span></b></p>
  </td>


  <?php 
    
   $total_aprovados_geral=0;
   $total_reprovados_geral=0;
   $array_reprovados_disciplina=array();
   $array_aprovados_disciplina=array();
   $mult_displina=$qnt_displina;

  $res_disc=listar_disciplina_para_relatorio($conexao,$idturma_aux,$idescola,$ano_letivo);

foreach ($res_disc as $key => $value) {
    $iddisciplina=$value['iddisciplina'];
    $total_disciplina=0;
  
      $res_aluno=$conexao->query("
        SELECT
        aluno.aluno_transpublico, 
        aluno.linha_transporte,
        aluno.imagem_carteirinha_transporte ,
        aluno.nome AS nome_aluno,
        aluno.sexo,
        aluno.data_nascimento,
        aluno.idaluno,
        aluno.email,
        aluno.status AS status_aluno,
        aluno.senha,
        turma.nome_turma,
        ecidade_matricula.matricula_codigo AS matricula,
        ecidade_matricula.matricula_datamatricula AS data_matricula,
        ecidade_matricula.datasaida AS datasaida
    FROM ecidade_matricula
    INNER JOIN aluno ON ecidade_matricula.aluno_id = aluno.idaluno
    INNER JOIN turma ON ecidade_matricula.turma_id = turma.idturma
    INNER JOIN escola ON ecidade_matricula.turma_escola = escola.idescola
    WHERE ecidade_matricula.turma_escola = $idescola
      AND ecidade_matricula.turma_id $idturmas
      AND ecidade_matricula.calendario_ano = '$ano_letivo'
      AND ecidade_matricula.matricula_ativa='S'
    ORDER BY aluno.nome ASC");

    foreach ($res_aluno as $key => $value) {
      $idaluno=$value['idaluno'];
     
      if (!array_key_exists($iddisciplina,$array_reprovados_disciplina)) {
        $array_reprovados_disciplina[$iddisciplina]=0;
      }
      
      if (!array_key_exists($iddisciplina,$array_aprovados_disciplina)) {
        $array_aprovados_disciplina[$iddisciplina]=0;
      }
    
      $result_nota_aula1=$conexao->query("
                SELECT avaliacao,periodo_id,nota FROM nota_parecer WHERE
                escola_id=$idescola and
                turma_id $idturmas and
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
            $nota_tri_1=number_format($nota_tri_1, 1, '.', ',');

              if (!array_key_exists($iddisciplina,$array_reprovados_disciplina)) {
                $array_reprovados_disciplina[$iddisciplina]=0;
              }

            if ($nota_tri_1>=5) {
              $total_disciplina++;
              $total_aprovados_geral++;
              $array_aprovados_disciplina[$iddisciplina]=$total_disciplina;


            }else{
            
              $array_reprovados_disciplina[$iddisciplina]=$array_reprovados_disciplina[$iddisciplina]+1;
              $total_reprovados_geral++;

            }

}
          


   

  ?>
  <td width=29 nowrap rowspan=2 style='width:21.45pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid black .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>
  <?php 

      echo $total_disciplina;


  
   ?><o:p></o:p></span></p>
  </td>
  <td width=47 nowrap rowspan=2 style='width:35.4pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid black .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>*<o:p></o:p></span></p>
  </td>
<?php 
}

 ?>



 </tr>
 <tr style='mso-yfti-irow:17;height:15.35pt;mso-row-margin-right:1.5pt'>

 </tr>
 <tr style='mso-yfti-irow:18;height:15.35pt;mso-row-margin-right:1.5pt'>
  <td width=90 nowrap colspan=2 rowspan=2 style='width:67.75pt;border-top:none;
  border-left:solid windowtext 1.0pt;border-bottom:solid black 1.0pt;
  border-right:solid black 1.0pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-top-alt:windowtext;mso-border-left-alt:windowtext;mso-border-bottom-alt:
  black;mso-border-right-alt:black;mso-border-style-alt:solid;mso-border-width-alt:
  .5pt;background:#C5D9F1;padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><b><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>Reprovados<o:p></o:p></span></b></p>
  </td>

<?php 
  $res_disc_resultado=listar_disciplina_para_relatorio($conexao,$idturma_aux,$idescola,$ano_letivo);
 
 
foreach ($res_disc_resultado as $key_disc=> $value_disc) {
  $iddisc=$value_disc['iddisciplina'];
 

?>

  <td width=29 nowrap rowspan=2 style='width:21.45pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid black .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'><?php 
    if (array_key_exists($iddisc,$array_reprovados_disciplina)) {
        echo $array_reprovados_disciplina[$iddisc];
    }else{
      echo "0";
    }

     ?><o:p></o:p></span></p>
  </td>
  <td width=47 nowrap rowspan=2 style='width:35.4pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid black .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>*<o:p></o:p></span></p>
  </td>

<?php 
  
} ?>
 </tr>
 <tr style='mso-yfti-irow:19;height:15.35pt;mso-row-margin-right:1.5pt'>

 </tr>
 <tr style='mso-yfti-irow:20;height:15.35pt;mso-row-margin-right:1.55pt'>
  <td width=51 nowrap valign=bottom style='width:38.15pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.35pt'></td>
  <td width=39 nowrap valign=bottom style='width:29.55pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.35pt'></td>
  <td width=29 nowrap valign=bottom style='width:21.45pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.35pt'></td>
  <td width=47 nowrap valign=bottom style='width:35.4pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.35pt'></td>
  <td width=30 nowrap valign=bottom style='width:22.7pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.35pt'></td>
  <td width=50 nowrap valign=bottom style='width:37.45pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.35pt'></td>
  <td width=25 nowrap valign=bottom style='width:18.85pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.35pt'></td>
  <td width=43 nowrap valign=bottom style='width:32.25pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.35pt'></td>
  <td width=25 nowrap valign=bottom style='width:18.85pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.35pt'></td>
  <td width=43 nowrap valign=bottom style='width:32.25pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.35pt'></td>
  <td width=25 nowrap valign=bottom style='width:18.85pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.35pt'></td>
  <td width=43 nowrap valign=bottom style='width:32.25pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.35pt'></td>
  <td width=25 nowrap valign=bottom style='width:18.85pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.35pt'></td>
  <td width=43 nowrap valign=bottom style='width:32.25pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.35pt'></td>
  <td width=25 nowrap valign=bottom style='width:18.85pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.35pt'></td>
  <td width=43 nowrap valign=bottom style='width:32.25pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.35pt'></td>
  <td width=25 nowrap valign=bottom style='width:18.85pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.35pt'></td>
  <td width=43 nowrap valign=bottom style='width:32.25pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.35pt'></td>
  <td width=25 nowrap colspan=2 valign=bottom style='width:19.05pt;padding:
  0cm 3.5pt 0cm 3.5pt;height:15.35pt'></td>
  <td width=43 nowrap valign=bottom style='width:32.25pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.35pt'></td>
  <td width=25 nowrap valign=bottom style='width:18.85pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.35pt'></td>
  <td width=20 nowrap valign=bottom style='width:14.95pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.35pt'></td>

 </tr>
 <tr style='mso-yfti-irow:21;height:15.35pt'>
  <td width=166 nowrap colspan=4 style='width:124.65pt;border:solid windowtext 1.0pt;
  border-right:solid black 1.0pt;mso-border-alt:solid windowtext .5pt;
  mso-border-right-alt:solid black .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:
  15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><b><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>FLUXO DE ALUNOS<o:p></o:p></span></b></p>
  </td>
  <td width=492 nowrap colspan=15 style='width:369.1pt;border-top:solid windowtext 1.0pt;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-bottom-alt:solid windowtext .5pt;
  mso-border-right-alt:solid black .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:
  15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><b><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>APROVEITAMENTO DA TURMA<o:p></o:p></span></b></p>
  </td>
  <td width=111 nowrap colspan=4 style='width:83.05pt;border-top:solid windowtext 1.0pt;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-bottom-alt:solid windowtext .5pt;
  mso-border-right-alt:solid black .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:
  15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
  </td>

 </tr>
 <tr style='mso-yfti-irow:22;height:15.35pt'>
  <td width=90 nowrap colspan=2 style='width:67.75pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  background:#C5D9F1;padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><b><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>Matriculados<o:p></o:p></span></b></p>
  </td>
  <td width=156 nowrap colspan=4 style='width:117.1pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  background:#C5D9F1;padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><b><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>Aprovados<o:p></o:p></span></b></p>
  </td>
  <td width=136 nowrap colspan=4 style='width:102.25pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  background:#C5D9F1;padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><b><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>Reprovados<o:p></o:p></span></b></p>
  </td>
  <td width=136 nowrap colspan=4 style='width:102.25pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  background:#C5D9F1;padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><b><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>Evadidos<o:p></o:p></span></b></p>
  </td>
  <td width=139 nowrap colspan=5 style='width:104.35pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  background:#C5D9F1;padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><b><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>Transferidos<o:p></o:p></span></b></p>
  </td>
  <td width=111 nowrap colspan=4 style='width:83.05pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  background:#C5D9F1;padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><b><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>Efetivos<o:p></o:p></span></b></p>
  </td>

 </tr>




 <tr style='mso-yfti-irow:23;height:15.35pt;mso-row-margin-right:1.35pt'>
  <td width=90 nowrap colspan=2 rowspan=3 style='width:67.75pt;border-top:none;
  border-left:solid windowtext 1.0pt;border-bottom:solid black 1.0pt;
  border-right:solid black 1.0pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-top-alt:windowtext;mso-border-left-alt:windowtext;mso-border-bottom-alt:
  black;mso-border-right-alt:black;mso-border-style-alt:solid;mso-border-width-alt:
  .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>*<o:p></o:p></span></p>
  </td>
  <td width=76 nowrap colspan=2 style='width:56.9pt;border:none;border-right:
  solid black 1.0pt;mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-right-alt:solid black .5pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>N <o:p></o:p></span></p>
  </td>


  <td width=80 nowrap colspan=2 style='width:60.2pt;border:none;border-right:
  solid black 1.0pt;mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-right-alt:solid black .5pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>%<o:p></o:p></span></p>
  </td>
  <td width=68 nowrap colspan=2 style='width:51.1pt;border:none;border-right:
  solid black 1.0pt;mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-right-alt:solid black .5pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>N <o:p></o:p></span></p>
  </td>
  <td width=68 nowrap colspan=2 style='width:51.1pt;border:none;border-right:
  solid black 1.0pt;mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-right-alt:solid black .5pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>%<o:p></o:p></span></p>
  </td>
  <td width=68 nowrap colspan=2 style='width:51.1pt;border:none;border-right:
  solid black 1.0pt;mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-right-alt:solid black .5pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>N <o:p></o:p></span></p>
  </td>
  <td width=68 nowrap colspan=2 style='width:51.1pt;border:none;border-right:
  solid black 1.0pt;mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-right-alt:solid black .5pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>%<o:p></o:p></span></p>
  </td>
  <td width=68 nowrap colspan=2 style='width:51.1pt;border:none;border-right:
  solid black 1.0pt;mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-right-alt:solid black .5pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>N <o:p></o:p></span></p>
  </td>
  <td width=68 nowrap colspan=2 style='width:51.1pt;border:none;border-right:
  solid black 1.0pt;mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-right-alt:solid black .5pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>%<o:p></o:p></span></p>
  </td>
  <td width=68 nowrap colspan=3 style='width:51.3pt;border:none;border-right:
  solid black 1.0pt;mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-right-alt:solid black .5pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>N <o:p></o:p></span></p>
  </td>
  <td width=45 nowrap colspan=2 style='width:33.85pt;border:none;border-right:
  solid black 1.0pt;mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-right-alt:solid black .5pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>%<o:p></o:p></span></p>
  </td>

 </tr>
 

 <tr style='mso-yfti-irow:24;height:15.35pt;mso-row-margin-right:1.35pt'>
 


  <td width=76 nowrap colspan=2 rowspan=2 style='width:56.9pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid black .5pt;mso-border-right-alt:solid black .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>*<?php //echo "$total_aprovados_geral"; ?><o:p></o:p></span></p>
  </td>
  <td width=80 nowrap colspan=2 rowspan=2 style='width:60.2pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid black .5pt;mso-border-right-alt:solid black .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>%<o:p></o:p></span></p>
  </td>
  <td width=68 nowrap colspan=2 rowspan=2 style='width:51.1pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid black .5pt;mso-border-right-alt:solid black .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>*<?php //echo "$total_reprovados_geral"; ?><o:p></o:p></span></p>
  </td>
  <td width=68 nowrap colspan=2 rowspan=2 style='width:51.1pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid black .5pt;mso-border-right-alt:solid black .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>*<o:p></o:p></span></p>
  </td>
  <td width=68 nowrap colspan=2 rowspan=2 style='width:51.1pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid black .5pt;mso-border-right-alt:solid black .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>*<o:p></o:p></span></p>
  </td>
  <td width=68 nowrap colspan=2 rowspan=2 style='width:51.1pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid black .5pt;mso-border-right-alt:solid black .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>*<o:p></o:p></span></p>
  </td>
  <td width=68 nowrap colspan=2 rowspan=2 style='width:51.1pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid black .5pt;mso-border-right-alt:solid black .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>*<o:p></o:p></span></p>
  </td>
  <td width=68 nowrap colspan=2 rowspan=2 style='width:51.1pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid black .5pt;mso-border-right-alt:solid black .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>*<o:p></o:p></span></p>
  </td>
  <td width=68 nowrap colspan=3 rowspan=2 style='width:51.3pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid black .5pt;mso-border-right-alt:solid black .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>*<o:p></o:p></span></p>
  </td>
  <td width=45 nowrap colspan=2 rowspan=2 style='width:33.85pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid black .5pt;mso-border-right-alt:solid black .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>*<o:p></o:p></span></p>
  </td>

 </tr>
 <tr style='mso-yfti-irow:25;height:15.35pt;mso-row-margin-right:1.35pt'>

 </tr>
 <tr style='mso-yfti-irow:26;height:6.1pt;mso-row-margin-right:1.55pt'>
  <td width=51 nowrap valign=bottom style='width:38.15pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:6.1pt'></td>
  <td width=39 nowrap style='width:29.55pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:6.1pt'></td>
  <td width=29 nowrap style='width:21.45pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:6.1pt'></td>
  <td width=47 nowrap style='width:35.4pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:6.1pt'></td>
  <td width=30 nowrap valign=bottom style='width:22.7pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:6.1pt'></td>
  <td width=50 nowrap valign=bottom style='width:37.45pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:6.1pt'></td>
  <td width=25 nowrap valign=bottom style='width:18.85pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:6.1pt'></td>
  <td width=43 nowrap valign=bottom style='width:32.25pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:6.1pt'></td>
  <td width=25 nowrap valign=bottom style='width:18.85pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:6.1pt'></td>
  <td width=43 nowrap valign=bottom style='width:32.25pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:6.1pt'></td>
  <td width=25 nowrap valign=bottom style='width:18.85pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:6.1pt'></td>
  <td width=43 nowrap valign=bottom style='width:32.25pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:6.1pt'></td>
  <td width=25 nowrap valign=bottom style='width:18.85pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:6.1pt'></td>
  <td width=43 nowrap valign=bottom style='width:32.25pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:6.1pt'></td>
  <td width=25 nowrap valign=bottom style='width:18.85pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:6.1pt'></td>
  <td width=43 nowrap valign=bottom style='width:32.25pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:6.1pt'></td>
  <td width=25 nowrap valign=bottom style='width:18.85pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:6.1pt'></td>
  <td width=43 nowrap valign=bottom style='width:32.25pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:6.1pt'></td>
  <td width=25 nowrap colspan=2 valign=bottom style='width:19.05pt;padding:
  0cm 3.5pt 0cm 3.5pt;height:6.1pt'></td>
  <td width=43 nowrap valign=bottom style='width:32.25pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:6.1pt'></td>
  <td width=25 nowrap valign=bottom style='width:18.85pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:6.1pt'></td>
  <td width=20 nowrap valign=bottom style='width:14.95pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:6.1pt'></td>
  <td width=13 style='width:9.5pt;padding:0cm 3.5pt 0cm 3.5pt;height:6.1pt'></td>
  <td style='mso-cell-special:placeholder;border:none;padding:0cm 0cm 0cm 0cm'
  width=2><p class='MsoNormal'>&nbsp;</td>
  <![if !supportMisalignedRows]>
  <td style='height:6.1pt;border:none' width=0 height=8></td>
  <![endif]>
 </tr>
 <tr style='mso-yfti-irow:27;height:15.35pt'>
  <td width=197 nowrap colspan=5 style='width:147.4pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;background:#C5D9F1;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><b><span
  style='font-size:10.0pt;mso-ascii-font-family:Calibri;mso-fareast-font-family:
  "Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'>CARIMBO DA ESCOLA<o:p></o:p></span></b></p>
  </td>
  <td width=211 nowrap colspan=6 style='width:158.6pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-top-alt:solid windowtext .5pt;mso-border-bottom-alt:
  solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;background:
  #C5D9F1;padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><b><span
  style='font-size:10.0pt;mso-ascii-font-family:Calibri;mso-fareast-font-family:
  "Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'>ASSINATURA E CARIMBO DO(A) DIRETOR(A)<o:p></o:p></span></b></p>
  </td>
  <td width=250 nowrap colspan=8 style='width:187.7pt;border-top:solid windowtext 1.0pt;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-bottom-alt:solid windowtext .5pt;
  mso-border-right-alt:solid black .5pt;background:#C5D9F1;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><b><span
  style='font-size:10.0pt;mso-ascii-font-family:Calibri;mso-fareast-font-family:
  "Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'>ASSINATURA E CARIMBO DO(A)
  SECRETÁRIO(A)<o:p></o:p></span></b></p>
  </td>
  <td width=111 nowrap colspan=4 style='width:83.05pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-top-alt:solid windowtext .5pt;mso-border-bottom-alt:
  solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;background:
  #C5D9F1;padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><b><span
  style='font-size:10.0pt;mso-ascii-font-family:Calibri;mso-fareast-font-family:
  "Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'>DATA<o:p></o:p></span></b></p>
  </td>

 </tr>
 <tr style='mso-yfti-irow:28;height:15.35pt'>
  <td width=197 nowrap colspan=5 rowspan=5 style='width:147.4pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=211 nowrap colspan=6 rowspan=5 valign=bottom style='width:158.6pt;
  border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;
  border-right:solid windowtext 1.0pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=250 nowrap colspan=8 rowspan=5 valign=bottom style='width:187.7pt;
  border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:
  solid black 1.0pt;mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:
  solid windowtext .5pt;mso-border-top-alt:windowtext;mso-border-left-alt:windowtext;
  mso-border-bottom-alt:black;mso-border-right-alt:black;mso-border-style-alt:
  solid;mso-border-width-alt:.5pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=111 colspan=4 rowspan=5 style='width:83.05pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal;mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:40.55pt;mso-height-rule:exactly'><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'> <?php echo date("d/m/Y"); ?> <span style='mso-spacerun:yes'>    
  </span>
  <!-- 29/07/2021 -->
  <o:p></o:p></span></p>
  </td>

 </tr>
 <tr style='mso-yfti-irow:29;height:15.35pt'>

 </tr>
 <tr style='mso-yfti-irow:30;height:15.35pt'>

 </tr>
 <tr style='mso-yfti-irow:31;height:15.35pt'>

 </tr>
 <tr style='mso-yfti-irow:32;mso-yfti-lastrow:yes;height:15.35pt'>

 </tr>

</table>


