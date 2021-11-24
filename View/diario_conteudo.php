<?php 
include_once"../Model/Conexao.php";
include_once"../Model/Escola.php";
include_once"conteudos_registrados.php";


    $data_inicio_trimestre1="2021-05-03";
    $data_fim_trimestre1="2021-07-09";
    

    $data_inicio_trimestre2="2021-07-27";
    $data_fim_trimestre2="2021-10-01";

    $data_inicio_trimestre3="2021-10-04";
    $data_fim_trimestre3="2021-12-21";
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

</style>

</head>

<body lang=PT-BR style='tab-interval:35.4pt;word-wrap:break-word'>



<?php
$idescola=$_GET['idescola'];
$idturma=$_GET['idturma'];
$idserie=$_GET['idserie'];
$nome_escola="";
$res=buscar_escola_por_id($conexao,$idescola);
foreach ($res as $key => $value) {
    $nome_escola=$value['nome_escola'];
}
$pes=listar_disciplina_da_turma($conexao,$idturma,$idescola);

foreach ($pes as $chave => $linha) {
  $nome_disciplina=($linha['nome_disciplina']);
  $iddisciplina=$linha['iddisciplina'];
  $nome_professor=$linha['nome'];
  $nome_turma=$linha['nome_turma'];
  diario_conteudo($conexao,$idescola,$idturma,$iddisciplina,$idserie,$nome_disciplina,$nome_professor,$nome_turma,$nome_escola,$data_inicio_trimestre1,$data_fim_trimestre1,"I TRIMESTRE"); 
  echo "<br>";
  diario_conteudo($conexao,$idescola,$idturma,$iddisciplina,$idserie,$nome_disciplina,$nome_professor,$nome_turma,$nome_escola,$data_inicio_trimestre2,$data_fim_trimestre2,"II TRIMESTRE"); 
  echo" <br>";

  diario_conteudo($conexao,$idescola,$idturma,$iddisciplina,$idserie,$nome_disciplina,$nome_professor,$nome_turma,$nome_escola,$data_inicio_trimestre3,$data_fim_trimestre3,"III TRIMESTRE"); 
  echo" <br>";
}




 ?>

 </body>

</html>