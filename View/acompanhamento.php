<?php
 function acompanhamento($conexao,$idescola,$idturma,$iddisciplina,$idserie,$ano_letivo,$seguimento){
  $tipo_ensino="";

    if ($idserie==16) {
      if ($seguimento==1) {
        $tipo_ensino="Educação Infantil";

      }if ($seguimento==2) {
        $tipo_ensino="Ensino Fundamental - Anos Iniciais";

      }else if($seguimento==3){
       $tipo_ensino="Ensino Fundamental - Anos Finais";
        

      }
    }else if($idserie <3 ){
      $tipo_ensino="Educação Infantil";

    }else if ($idserie >=3 && $idserie <8 ) {
       $tipo_ensino="Ensino Fundamental - Anos Iniciais";

    }else if ($idserie >= 8 && $idserie <=11) {
       $tipo_ensino="Ensino Fundamental - Anos Finais";

    }else if ($idserie > 11){
      $tipo_ensino="Educação de Jovens e Adultos";

    }

?>

<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:w="urn:schemas-microsoft-com:office:word"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
  <meta charset="UTF-8">
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=ProgId content=Word.Document>
<meta name=Generator content="Microsoft Word 15">
<meta name=Originator content="Microsoft Word 15">
<link rel=File-List href="RENDIMENTOS_arquivos/filelist.xml">
<link rel=Edit-Time-Data href="RENDIMENTOS_arquivos/editdata.mso">

<style>
  .Namerotate {
    display:inline-block;
    filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
    -webkit-transform: rotate(270deg);
    -ms-transform: rotate(270deg);
    transform: rotate(270deg);
    
  }
  
  .tblborder, .tblborder td, .tblborder th{
    border-collapse:collapse;
    border:1px solid #000;
  }
  
  .tblborder td, .tblborder th{
    padding:20px 10px;
  }
  
  .positionRi {
    position: absolute;
    top: 10px;
    left: 5px;
    /*right:0; */
    width: 200px;
    height: 150px;
    /*border: 3px solid #73AD21;*/
  }

  .positionRi2 {
    position: absolute;
    top: 10px;
    left: 20px; 
    /*right:50; */
    /* height: 150px;  
    width: 40px;*/  
    /*border: 3px solid #73AD21;*/
}

.positionRi3 {
  position: absolute;
  top: 1px;
  left: 1px;
  margin-top: 10px;
  /*right:0; */
  height: 20px;
  width: 175px;
  
  /*border: 3px solid #73AD21;*/
}

.positionNumero {
  position: relative;
  /*top: 1px;
  left: 1px;
  margin-top: 10px;
  right:0; */
  height: 20px;
  /* width: 50px; */
  width: 5px;
  
  /*border: 3px solid #73AD21;*/
}
  
  </style>


<link rel=themeData href="RENDIMENTOS_arquivos/themedata.thmx">
<link rel=colorSchemeMapping href="RENDIMENTOS_arquivos/colorschememapping.xml">

<style>

 /* Font Definitions */
 @font-face
  {font-family:"Cambria Math";
  panose-1:2 4 5 3 5 4 6 3 2 4;
  mso-font-charset:0;
  mso-generic-font-family:roman;
  mso-font-pitch:variable;
  mso-font-signature:3 0 0 0 1 0;}
@font-face
  {font-family:Calibri;
  panose-1:2 15 5 2 2 2 4 3 2 4;
  mso-font-charset:0;
  mso-generic-font-family:swiss;
  mso-font-pitch:variable;
  mso-font-signature:-469750017 -1073732485 9 0 511 0;}
@font-face
  {font-family:"Tw Cen MT Condensed";
  panose-1:2 11 6 6 2 1 4 2 2 3;
  mso-font-charset:0;
  mso-generic-font-family:swiss;
  mso-font-pitch:variable;
  mso-font-signature:7 0 0 0 3 0;}
@font-face
  {font-family:"Arial Black";
  panose-1:2 11 10 4 2 1 2 2 2 4;
  mso-font-charset:0;
  mso-generic-font-family:swiss;
  mso-font-pitch:variable;
  mso-font-signature:-1610612049 1073772795 0 0 159 0;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
  {mso-style-unhide:no;
  mso-style-qformat:yes;
  mso-style-parent:"";
  margin-top:0cm;
  margin-right:0cm;
  margin-bottom:8.0pt;
  margin-left:0cm;
  line-height:107%;
  mso-pagination:widow-orphan;
  font-size:11.0pt;
  font-family:"Calibri",sans-serif;
  mso-ascii-font-family:Calibri;
  mso-ascii-theme-font:minor-latin;
  mso-fareast-font-family:Calibri;
  mso-fareast-theme-font:minor-latin;
  mso-hansi-font-family:Calibri;
  mso-hansi-theme-font:minor-latin;
  mso-bidi-font-family:"Times New Roman";
  mso-bidi-theme-font:minor-bidi;
  mso-fareast-language:EN-US;}
.MsoChpDefault
  {mso-style-type:export-only;
  mso-default-props:yes;
  font-family:"Calibri",sans-serif;
  mso-ascii-font-family:Calibri;
  mso-ascii-theme-font:minor-latin;
  mso-fareast-font-family:Calibri;
  mso-fareast-theme-font:minor-latin;
  mso-hansi-font-family:Calibri;
  mso-hansi-theme-font:minor-latin;
  mso-bidi-font-family:"Times New Roman";
  mso-bidi-theme-font:minor-bidi;
  mso-fareast-language:EN-US;}
.MsoPapDefault
  {mso-style-type:export-only;
  margin-bottom:8.0pt;
  line-height:107%;}
@page WordSection1
  {size:595.3pt 841.9pt;
  margin:70.85pt 3.0cm 70.85pt 3.0cm;
  mso-header-margin:35.4pt;
  mso-footer-margin:35.4pt;
  mso-paper-source:0;}
div.WordSection1
  {page:WordSection1;}

</style>

</head>

<body lang=PT-BR style='tab-interval:35.4pt;word-wrap:break-word'>

<div class=WordSection1>

 <!-- FECHANDO A LINHA NO TOPO DO NOME PREFEITURA -->
 <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=1091
 style='width:818.05pt;border-collapse:collapse;mso-yfti-tbllook:1184;
 mso-padding-alt:0cm 3.5pt 0cm 3.5pt; border: 1px solid black;'>

 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:15.0pt' >

  <td width=20 nowrap valign=bottom style='width:14.85pt;padding:0cm 3.5pt 0cm 3.5pt; height:15.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span style='mso-ignore:vglayout'>
  <table cellpadding=0 cellspacing=0 align=left>
   <tr>
    <td width=15 height=11></td>
   </tr>
   <tr>
    <td><img width=53 height=60 src="imagens/logo.png" v:shapes="Imagem_x0020_3"></td>
   </tr>
  </table>
  </span><![endif]><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
  mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
  PT-BR'><o:p>&nbsp;</o:p></span></p>

  <!--br style='mso-ignore:vglayout' clear=ALL-->

  <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0
   style='mso-cellspacing:0cm;mso-yfti-tbllook:1184;mso-padding-alt:0cm 0cm 0cm 0cm'>


  </table>
  </td>
  
    <td width=1114 colspan=12 style='width:835.15pt;border-top:solid windowtext 1.0pt;
      border-left:none;border-bottom:none;border-right:solid black 1.0pt;
      padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
      <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
      line-height:normal'><b><span style='font-size:23.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
      mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
      color:black;mso-fareast-language:PT-BR'><?php echo $_SESSION['ORGAO']; ?><o:p></o:p></span></b></p>
      <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
      line-height:normal'><b><span style='font-size:18.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
      mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
      color:black;mso-fareast-language:PT-BR'>SECRETARIA MUNICIPAL DE EDUCAÇÃO<o:p></o:p></span></b></p>
    </td>
    
 </tr>

  





 <tr style='mso-yfti-irow:5;height:12.0pt'>
  <td width=807 colspan=12 valign=bottom style='width:605.25pt;border:none;
  border-left:solid windowtext 1.0pt;padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
  style='font-size:15.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>ESCOLA MUNICIPAL:<span
  style='mso-spacerun:yes'> </span><o:p>
<?php 
$result_escola= $conexao->query("SELECT * FROM escola where idescola =$idescola");
foreach ($result_escola as $key => $value) {
  $nome_escola=$value['nome_escola'];
  echo "$nome_escola";
}

?>
  </o:p></span></b></p>
  </td>
  <td width=326 valign=bottom style='width:244.75pt;border:none;border-right:
  solid windowtext 1.0pt;padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
  style='font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6;height:12.0pt'>
  <td width=807 colspan=12 valign=bottom style='width:605.25pt;border:none;
  border-left:solid windowtext 1.0pt;padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
  style='font-size:15.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>ENDEREÇO:<span
  style='mso-spacerun:yes'> </span><o:p></o:p></span></b></p>
  </td>
 
 </tr>

 <tr style='mso-yfti-irow:7;height:12.0pt'>
  <td width=407 colspan=12 valign=bottom style='width:405.25pt;border:none;
  border-left:solid windowtext 1.0pt;padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
  style='font-size:15.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>TIPO DE ENSINO: <?php echo $tipo_ensino;  ?> <o:p></o:p></span></b></p>
  </td>

 </tr>


 <tr style='mso-yfti-irow:8;height:5.25pt'>
  <td width=20 nowrap style='width:14.85pt;border-top:none;border-left:solid windowtext 1.0pt;
  border-bottom:solid windowtext 1.0pt;border-right:none;padding:0cm 3.5pt 0cm 3.5pt;
  height:5.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=257 nowrap style='width:192.75pt;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:5.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=47 nowrap style='width:35.0pt;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:5.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
  </td>

  <td width=47 nowrap style='width:34.95pt;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:5.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
  </td>

  <td width=47 nowrap style='width:35.0pt;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:5.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
  </td>
 

  
 </tr>

 <tr style='mso-yfti-irow:9;height:15.0pt'>
  <td width=277 colspan=2 valign=bottom style='width:207.6pt;border-top:none;
  border-left:solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;
  border-right:none;mso-border-top-alt:solid windowtext 1.0pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
  style='font-size:11.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>ANO:

<?php 
$result_escola= $conexao->query("SELECT * FROM serie where id =$idserie");
foreach ($result_escola as $key => $value) {
  $nome_serie=$value['nome'];
  echo "$nome_serie";
}

?>
   <o:p></o:p></span></b></p>
  </td>
  <td width=233 colspan=2 valign=bottom style='width:174.9pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-top-alt:solid windowtext 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
  style='font-size:11.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>TURMA:<span
  style='mso-spacerun:yes'> </span><o:p>

<?php 
$result_escola= $conexao->query("SELECT * FROM turma where idturma=$idturma");
foreach ($result_escola as $key => $value) {
  $nome_turma=$value['nome_turma'];
  echo "$nome_turma";
}

?>
  </o:p></span></b></p>
  </td>
  <td width=297  valign=bottom style='width:222.75pt;border:none;
  border-bottom:solid windowtext 1.0pt; border-right:solid windowtext 1.0pt;mso-border-top-alt:solid windowtext 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
  style='font-size:11.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>TURNO: <o:p></o:p></span></b></p>
  </td>

 </tr>



 




 <!-- **************************************************************** -->



  <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:12.75pt'>
  <td width=370 nowrap colspan=3 style='width:277.4pt;border:solid windowtext 1.0pt;
  border-right:solid black 1.0pt;mso-border-top-alt:windowtext 1.0pt;
  mso-border-left-alt:windowtext 1.0pt;mso-border-bottom-alt:windowtext .5pt;
  mso-border-right-alt:black 1.0pt;mso-border-style-alt:solid;padding:0cm 3.5pt 0cm 3.5pt;
  height:12.75pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>COMPONENTE CURRICULAR: <o:p></o:p></span></b></p>
  </td>
  <td width=530 nowrap colspan=2 style='width:397.6pt;border:none;border-top:
  solid windowtext 1.0pt;padding:0cm 3.5pt 0cm 3.5pt;height:12.75pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>PROFESSOR(A): <o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1;height:13.5pt'>
  <td width=370 nowrap colspan=3 style='width:277.4pt;border-top:none;
  border-left:solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;
  border-right:solid black 1.0pt;mso-border-top-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:13.5pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>TRIMESTRE<o:p></o:p></span></b></p>
  </td>
  <td width=530 nowrap colspan=2 style='width:397.6pt;border:none;border-bottom:
  solid windowtext 1.0pt;padding:0cm 3.5pt 0cm 3.5pt;height:13.5pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'><span
  style='mso-spacerun:yes'> </span><o:p></o:p></span></p>
  </td>
 </tr>


 <tr style='mso-yfti-irow:2;height:18.0pt'>
  <td width=77 nowrap style='width:58.0pt;border:none;border-left:solid windowtext 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:18.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:9.0pt;
  font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family:"Times New Roman";
  mso-bidi-font-family:Arial;color:black;mso-fareast-language:PT-BR'>Nº<o:p></o:p></span></p>
  </td>

  <td width=225 nowrap style='width:58.55pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 3.5pt 0cm 3.5pt;height:18.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family:"Times New Roman";
  mso-bidi-font-family:Arial;color:black;mso-fareast-language:PT-BR'>Data<o:p></o:p></span></b></p>
  </td>

  <td width=136 nowrap colspan=2 style='width:201.7pt;border:none;border-bottom:
  solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:solid windowtext 1.0pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:18.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family:"Times New Roman";
  mso-bidi-font-family:Arial;color:black;mso-fareast-language:PT-BR'>NOME DO
  ALUNO<o:p></o:p></span></b></p>
  </td>
  <td width=202 nowrap style='width:202.75pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid windowtext 1.0pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:18.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family:"Times New Roman";
  mso-bidi-font-family:Arial;color:black;mso-fareast-language:PT-BR'>ACOMPANHAMENTO
  PEDAGÓGICO (OCORRÊNCIAS)<o:p></o:p></span></b></p>
  </td>
 </tr>

 
<?php


   $result= listar_aluno_da_turma_ata_resultado_final($conexao,$idturma,$idescola,$ano_letivo);
  // $result= listar_aluno_da_turma_coordenador($conexao,$idturma,$idescola);
  $conta=1;
foreach ($result as $key => $value) {
  
  $nome_aluno=($value['nome_aluno']);
  $nome_turma=($value['nome_turma']);
  $idaluno=$value['idaluno'];

  $result_ocorrencia=$conexao->query("SELECT * FROM ocorrencia_pedagogica,aluno where aluno_id=aluno.idaluno and disciplina_id=$iddisciplina and turma_id=$idturma and descricao !='' and  aluno_id=$idaluno ORDER BY data_ocorrencia ASC");
  $descricao="";
  $data_ocorrencia='';
  foreach ($result_ocorrencia as $key => $value) {
    $descricao=$value['descricao'];
    $data_ocorrencia=converte_data($value['data_ocorrencia']);


      echo "

      <tr height=0>
       <td width=77 style='border:1px solid;'> $conta </td>
       <td width=225 style='border:1px solid'> $data_ocorrencia </td>
       <td width=168 colspan='2' style='border-bottom:1px solid;font-size:8.0pt; '>$nome_aluno</td>

       <td width=462 style='border:1px solid'>  $descricao </td>
      </tr>

      ";

        }
      ?>

 
 

<?php 
$conta++;
}
 ?>








</table>

<p class=MsoNormal><o:p>&nbsp;</o:p></p>

</div>

</body>

</html>
<?php
}
?>
