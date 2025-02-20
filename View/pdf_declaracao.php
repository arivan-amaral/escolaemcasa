 <?php
 session_start(); 
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Aluno.php';
$idaluno=$_POST['aluno_id'];
$ano_letivo=$_POST['ano_letivo'];

$texto_declaracao=$_POST['texto_declaracao'];
$nome_escola="";
$nome_turma="";
$nome_aluno="";


$result_ecidade_matricula=$conexao->query("SELECT
           turma.nome_turma,
           escola.nome_escola,
           escola.idescola,
           serie.nome as 'nome_serie',
           ecidade_matricula.matricula_codigo as 'matricula',
           ecidade_matricula.matricula_datamatricula as 'data_matricula',
           ecidade_matricula.datasaida as 'datasaida',
           ecidade_matricula.turma_escola as 'idescola',
           ecidade_matricula.turma_id as 'idturma',
           turma.serie_id as 'idserie',
           ecidade_matricula.calendario_ano as 'calendario_ano'

           FROM
             ecidade_matricula,
             turma,escola,serie
           where
       
             turma.serie_id = serie.id and 
             ecidade_matricula.aluno_id = $idaluno and 
             ecidade_matricula.calendario_ano = $ano_letivo and 
             ecidade_matricula.turma_id = turma.idturma and 
             ecidade_matricula.turma_escola = escola.idescola and 
             ecidade_matricula.matricula_ativa ='S' and turma.serie_id !=17
             ORDER by ecidade_matricula.calendario_ano desc");
              $nome_escola="";
              $nome_turma="";
              $nome_serie="";
             foreach ($result_ecidade_matricula as $key => $value) {
                $nome_escola=$value['nome_escola'];
                $nome_turma=($value['nome_turma']);
                $nome_serie=$value['nome_serie'];
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

@media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }


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

<body lang=PT-BR  >



 </head>

 <body>

<div class="content-wrapper" style="min-height: 529px;">
 <section class="content">
    <div class="container-fluid" style="border: 3px solid black;">
<br>
 <!-- <H1 class="no-print"> <font color='red'>PÁGINA EM MANUTENÇÃO</font> </H1><BR> -->

 <div class=WordSection1>

 <table>

  <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:15.75pt'>
   <td width='100%' nowrap rowspan=1 valign=top style='width:102.6pt;border:solid windowtext 1.0pt;
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
      <img width=90 height=105 src="imagens/logo.png">
    </td>
    </tr>
   </table>

   </span>
   <span style='mso-ascii-font-family:Calibri;mso-fareast-font-family:
   "Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
   color:black;mso-fareast-language:PT-BR'><o:p>&nbsp;</o:p></span></p>
   </td>

   <td  colspan="12" valign=top style='border:1pt;border:
   solid windowtext 1.0pt;mso-border-top-alt:solid windowtext .5pt;padding:9pt 3.5pt 0cm 3.5pt;text-align: center;
   height:15.75pt'>
   <p class=MsoNormal style='margin-bottom:5pt;line-height:normal'><b><span
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

  <!--  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
   style='font-size:10.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
   mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
   color:black;mso-fareast-language:PT-BR'>ESCOLAONEROCOSTA@HOTMAIL.COM - 
   <a
   href="http://luiseduardomagalhaes.ba.gov.br/">http://luiseduardomagalhaes.ba.gov.br/</a><o:p></o:p></span></b></p> -->
   <br>
   </td>
  </tr>
  <tr>
  <td colspan="2" >
    <br>
    <br>
    <br>
    <br>
  <p class="text-justify">

<?php
  echo "$texto_declaracao";
?>
</p>
</td>
</tr>
</table>
</div>

<center>
  
<footer class="no-print">
  <i class="fa fa-print"></i>
  <a href='#'class="btn btn-primary " onclick='print();'>IMPRIMIR</a> <br><br>
</footer>
</center>

</div>
</section>
</div>

</body>
</html>






<script type="text/javascript">
  

   window.html2canvas = html2canvas;

   function demoFromHTML() {

     const html_source = document.getElementById('employee_detail'); // O id do elemento que contém o Html que quer imprimir.
     const filename = 'boletim.pdf';


     html2canvas(html_source).then(function(canvas) {
       /*
       [210,297] Sao os números (largura e altura do papel a4) que eu encontrei para trabalhar com eles.
       Se você puder encontrar números oficiais do jsPDF, usa.
        */
       let imgData = canvas.toDataURL('image/png');
       let imgWidth = 220; // Largura em mm de um a4
       let pageHeight = 297; // Altura em mm de um a4

       let imgHeight = canvas.height * imgWidth / canvas.width;
       let heightLeft = imgHeight;
       let position = 15;
       let pdf = new jsPDF('p', 'mm');
       let fix_imgWidth = 25; // Vai subindo e descendo esses valores ate ficar como queres
       let fix_imgHeight = 10; // Vai subindo e descendo esses valores ate ficar como queres

       pdf.addImage(imgData, 'PNG', 20, position, imgWidth, imgHeight);
       heightLeft -= pageHeight;

       while (heightLeft >= 0) {
         position = heightLeft - imgHeight;
         pdf.addPage();
         pdf.addImage(imgData, 'PNG', 15, position, imgWidth + fix_imgWidth, imgHeight + fix_imgHeight);
         heightLeft -= pageHeight;
       }

       pdf.save(filename);
     })

   }

</script>

</body>
</html>