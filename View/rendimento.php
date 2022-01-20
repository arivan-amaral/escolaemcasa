<?php
  include"../Controller/Conversao.php";
  include"../Model/Coordenador.php";
  include"../Model/Aluno.php";
  include"../Model/Professor.php";
  include"../Controller/Cauculos_notas.php";

 function rendimento($conexao,$idescola,$idturma,$iddisciplina,$idserie,$nome_professor){


if ($idserie <3) {
  $tipo_ensino="Educação Infantil";
}if ($idserie >=3 && $idserie <8) {
  $tipo_ensino="Ensino Fundamental - Anos Iniciais";
}else if($idserie >= 8 && $idserie <=11){
  $tipo_ensino="Ensino Fundamental - Anos Finais";

}else if ($idserie>11) {
  $tipo_ensino="Educação de Jovens e Adultos";

}
$result_disc = $conexao->query("SELECT * FROM disciplina where iddisciplina=$iddisciplina");
foreach ($result_disc as $key => $value) {
  $nome_disciplina=$value['nome_disciplina'];
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
      color:black;mso-fareast-language:PT-BR'>PREFEITURA DE LUÍS EDUARDO MAGALHÃES<o:p></o:p></span></b></p>
      <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
      line-height:normal'><b><span style='font-size:18.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
      mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
      color:black;mso-fareast-language:PT-BR'>SECRETARIA MUNICIPAL DE EDUCAÇÃO<o:p></o:p></span></b></p>
    </td>
    
 </tr>

  

 <tr style='mso-yfti-irow:3;height:12.75pt'>
  <td width=20 style='width:14.85pt;border:none;border-left:solid windowtext 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></b></p>
  </td>

    <td width=1114 colspan=12 style='width:835.15pt;border:none;border-right:
    solid black 1.0pt;padding:0cm 3.5pt 0cm 3.5pt;height:12.75pt'></td>
 
</tr>

 <tr style='mso-yfti-irow:4;height:12.75pt'>
    <td width=20 style='width:14.85pt;border:none;border-left:solid windowtext 1.0pt;
    padding:0cm 3.5pt 0cm 3.5pt;height:12.75pt'>
    <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
    line-height:normal'><b><span style='font-family:"Tw Cen MT Condensed",sans-serif;
    mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
    color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></b></p>
    </td>

    <td width=257 style='width:192.75pt;padding:0cm 3.5pt 0cm 3.5pt;height:12.75pt'></td>
    <td width=47 style='width:35.0pt;padding:0cm 3.5pt 0cm 3.5pt;height:12.75pt'></td>
    <td width=47 style='width:34.95pt;padding:0cm 3.5pt 0cm 3.5pt;height:12.75pt'></td>
    <td width=47 style='width:35.0pt;padding:0cm 3.5pt 0cm 3.5pt;height:12.75pt'></td>
    <td width=47 style='width:34.95pt;padding:0cm 3.5pt 0cm 3.5pt;height:12.75pt'></td>
    <td width=47 style='width:35.0pt;padding:0cm 3.5pt 0cm 3.5pt;height:12.75pt'></td>
    <td width=47 style='width:34.95pt;padding:0cm 3.5pt 0cm 3.5pt;height:12.75pt'></td>
    <td width=47 style='width:34.95pt;padding:0cm 3.5pt 0cm 3.5pt;height:12.75pt'></td>
    <td width=47 style='width:34.95pt;padding:0cm 3.5pt 0cm 3.5pt;height:12.75pt'></td>
    <td width=47 style='width:34.95pt;padding:0cm 3.5pt 0cm 3.5pt;height:12.75pt'></td>
    <td width=111 style='width:82.95pt;padding:0cm 3.5pt 0cm 3.5pt;height:12.75pt'></td>
    <td width=326 style='width:244.75pt;border:none; padding:0cm 3.5pt 0cm 3.5pt;height:12.75pt'>
    <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
    line-height:normal'><b><span style='font-family:"Tw Cen MT Condensed",sans-serif;
    mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
    color:black;mso-fareast-language:PT-BR'><o:p></o:p></span></b></p>
    </td>
 </tr>

 <tr style='mso-yfti-irow:5;height:12.0pt'>
  <td width=807 colspan=12 valign=bottom style='width:605.25pt;border:none;
  border-left:solid windowtext 1.0pt;padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
  style='font-size:13.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
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
  style='font-size:13.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>ENDEREÇO:<span
  style='mso-spacerun:yes'> </span><o:p></o:p></span></b></p>
  </td>
  <td width=326 valign=bottom style='width:244.75pt;border:none;border-right:
  solid windowtext 1.0pt;padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
  style='font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:7;height:12.0pt'>
  <td width=807 colspan=12 valign=bottom style='width:605.25pt;border:none;
  border-left:solid windowtext 1.0pt;padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
  style='font-size:13.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>TIPO DE ENSINO: <?php echo "$tipo_ensino"; ?>  <o:p></o:p></span></b></p>
  </td>  

  <td width=326 valign=bottom style='width:244.75pt;border:none;border-right:
  solid windowtext 1.0pt;padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
  style='font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></b></p>
  </td>
 </tr> 

 <tr style='mso-yfti-irow:7;height:12.0pt'>
  
  <td width=807 colspan=12 valign=bottom style='width:605.25pt;border:none;
  border-left:solid windowtext 1.0pt;padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
  style='font-size:13.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>Professor: <?php echo "$nome_professor"; ?>  <o:p></o:p></span></b></p>
  </td>  

  <td width=326 valign=bottom style='width:244.75pt;border:none;border-right:
  solid windowtext 1.0pt;padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
  style='font-size:13.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>DISCIPLINA: <?php echo "$nome_disciplina"; ?><o:p></o:p></span></b></p>
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

  <td width=47 nowrap style='width:34.95pt;border:none;border-bottom:solid windowtext 1.0pt;
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
  <td width=47 nowrap style='width:34.95pt;border:none;border-bottom:solid windowtext 1.0pt;
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
  <td width=111 nowrap style='width:82.95pt;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:5.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
  style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></b></p>
  </td>
  <td width=326 nowrap style='width:244.75pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:5.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
  style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></b></p>
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
  <td width=233 colspan=5 valign=bottom style='width:174.9pt;border:none;
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
  <td width=297 colspan=5 valign=bottom style='width:222.75pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-top-alt:solid windowtext 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
  style='font-size:11.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>TURNO: <o:p></o:p></span></b></p>
  </td>
  <td width=326 valign=bottom style='width:244.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
  style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:10;height:15.0pt'>
  <td width=1133 nowrap colspan=13 style='width:850.0pt;border-top:none;
  border-left:solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;
  border-right:solid black 1.0pt;mso-border-top-alt:solid windowtext 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:12.0pt;font-family:"Arial Black",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>RESULTADO ANUAL<o:p></o:p></span></b></p>
  </td>
 </tr>

 <tr style='mso-yfti-irow:11;height:13.5pt'>

    <td width=20 nowrap rowspan=3 style='border:solid windowtext 1.0pt;
        border-top:none;mso-border-left-alt:solid windowtext 1.0pt;mso-border-bottom-alt:
        solid windowtext .5pt;mso-border-right-alt:solid windowtext 1.0pt;background:
        #D9D9D9;padding:0cm 3.5pt 0cm 3.5pt;mso-rotate:90;height:13.5pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
        line-height:normal'><b><div class="Namerotate"><span style='font-family:"Tw Cen MT Condensed",sans-serif;
        mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
        color:black;mso-fareast-language:PT-BR'><div>Número</div><o:p></o:p></span></div></b></p>
    </td>

  <td width=257 nowrap rowspan=3 style='width:192.75pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-left-alt:solid windowtext 1.0pt;mso-border-left-alt:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:13.5pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:12.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>ALUNO(A)<o:p></o:p></span></b></p>
  </td>

      <td width=233 nowrap colspan=5 style='width:174.9pt;border:none;border-bottom:
          solid windowtext 1.0pt;mso-border-top-alt:solid windowtext 1.0pt;padding:
          0cm 3.5pt 0cm 3.5pt;height:13.5pt'>
          <p style='margin-left: 150px;line-height:normal'><b>
          <span style='font-size:10.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
          mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
          color:black;mso-fareast-language:PT-BR'>Rendimento<o:p></o:p></span></b></p>
      </td>

  <td width=47 nowrap style='width:34.95pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:13.5pt;border: 1px solid black;border-left:none'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:7.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></b></p>
  </td>

  <!-- TD PADRÃO ROTATION E POSITIO -->
  <td width=47 nowrap rowspan=3 style='width:34.95pt;border-top:none;
      border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
      mso-border-left-alt:solid windowtext 1.0pt;
      mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext 1.0pt;
      padding: 5cm 3.5pt 0cm 3.5pt;mso-rotate:90;height:13.5pt'>
      <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
      line-height:normal'><b><div class="Namerotate"><span style='font-family:"Arial",sans-serif;
      mso-fareast-font-family:"Times New Roman";color:black;mso-color-alt:windowtext;
      mso-fareast-language:PT-BR'><div class="positionRi">TOTAL DE PONTOS</div></span></div></b></p>
  </td>

  <!-- TD PADRÃO ROTATION E POSITIO -->
  <td width=47 nowrap rowspan=3 style='width:34.95pt;border-top:none;
      border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
      mso-border-left-alt:solid windowtext 1.0pt;
      mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext 1.0pt;
      padding: 5cm 3.5pt 0cm 3.5pt;mso-rotate:90;height:13.5pt'>
      <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
      line-height:normal'><b><div class="Namerotate"><span style='font-family:"Arial",sans-serif;
      mso-fareast-font-family:"Times New Roman";color:black;mso-color-alt:windowtext;
      mso-fareast-language:PT-BR'><div class="positionRi">MÉDIA FINAL</div></span></div></b></p>
  </td>

  <!-- TD PADRÃO ROTATION E POSITIO -->
  <td width=47 nowrap rowspan=3 style='width:34.95pt;border-top:none;
      border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
      mso-border-left-alt:solid windowtext 1.0pt;
      mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext 1.0pt;
      background:#D9D9D9;padding: 5cm 3.5pt 0cm 3.5pt;mso-rotate:90;height:13.5pt'>
      <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
      line-height:normal'><b><div class="Namerotate"><span style='font-family:"Arial",sans-serif;
      mso-fareast-font-family:"Times New Roman";color:black;mso-color-alt:windowtext;
      mso-fareast-language:PT-BR'><div class="positionRi">TOTAL DE FALTAS</div></span></div></b></p>
  </td>

  <td width=111 rowspan=3 style='width:82.95pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-left-alt:solid windowtext 1.0pt;mso-border-left-alt:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext 1.0pt;
  background:white;padding:0cm 3.5pt 0cm 3.5pt;height:13.5pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:12.0pt;font-family:"Arial Black",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-color-alt:windowtext;mso-fareast-language:PT-BR'>PARECER
  FINAL</span></b><b><span style='font-size:12.0pt;font-family:"Arial Black",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  mso-fareast-language:PT-BR'><o:p></o:p></span></b></p>
  </td>
  <td width=326 nowrap rowspan=3 style='width:244.75pt;border:none;mso-border-left-alt:solid windowtext 1.0pt;padding:
  0cm 3.5pt 0cm 3.5pt;height:13.5pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:12.0pt;font-family:"Arial Black",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>OBSERVAÇÃO<o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:12;height:89.25pt'>
  <td width=47 valign=bottom style='width:35.0pt;border:none;border-bottom:
  solid windowtext 1.0pt;padding:0cm 3.5pt .4cm 3.5pt; mso-rotate:90;height:89.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
  style='font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'><div class="Namerotate">Data:</div><o:p></o:p></span></b></p>
  </td>

      <td width=47 nowrap rowspan=2 valign=bottom style='width:34.95pt;border-top:
          none;border-left:solid windowtext 1.0pt;border-bottom:none;border-right:solid windowtext 1.0pt;
          background:#D9D9D9;padding: 0cm 3.5pt 0cm 6.5pt;mso-rotate:90;height:20.25pt'>
          <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
          line-height:normal'><b><div class="Namerotate" ><span style='font-size:9.0pt;font-family:"Arial",sans-serif;
          mso-fareast-font-family:"Times New Roman";color:black;mso-color-alt:windowtext;
          mso-fareast-language:PT-BR'><div class="positionRi3">TOTAL FALTAS I TRIMESTRE</div></span></div></b><b><span
          style='font-size:9.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
          "Times New Roman";mso-fareast-language:PT-BR'><o:p></o:p></span></b></p>
      </td>

      <td width=47 valign=bottom style='width:35.0pt;border:none;border-bottom:
          solid windowtext 1.0pt;background:white;padding:0cm 3.5pt .4cm 3.5pt;
          mso-rotate:90;height:89.25pt'>
          <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
          style='font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
          mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
          color:black;mso-fareast-language:PT-BR'><div class="Namerotate">Data:</div><o:p></o:p></span></b></p>
      </td>

    <td width=47 nowrap rowspan=2 valign=bottom style='width:34.95pt;border-top:
        none;border-left:solid windowtext 1.0pt;border-bottom:none;border-right:solid windowtext 1.0pt;
        background:#D9D9D9;padding:.2cm 3.5pt 0cm 6.5pt;mso-rotate:90;height:99.25pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
        line-height:normal'><b><div class="Namerotate"><span style='font-size:9.0pt;font-family:"Arial",sans-serif;
        mso-fareast-font-family:"Times New Roman";color:black;mso-color-alt:windowtext;
        mso-fareast-language:PT-BR'><div class="positionRi3">TOTAL FALTAS II TRIMESTRE</div></span></div></b><b><span
        style='font-size:9.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
        "Times New Roman";mso-fareast-language:PT-BR'><o:p></o:p></span></b></p>
    </td>

    <td width=47 valign=bottom style='width:35.0pt;border-top:none;border-left:
        none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        background:white;padding:0cm 3.5pt .4cm 3.5pt;mso-rotate:90;height:89.25pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
        style='font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
        mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
        color:black;mso-fareast-language:PT-BR'><div class="Namerotate">Data:</div><o:p></o:p></span></b></p>
    </td>

    <td width=47 nowrap rowspan=2 valign=bottom style='width:34.95pt;border-top:
    solid windowtext 1.0pt;border-bottom:none;border-right:solid windowtext 1.0pt;
    background:#D9D9D9;padding:.2cm 3.5pt 0cm 6.5pt;mso-rotate:90;height:99.25pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
        line-height:normal'><b><div class="Namerotate"><span style='font-size:9.0pt;font-family:"Arial",sans-serif;
        mso-fareast-font-family:"Times New Roman";color:black;mso-color-alt:windowtext;
        mso-fareast-language:PT-BR'><div class="positionRi3">TOTAL FALTAS III TRIMESTRE</div></span></div></b><b><span
        style='font-size:9.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
        "Times New Roman";mso-fareast-language:PT-BR'><o:p></o:p></span></b></p>
    </td>

 </tr>
 <tr style='mso-yfti-irow:13;height:52.5pt'>
  <td width=47 style='width:35.0pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:52.5pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>I TRIM<o:p></o:p></span></b></p>
  </td>
  <td width=47 style='width:35.0pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
  height:52.5pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>II TRIM<o:p></o:p></span></b></p>
  </td>
  <td width=47 style='width:35.0pt;border:none;border-right:solid windowtext 1.0pt;
  background:white;padding:0cm 3.5pt 0cm 3.5pt;height:52.5pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>III TRIM<o:p></o:p></span></b></p>
  </td>
 </tr>





<!-- arivan linhas  -->
 
<?php
  // $result= listar_aluno_da_turma_coordenador($conexao,$idturma,$idescola);

  // $conta=1;
  // foreach ($result as $key => $value) {
  //   $nome_aluno=utf8_decode($value['nome_aluno']);
  //   $nome_turma=($value['nome_turma']);
  //   $idaluno=$value['idaluno'];
  //   $status_aluno=$value['status_aluno'];
  //   $email=$value['email'];
  //   $senha=$value['senha'];
  //   
  //   
  

 
  $conta_aluno=1; 
  $matricula_aluno="";
  // $res_alunos=listar_aluno_da_turma_ata_resultado_final($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);


  if ($_SESSION['ano_letivo']==$_SESSION['ano_letivo_vigente']) {
    $res_alunos=listar_aluno_da_turma_ata_resultado_final($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
  }else{
    $res_alunos=listar_aluno_da_turma_ata_resultado_final_matricula_concluida($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
   }

   foreach ($res_alunos as $key => $value) {
    $idaluno=$value['idaluno'];
    $nome_aluno=$value['nome_aluno'];
    $matricula_aluno=$value['matricula'];

  // pesquisar_aluno_da_turma_ata_resultado_final
    $res_movimentacao=pesquisar_aluno_da_turma_ata_resultado_final($conexao,$matricula_aluno,$_SESSION['ano_letivo']);

    $data_evento="";
    $descricao_procedimento="";
    $procedimento="";
    $matricula="";
    foreach ($res_movimentacao as $key => $value) {
        $datasaida=($value['datasaida']);
        // $matricula=($value['matricula']);
        // $data_evento=converte_data($value['data_evento']);
        // $descricao_procedimento=$value['descricao_procedimento'];
        $procedimento=$value['procedimento'];
        
        if ($datasaida!="") {
          $datasaida=converte_data($datasaida);
        }
    }
    

if ($procedimento !='') {

  echo"<tr style='mso-yfti-irow:14;height:15.0pt'>
    
        <td width=20 style='width:14.85pt;border:solid windowtext 1.0pt;border-top:
            none;mso-border-top-alt:solid windowtext 1.0pt;mso-border-alt:solid windowtext 1.0pt;
            mso-border-bottom-alt:solid windowtext .5pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
            height:15.0pt'>
            <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
            line-height:normal'><span style='font-size:8.0pt;font-family:'Tw Cen MT Condensed',sans-serif;mso-fareast-font-family:'Times New Roman';mso-bidi-font-family:Arial;
            color:black;mso-fareast-language:PT-BR'> $conta_aluno
<o:p></o:p></span></p>
        </td>       

        <td colsplan='100%' width=20 style='width:14.85pt;border:solid windowtext 1.0pt;border-top:
            none;mso-border-top-alt:solid windowtext 1.0pt;mso-border-alt:solid windowtext 1.0pt;
            mso-border-bottom-alt:solid windowtext .5pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
            height:15.0pt'>
            <p class=MsoNormal  style='margin-bottom:0cm;text-align:left;
            line-height:normal'>
            <span style='font-size:10.0pt;font-family:'Tw Cen MT Condensed',sans-serif;mso-fareast-font-family:'Times New Roman';mso-bidi-font-family:Arial;
            color:black;mso-fareast-language:PT-BR'> $nome_aluno
          <o:p></o:p></span>
          </p>
        </td>

        <td colsplan='100%' style='border: 1px solid black'>
            <span style='font-size:10.0pt;font-family:'Tw Cen MT Condensed',sans-serif;mso-fareast-font-family:'Times New Roman';mso-bidi-font-family:Arial;color:black;mso-fareast-language:PT-BR;'><b>  - </b>
           <o:p></o:p>
           </span>
        </td>

        <td colsplan='100%' style='border: 1px solid black'>
            <span style='font-size:10.0pt;font-family:'Tw Cen MT Condensed',sans-serif;mso-fareast-font-family:'Times New Roman';mso-bidi-font-family:Arial;color:black;mso-fareast-language:PT-BR;'><b>  - </b>
           <o:p></o:p>
           </span>
        </td>  
        <td colsplan='100%' style='border: 1px solid black'>
            <span style='font-size:10.0pt;font-family:'Tw Cen MT Condensed',sans-serif;mso-fareast-font-family:'Times New Roman';mso-bidi-font-family:Arial;color:black;mso-fareast-language:PT-BR;'><b>  - </b>
           <o:p></o:p>
           </span>
        </td>  

        <td colsplan='100%' style='border: 1px solid black'>
            <span style='font-size:10.0pt;font-family:'Tw Cen MT Condensed',sans-serif;mso-fareast-font-family:'Times New Roman';mso-bidi-font-family:Arial;color:black;mso-fareast-language:PT-BR;'><b>  - </b>
           <o:p></o:p>
           </span>
        </td>  
        <td colsplan='100%' style='border: 1px solid black'>
            <span style='font-size:10.0pt;font-family:'Tw Cen MT Condensed',sans-serif;mso-fareast-font-family:'Times New Roman';mso-bidi-font-family:Arial;color:black;mso-fareast-language:PT-BR;'><b>  - </b>
           <o:p></o:p>
           </span>
        </td>  
        <td colsplan='100%' style='border: 1px solid black'>
            <span style='font-size:10.0pt;font-family:'Tw Cen MT Condensed',sans-serif;mso-fareast-font-family:'Times New Roman';mso-bidi-font-family:Arial;color:black;mso-fareast-language:PT-BR;'><b>  - </b>
           <o:p></o:p>
           </span>
        </td>  
        <td colsplan='100%' style='border: 1px solid black'>
            <span style='font-size:10.0pt;font-family:'Tw Cen MT Condensed',sans-serif;mso-fareast-font-family:'Times New Roman';mso-bidi-font-family:Arial;color:black;mso-fareast-language:PT-BR;'><b>  - </b>
           <o:p></o:p>
           </span>
        </td>  
        <td colsplan='100%' style='border: 1px solid black'>
            <span style='font-size:10.0pt;font-family:'Tw Cen MT Condensed',sans-serif;mso-fareast-font-family:'Times New Roman';mso-bidi-font-family:Arial;color:black;mso-fareast-language:PT-BR;'><b>  - </b>
           <o:p></o:p>
           </span>
        </td>  
        <td colsplan='100%' style='border: 1px solid black'>
            <span style='font-size:10.0pt;font-family:'Tw Cen MT Condensed',sans-serif;mso-fareast-font-family:'Times New Roman';mso-bidi-font-family:Arial;color:black;mso-fareast-language:PT-BR;'><b>  - </b>
           <o:p></o:p>
           </span>
        </td>  
        <td colsplan='100%' style='border: 1px solid black'>
           <span style='font-size:10.0pt;font-family:'Tw Cen MT Condensed',sans-serif;mso-fareast-font-family:'Times New Roman';mso-bidi-font-family:Arial;color:black;mso-fareast-language:PT-BR;'><b>  - </b>
           <o:p></o:p>
           </span>
        </td>
        <td colsplan='100%' style='border: 1px solid black'>
            <p class=MsoNormal 
            line-height:normal'><span style='font-size:10.0pt;font-family:'Tw Cen MT Condensed',sans-serif;mso-fareast-font-family:'Times New Roman';mso-bidi-font-family:Arial;
            color:black;mso-fareast-language:PT-BR;'>  $procedimento
<o:p></o:p></span></p>
        </td>


      
        </tr>";


}else{
?>
 


<tr style='mso-yfti-irow:14;height:15.0pt'>
  
    <td width=20 style='width:14.85pt;border:solid windowtext 1.0pt;border-top:
        none;mso-border-top-alt:solid windowtext 1.0pt;mso-border-alt:solid windowtext 1.0pt;
        mso-border-bottom-alt:solid windowtext .5pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
        height:15.0pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
        line-height:normal'><span style='font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
        mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
        color:black;mso-fareast-language:PT-BR'><?php echo $conta_aluno; ?><o:p></o:p></span></p>
    </td>




  <td width=257 nowrap style='width:192.75pt;border:none;border-bottom:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext 1.0pt;mso-border-top-alt:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
  "Times New Roman";color:#000000;mso-fareast-language:PT-BR'><?php echo "$nome_aluno"; ?><o:p></o:p></span></p>
  </td>


  <td width=47 nowrap style='width:35.0pt;border:solid windowtext 1.0pt;
    mso-border-alt:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
    background:white;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
    <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
    line-height:normal'><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
    mso-fareast-font-family:"Times New Roman";color:#000000;mso-fareast-language:
    PT-BR'><o:p>

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

    // if ($nota_tri_1<5 && $nota_rp_1!='' && $nota_rp_1>$nota_av3_1) {
    //  $nota_tri_1=($nota_tri_1-$nota_av3_1)+$nota_rp_1;
    // }
      $nota_tri_1=calculos_media_notas($nota_tri_1,$nota_rp_1,$nota_av3_1);
    

    echo "$nota_tri_1";
?>
    </o:p></span></p>
  </td>

  <td width=47 nowrap style='width:35.0pt;border:solid windowtext 1.0pt;
    mso-border-alt:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
    background:white;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
    <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
    line-height:normal'><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
    mso-fareast-font-family:"Times New Roman";color:#000000;mso-fareast-language:
    PT-BR'>

<?php
// faltas trimestre 1
$res_fre_t1=$conexao->query("
SELECT count(*) as 'quantidade' FROM frequencia WHERE
escola_id=$idescola and
turma_id=$idturma and
disciplina_id=$iddisciplina and 
presenca=0 and data_frequencia BETWEEN '2021-02-01' and '2021-05-01' and aluno_id=$idaluno ");

$quantidade_falta1=0;
foreach ($res_fre_t1 as $key => $value) {
  $quantidade_falta1=$value['quantidade'];
}

//echo "$quantidade_falta1";
echo "-";
?>

  <o:p></o:p></span></p>
  </td>


  <td width=47 nowrap style='width:35.0pt;border:solid windowtext 1.0pt;
    mso-border-alt:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
    background:white;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
    <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
    line-height:normal'><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
    mso-fareast-font-family:"Times New Roman";color:#000000;mso-fareast-language:
    PT-BR'>

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

// if ($nota_tri_2<5 && $nota_rp_2!='' && $nota_rp_2>$nota_av3_2) {
//  $nota_tri_2=($nota_tri_2-$nota_av3_2)+$nota_rp_2;
// }
      $nota_tri_2=calculos_media_notas($nota_tri_2,$nota_rp_2,$nota_av3_2);

echo "$nota_tri_2";
?>

    <o:p></o:p></span></p>
  </td>


<td width=47 nowrap style='width:35.0pt;border:solid windowtext 1.0pt;
    mso-border-alt:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
    background:white;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
    <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
    line-height:normal'><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
    mso-fareast-font-family:"Times New Roman";color:#000000;mso-fareast-language:
    PT-BR'>

<?php
// faltas trimestre 2
$res_fre_t2=$conexao->query("
SELECT count(*) as 'quantidade' FROM frequencia WHERE
escola_id=$idescola and
turma_id=$idturma and
disciplina_id=$iddisciplina and 
presenca=0 and data_frequencia BETWEEN '2021-05-01' and '2021-09-01' and aluno_id=$idaluno ");

$quantidade_falta2=0;
foreach ($res_fre_t2 as $key => $value) {
  $quantidade_falta2=$value['quantidade'];
}

//echo "$quantidade_falta2";
echo "-";
?>

  <o:p></o:p></span></p>
  </td>


  <td width=47 nowrap style='width:35.0pt;border:solid windowtext 1.0pt;
    mso-border-alt:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
    background:white;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
    <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
    line-height:normal'><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
    mso-fareast-font-family:"Times New Roman";color:#000000;mso-fareast-language:
    PT-BR'>

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

// if ($nota_tri_3<5 && $nota_rp_3!='' && $nota_rp_3>$nota_av3_3) {
//  $nota_tri_3=($nota_tri_3-$nota_av3_3)+$nota_rp_3;
// }

      $nota_tri_3=calculos_media_notas($nota_tri_3,$nota_rp_3,$nota_av3_3);


echo "$nota_tri_3";
?>
    <o:p></o:p></span></p>
  </td>


<td width=47 nowrap style='width:35.0pt;border:solid windowtext 1.0pt;
    mso-border-alt:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
    background:white;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
    <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
    line-height:normal'><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
    mso-fareast-font-family:"Times New Roman";color:#000000;mso-fareast-language:
    PT-BR'>

    <?php
    // faltas trimestre 3
    $res_fre_t3=$conexao->query("
    SELECT count(*) as 'quantidade' FROM frequencia WHERE
    escola_id=$idescola and
    turma_id=$idturma and
    disciplina_id=$iddisciplina and 
    presenca=0 and data_frequencia BETWEEN '2021-09-01' and '2021-12-31' and aluno_id=$idaluno ");

    $quantidade_falta3=0;
    foreach ($res_fre_t3 as $key => $value) {
      $quantidade_falta3=$value['quantidade'];
    }

    //echo "$quantidade_falta3";
    echo "-";

  ?>

<o:p></o:p></span></p>
  </td>

  <td width=47 nowrap style='width:35.0pt;border:solid windowtext 1.0pt;
    mso-border-alt:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
    background:white;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
    <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
    line-height:normal'><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
    mso-fareast-font-family:"Times New Roman";color:#000000;mso-fareast-language:
    PT-BR'>

<?php echo  ($nota_tri_1 + $nota_tri_2 + $nota_tri_3 );?>
    <o:p></o:p></span></p>
  </td>
  


  <td width=47 nowrap style='width:35.0pt;border:solid windowtext 1.0pt;
    mso-border-alt:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
    background:white;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
    <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
    line-height:normal'><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
    mso-fareast-font-family:"Times New Roman";color:#000000;mso-fareast-language:
    PT-BR'>

<?php 
$media_final=  round( ($nota_tri_1 + $nota_tri_2 + $nota_tri_3 )/3 ,2);
//echo "$media_final";


if ($media_final <5 ) {
  //$resultado_final=false;
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

              echo number_format($media_final, 1, '.', ',');
          }

//buscar concelho
}else{

  echo"".number_format($media_final, 1, '.','') ;
}
?>

    <o:p></o:p></span></p>
  </td>

  <td width=47 nowrap style='width:35.0pt;border:solid windowtext 1.0pt;
    mso-border-alt:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
    background:white;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
    <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
    line-height:normal'><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
    mso-fareast-font-family:"Times New Roman";color:#000000;mso-fareast-language:
    PT-BR'>
<?php 
    // echo ($quantidade_falta1+$quantidade_falta2+$quantidade_falta3);
     echo "-";
 ?>
  <o:p></o:p></span></p>
  </td>


  <td width=111 nowrap valign=bottom style='width:82.95pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext 1.0pt;mso-border-top-alt:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <?php 

    if ($media_final<5) {
   
      $res_conselho=buscar_aprovar_concelho($conexao,$idescola,$idturma,$iddisciplina,$idaluno);
      $conta_aprovado=count($res_conselho);
      
       if ($conta_aprovado>0 ) {
          $media_conselho=5.0;
          $resultado_conselho=true;

          //echo "<b>".number_format($media_conselho, 1, '.', ',')."</b>";

              echo "<font color='blue'>APC</font>";

      }else{
         
      echo "<font color='red'>REPROVADO</font>";

          // echo number_format($media_final, 1, '.', ',');
      }
      // echo "<font color='red'>REPROVADO</font>";

    }else{
      echo "<font color='blue'>APROVADO</font>";

    }

   ?>
  </td>


  <td width=326 nowrap valign=bottom style='width:244.75pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-top-alt:solid windowtext 1.0pt;mso-border-bottom-alt:
  solid windowtext .5pt;mso-border-right-alt:solid windowtext 1.0pt;padding:
  0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
  "Times New Roman";color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
  </td>
 </tr>




 <?php 
    }//else

    $conta_aluno++;
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
