<?php 
session_start();
try {
include_once"../Controller/Conversao.php";
include_once"../Model/Conexao.php";
include_once"../Model/Coordenador.php";
include_once"../Model/Aluno.php";
include_once"../Model/EScola.php";

include_once"diarioFrequencia_infantil.php";
include_once"diarioFrequencia_fund1.php";
include_once"diarioFrequencia_fund2.php";

include_once"diarioFrequenciaPaginaFinal_infantil.php";
include_once"diarioFrequenciaPaginaFinal_fund1.php";
include_once"diarioFrequenciaPaginaFinal_fund2.php";
 
$ano_letivo=$_SESSION['ano_letivo'];

?>

<html>

<head>
<meta charset="UTF-8">
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=ProgId content=Word.Document>
<meta name=Generator content="Microsoft Word 15">
<meta name=Originator content="Microsoft Word 15">
<link rel=File-List href="pla_arquivos/filelist.xml">
<link rel=Edit-Time-Data href="pla_arquivos/editdata.mso">

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

</style>

<link rel=dataStoreItem href="pla_arquivos/item0001.xml"
target="pla_arquivos/props002.xml">
<link rel=themeData href="pla_arquivos/themedata.thmx">
<link rel=colorSchemeMapping href="pla_arquivos/colorschememapping.xml">

<style type="text/css">
    
        table { page-break-inside:auto }
        tr    { page-break-inside:avoid; page-break-after:auto }
        thead { display:table-header-group }
        tfoot { display:table-footer-group }


    @media print {

        .pagebreak { page-break-before: always; } /* page-break-after works, as well */
      }
</style>
</head>

<body lang=PT-BR style=''>
<!-- <body lang=PT-BR style='tab-interval:35.4pt;word-wrap:break-word' > -->



jhkhkj
</body>
</html>
<?php
} catch (Exception $e) {
    echo "erro: $e";
}
 ?>