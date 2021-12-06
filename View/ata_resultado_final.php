<?php 
include_once '../Model/Conexao.php';
include_once '../Model/Aluno.php';
include_once '../Model/Turma.php';
include_once 'ata_resultado_final_funcao.php';
 
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

<style>

    
  

        table { page-break-inside:auto }
        tr    { page-break-inside:avoid; page-break-after:auto }
        thead { display:table-header-group }
        tfoot { display:table-footer-group }


      @media print {
        .pagebreak { page-break-before: always; } /* page-break-after works, as well */
      }

</style>

    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  
</head>


 </head>

 <body>

<div class="content-wrapper" style="min-height: 529px;background-color: white;">
 <section class="content">
    <div class="container-fluid">
<br>

 <H1> <font color='red'>PÁGINA EM MANUTENÇÃO</font> </H1><BR>

 <div class=WordSection1>

 <table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 
  style='width: 80%;'>

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
   color:black;mso-fareast-language:PT-BR'>PREFEITURA LUÍS EDUARDO MAGALHÃES<o:p></o:p></span></b></p>

     <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
     style='font-size:12.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
     mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
     color:black;mso-fareast-language:PT-BR'><?php echo "$nome_escola"; ?><o:p></o:p></span></b></p>
     <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
     style='font-size:12.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
     mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
     color:black;mso-fareast-language:PT-BR'>TURMA: <?php echo "$nome_turma"; ?><o:p></o:p></span></b></p>

   <!-- <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
   style='font-size:12.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
   mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
   color:black;mso-fareast-language:PT-BR'>JOÃO DOURADO, 230 - STA. CRUZ
   3628-4233 LUIS EDUARDO MAGALHÃES<o:p></o:p></span></b></p> -->

<!--    <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
   style='font-size:10.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
   mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
   color:black;mso-fareast-language:PT-BR'>ESCOLAONEROCOSTA@HOTMAIL.COM - 
   <a
   href="http://luiseduardomagalhaes.ba.gov.br/">http://luiseduardomagalhaes.ba.gov.br/</a><o:p></o:p></span></b></p> -->
   <br>
   </td>
  </tr>

<?php 
                                      
$idescola=$_POST['idescola'];
$idturma=$_POST['idturma'];

  ata_resultados_finais($conexao,$idescola,$idturma);
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
</body>
</html>