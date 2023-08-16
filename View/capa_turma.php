<?php 
session_start();
include_once '../Model/Conexao.php';
include_once '../Controller/Conversao.php';
include_once '../Model/Aluno.php';
include_once '../Model/Turma.php';
include_once 'ata_resultado_final_funcao.php';
include_once 'capa_turma_funcao.php';
 
$idescola=$_POST['idescola'];
$idturma=$_POST['idturma'];

 
  $nome_escola=$_POST['nome_escola'];
  $nome_turma=$_POST['nome_turma'];
 

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

 


    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  
</head>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .load {
            width: 100px;
            height: 100px;
            position: absolute;
            top: 30%;
            left: 45%;
            color: blue;
        }
    </style>

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
      @media print{@page {size: landscape}}

</style>

 <body>
 
gerar pdf

 <div class="load"> <i class="fa fa-cog fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> </div>

<div class="content-wrapper" style="min-height: 529px;background-color: white;">
 <section class="content">
    <div class="container-fluid">
<br>



 <!-- <H1> <font color='red'>PÁGINA EM MANUTENÇÃO</font> </H1><BR> -->

 <div class=WordSection1>

 <table class=landscape border=0 cellspacing=0 cellpadding=0  
 style=' border-collapse:collapse;mso-yfti-tbllook:1184;
 mso-padding-alt:0cm 3.5pt 0cm 3.5pt'>

  <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:15.75pt'>
   <td width=83 nowrap rowspan=1 valign=top style='width:62.6pt;border:solid windowtext 1.0pt;
   border-right:none;mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:
   solid windowtext .5pt;mso-border-bottom-alt:solid windowtext .5pt;padding:
   0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
   <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
   line-height:normal'>

   <span style='mso-ignore:vglayout'>
   <table cellpadding=0 cellspacing=0 align=left>
    <tr>
     <td width=11 height=2></td>
    </tr>
    <tr>
     <td></td>
     <td>
      <img width=60 height=75 src="imagens/logo.png"
     v:shapes="Imagem_x0020_2"></td>
    </tr>
   </table>

   </span>
   <span style='mso-ascii-font-family:Calibri;mso-fareast-font-family:
   "Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
   color:black;mso-fareast-language:PT-BR'><o:p>&nbsp;</o:p></span></p>
   </td>

   <td  colspan="12" valign=top style='border:1pt;border:
   solid windowtext 1.0pt;mso-border-top-alt:solid windowtext .5pt;padding:10pt 3.5pt 0cm 3.5pt;
   height:15.75pt; text-align: center;'>
   <p class=MsoNormal style='margin-bottom:9pt;line-height:normal'><b><span
   style='font-size:12.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
   mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
   color:black;mso-fareast-language:PT-BR'><?php echo $_SESSION['ORGAO']; ?><o:p></o:p></span></b></p>

     <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
     style='font-size:12.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
     mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
     color:black;mso-fareast-language:PT-BR'><?php echo "$nome_escola"; ?><o:p></o:p></span></b></p>
     <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
     style='font-size:12.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
     mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
     color:black;mso-fareast-language:PT-BR'>TURMA: <?php echo "$nome_turma"; ?><o:p></o:p></span></b></p>

 
   <br>
   </td>
  </tr>

<?php 
                                      
$idescola=$_POST['idescola'];
$idturma=$_POST['idturma'];

  capa_turma($conexao,$idescola,$idturma);
   
?>
</table>

</div>
<br>

<center>
<footer class="no-print">
  <i class="fa fa-print"></i>
  <a href='#'class="btn  btn-primary " onclick='print();'>IMPRIMIR</a> <br><br>
</footer>
</center>
    </div>
  </session>
</div>


 <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

    <script>
        //código usando jQuery
        $( document ).ready(function() {
            $('.load').hide();
        });
    </script>
    
</body>
</html>