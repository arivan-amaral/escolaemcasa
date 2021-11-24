<?php 
include_once '../Model/Conexao.php';
include_once '../Model/Aluno.php';
include_once 'ata_resultado_final_funcao.php';
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

<link rel=themeData href="regitro_conteudo_arquivos/themedata.thmx">
<link rel=colorSchemeMapping
href="regitro_conteudo_arquivos/colorschememapping.xml">

<style>

    
      @media print {
          body {
            background: none;
            -ms-zoom: 1.665;
          }
          div.portrait, div.landscape {
            margin-left: 100;
          
            padding: 0;
            border: none;
            background: none;
            size: 4in 6in landscape;
          }
          div.landscape {
            transform: rotate(270deg) translate(-220mm, 0);
            transform-origin: 0 0;
          }

        }

   

        table { page-break-inside:auto }
        tr    { page-break-inside:avoid; page-break-after:auto }
        thead { display:table-header-group }
        tfoot { display:table-footer-group }


    @media print {

        .pagebreak { page-break-before: always; } /* page-break-after works, as well */
      }

</style>

 
  
</head>

<body lang=PT-BR  >

 <H1> <font color='red'>PÁGINA EM MANUTENÇÃO</font> </H1><BR>

<?php 

  ata_resultados_finais($conexao);
?>

</body>
</html>