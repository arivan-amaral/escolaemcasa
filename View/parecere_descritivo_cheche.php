<?php
  include"../Controller/Conversao.php";
  include"../Model/Coordenador.php";
  include"../Model/Aluno.php";
 
 function parecere_descritivo_cheche($conexao,$idescola,$idturma,$iddisciplina,$idserie,$nome_escola,$nome_aluno,$nome_turma,$idaluno){
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
<link rel=File-List href="regitro_conteudo_arquivos/filelist.xml">
<link rel=Edit-Time-Data href="regitro_conteudo_arquivos/editdata.mso">

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

<link rel=themeData href="regitro_conteudo_arquivos/themedata.thmx">
<link rel=colorSchemeMapping
href="regitro_conteudo_arquivos/colorschememapping.xml">

<style>
<!--
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
-->
</style>

</head>

<body lang=PT-BR style='tab-interval:35.4pt;word-wrap:break-word'>

<div class=WordSection1>

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=936
 style='width:701.7pt;border-collapse:collapse;mso-yfti-tbllook:1184;
 mso-padding-alt:0cm 3.5pt 0cm 3.5pt'>

 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:20.25pt'>
  <td width=936 nowrap colspan=7 valign=bottom style='width:701.7pt;border:
  solid windowtext 1.0pt;border-bottom:none;mso-border-top-alt:solid windowtext .5pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:20.25pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:20.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'><b>PREFEITURA DE LUIS EDUARDO MAGALHÃES</b></span><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR;mso-no-proof:yes'> </span>

  <span style='mso-ignore:vglayout;
  position:absolute;z-index:251660288;left:0px;margin-left:15px;margin-top:
  9px;width:49px;height:53px'><img width=49 height=53
  src="regitro_conteudo_arquivos/image002.jpg" v:shapes="Imagem_x0020_2"></span><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1;height:15.0pt'>
  <td width=936 colspan=7 style='width:701.7pt;border-top:none;border-left:
  solid windowtext 1.0pt;border-bottom:none;border-right:solid windowtext 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:15.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'><b>SECRETARIA MUNICIPAL DE EDUCAÇÃO</b><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2;height:18.75pt'>
  <td width=936 colspan=7 style='width:701.7pt;border-top:none;border-left:
  solid windowtext 1.0pt;border-bottom:none;border-right:solid windowtext 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:18.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:16.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'><b>OBJETOS DE CONHECIMENTOS</b><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3;height:15.0pt'>
  <td width=936 colspan=7 style='width:701.7pt;border-top:none;border-left:
  solid windowtext 1.0pt;border-bottom:none;border-right:solid windowtext 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:14.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4;height:15.0pt'>
  <td width=936 colspan=7 valign=bottom style='width:701.7pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:12.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'><b>ESCOLA MUNICIPAL: <?php echo"$nome_escola"; ?></b> <o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5;height:15.0pt'>
  <td width=936 colspan=7 valign=bottom style='width:701.7pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:12.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'><b>PERÍODO 2021</b><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6;height:15.0pt'>
    <td width=161 colspan=2 valign=bottom style='width:120.5pt;border:solid windowtext 1.0pt;
      border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
      padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
      <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
      style='font-size:12.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
      mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
      color:black;mso-fareast-language:PT-BR'><b>ANO:</b><span style='mso-spacerun:yes'>
      </span><o:p></o:p></span></p>
    </td>
  <td width=406 colspan=2 valign=bottom style='width:304.75pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:12.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'><b>TURMA: <?php echo"$nome_turma"; ?></b> <o:p></o:p></span></p>
  </td>
  <td width=369 colspan=3 valign=bottom style='width:276.45pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'><b>TURNO:</b><span
  style='mso-spacerun:yes'></span><o:p></o:p></span></p>
  </td> 

</tr>

<tr style='mso-yfti-irow:6;height:15.0pt'>
   <td width=406 colspan=2 valign=bottom style='width:304.75pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:12.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'><b>ALUNO: <?php echo"$nome_aluno"; ?></b> <o:p></o:p></span></p>
  </td>

 </tr>




 <tr style='mso-yfti-irow:11;height:15.75pt'>
  <td width=400 nowrap colspan=8 style='width:942.5pt;border:solid windowtext 1.0pt;
  border-right:solid black 1.0pt;background:#D9D9D9;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
  mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
  PT-BR'>PARECER DESCRITIVO - DIAGNÓSTICO INICIAL<o:p></o:p></span></b></p>
  </td>
  <td width=8 style='width:6.1pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'></td>
 </tr>
 <tr style='mso-yfti-irow:12;height:15.75pt'>
  <td width=400 nowrap colspan=8 valign=bottom style='width:942.5pt;
  border-top:none;border-left:solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;
  border-right:solid black 1.0pt;mso-border-top-alt:solid windowtext 1.0pt;
  mso-border-top-alt:windowtext 1.0pt;mso-border-left-alt:windowtext 1.0pt;
  mso-border-bottom-alt:windowtext .5pt;mso-border-right-alt:black 1.0pt;
  mso-border-style-alt:solid;background:white;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.75pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
  "Times New Roman";color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p>
    <?php 
    $parecer_descritivo='';
    $pes=listar_disciplina_da_turma($conexao,$idturma,$idescola);

    foreach ($pes as $chave => $linha) {
      $iddisciplina=$linha['iddisciplina'];
      $resultado=listar_todas_avaliacao_lancada_parecer($conexao,$idescola,$idturma,$iddisciplina,'DIAGNÓSTICO INICIAL',$idaluno,6);
      foreach ($resultado as $key => $value) {
        $parecer_descritivo=$value['parecer_descritivo'];
      }
    }
      echo "$parecer_descritivo";

    ?>
  </o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:11;height:15.75pt'>
  <td width=400 nowrap colspan=8 style='width:942.5pt;border:solid windowtext 1.0pt;
  border-right:solid black 1.0pt;background:#D9D9D9;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
  mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
  PT-BR'>PARECER DESCRITIVO - 1º TRIMESTRE DIDÁTICO<o:p></o:p></span></b></p>
  </td>
  <td width=8 style='width:6.1pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'></td>
 </tr>
 <tr style='mso-yfti-irow:12;height:15.75pt'>
  <td width=400 nowrap colspan=8 valign=bottom style='width:942.5pt;
  border-top:none;border-left:solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;
  border-right:solid black 1.0pt;mso-border-top-alt:solid windowtext 1.0pt;
  mso-border-top-alt:windowtext 1.0pt;mso-border-left-alt:windowtext 1.0pt;
  mso-border-bottom-alt:windowtext .5pt;mso-border-right-alt:black 1.0pt;
  mso-border-style-alt:solid;background:white;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.75pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
  "Times New Roman";color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p>

    <?php 
    $parecer_descritivo='';
    // $pes=listar_disciplina_da_turma($conexao,$idturma,$idescola);

    // foreach ($pes as $chave => $linha) {
    //   $iddisciplina=$linha['iddisciplina'];
    //   $resultado=listar_todas_avaliacao_lancada_parecer($conexao,$idescola,$idturma,$iddisciplina,'av1',$idaluno);
    //   foreach ($resultado as $key => $value) {
    //     $parecer_descritivo="".$value['parecer_descritivo'];
    //   }
    
    // }   
 
    // $pes2=listar_disciplina_da_turma($conexao,$idturma,$idescola);
    // foreach ($pes2 as $chave => $linha) {
    //   $iddisciplina=$linha['iddisciplina'];
    //   $resultado=listar_todas_avaliacao_lancada_parecer($conexao,$idescola,$idturma,$iddisciplina,'av2',$idaluno);
    //   foreach ($resultado as $key => $value) {
    //     $parecer_descritivo.=". ".$value['parecer_descritivo'];
    //   }
    
    // }


    $pes3=listar_disciplina_da_turma($conexao,$idturma,$idescola);
    foreach ($pes3 as $chave => $linha) {
      $iddisciplina=$linha['iddisciplina'];
      $resultado=listar_todas_avaliacao_lancada_parecer($conexao,$idescola,$idturma,$iddisciplina,'av3',$idaluno,1);
      foreach ($resultado as $key => $value) {
        $parecer_descritivo=" ".$value['parecer_descritivo'];
      }
    
    }


    if ($parecer_descritivo=="") {
      $pes_pare=listar_disciplina_da_turma($conexao,$idturma,$idescola);
      foreach ($pes_pare as $chave => $linha) {
        $iddisciplina=$linha['iddisciplina'];
        $resultado=listar_todas_avaliacao_lancada_parecer($conexao,$idescola,$idturma,$iddisciplina,'av1',$idaluno,1);
        foreach ($resultado as $key => $value) {
          $parecer_descritivo=" ".$value['parecer_descritivo'];
        }
      
      }

    }
echo ".$parecer_descritivo";

    ?>
  </o:p></span></p>
  </td>
 </tr>

 <tr style='mso-yfti-irow:11;height:15.75pt'>
  <td width=400 nowrap colspan=8 style='width:942.5pt;border:solid windowtext 1.0pt;
  border-right:solid black 1.0pt;background:#D9D9D9;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
  mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
  PT-BR'>PARECER DESCRITIVO - 2º TRIMESTRE DIDÁTICO<o:p></o:p></span></b></p>
  </td>
  <td width=8 style='width:6.1pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'></td>
 </tr>
 <tr style='mso-yfti-irow:12;height:15.75pt'>
  <td width=400 nowrap colspan=8 valign=bottom style='width:942.5pt;
  border-top:none;border-left:solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;
  border-right:solid black 1.0pt;mso-border-top-alt:solid windowtext 1.0pt;
  mso-border-top-alt:windowtext 1.0pt;mso-border-left-alt:windowtext 1.0pt;
  mso-border-bottom-alt:windowtext .5pt;mso-border-right-alt:black 1.0pt;
  mso-border-style-alt:solid;background:white;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.75pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
  "Times New Roman";color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p> 

<?php 

    $parecer_descritivo="";
    $pes_periodo2=listar_disciplina_da_turma($conexao,$idturma,$idescola);
    foreach ($pes_periodo2 as $chave => $linha) {
      $iddisciplina=$linha['iddisciplina'];
      $resultado=listar_todas_avaliacao_lancada_parecer($conexao,$idescola,$idturma,$iddisciplina,'av3',$idaluno,2);
      foreach ($resultado as $key => $value) {
        $parecer_descritivo=$value['parecer_descritivo'];
      }
    
    }


    if ($parecer_descritivo=="") {
      $pes_pare=listar_disciplina_da_turma($conexao,$idturma,$idescola);
      foreach ($pes_pare as $chave => $linha) {
        $iddisciplina=$linha['iddisciplina'];
        $resultado=listar_todas_avaliacao_lancada_parecer($conexao,$idescola,$idturma,$iddisciplina,'av1',$idaluno,2);
        foreach ($resultado as $key => $value) {
          $parecer_descritivo=" ".$value['parecer_descritivo'];
        }
      
      }

    }

echo "$parecer_descritivo";
?>
  </o:p></span></p>
  </td>
 </tr>

 <tr style='mso-yfti-irow:11;height:15.75pt'>
  <td width=400 nowrap colspan=8 style='width:942.5pt;border:solid windowtext 1.0pt;
  border-right:solid black 1.0pt;background:#D9D9D9;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
  mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
  PT-BR'>PARECER DESCRITIVO - 3º TRIMESTRE DIDÁTICO<o:p></o:p></span></b></p>
  </td>
  <td width=8 style='width:6.1pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'></td>
 </tr>
 <tr style='mso-yfti-irow:12;height:15.75pt'>
  <td width=400 nowrap colspan=8 valign=bottom style='width:942.5pt;
  border-top:none;border-left:solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;
  border-right:solid black 1.0pt;mso-border-top-alt:solid windowtext 1.0pt;
  mso-border-top-alt:windowtext 1.0pt;mso-border-left-alt:windowtext 1.0pt;
  mso-border-bottom-alt:windowtext .5pt;mso-border-right-alt:black 1.0pt;
  mso-border-style-alt:solid;background:white;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.75pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
  "Times New Roman";color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p>

    <?php 

          $parecer_descritivo="";
        $pes_periodo3=listar_disciplina_da_turma($conexao,$idturma,$idescola);
        foreach ($pes_periodo3 as $chave => $linha) {
          $iddisciplina=$linha['iddisciplina'];
          $resultado=listar_todas_avaliacao_lancada_parecer($conexao,$idescola,$idturma,$iddisciplina,'av3',$idaluno,3);
          foreach ($resultado as $key => $value) {
            $parecer_descritivo=" ".$value['parecer_descritivo'];
          }
        
        }

        if ($parecer_descritivo=="") {
          $pes_pare=listar_disciplina_da_turma($conexao,$idturma,$idescola);
          foreach ($pes_pare as $chave => $linha) {
            $iddisciplina=$linha['iddisciplina'];
            $resultado=listar_todas_avaliacao_lancada_parecer($conexao,$idescola,$idturma,$iddisciplina,'av1',$idaluno,3);
            foreach ($resultado as $key => $value) {
              $parecer_descritivo=" ".$value['parecer_descritivo'];
            }
          
          }

        }

    echo "$parecer_descritivo";
    ?>
   </o:p></span></p>
  </td>
 </tr>

</table>

<p class=MsoNormal><o:p>&nbsp;</o:p></p>

</div>

</body>

</html>

<?php 
  }
?>