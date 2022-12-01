 <?php 
session_start();

include_once '../Model/Conexao.php';
include_once '../Model/Aluno.php';
include '../Controller/Conversao.php';
include '../Model/Escola.php';
include '../Model/Turma.php';
include '../Model/Serie.php';
include '../Model/Coordenador.php';
include '../Model/Estado.php';
$idfuncionario=$_SESSION['idfuncionario'];

$aluno_id=$_POST['aluno_id'];
$escola_id=$_POST['escola_id'];
$turma_id=$_POST['turma_id'];
$serie_id=$_POST['serie_id'];
$nome_aluno=$_POST['nome_aluno'];
$tipo_declaracao=$_POST['tipo_declaracao'];
// $ano=2021;
$ano_letivo=$_POST['ano_letivo_post'];
$status=1;
$idaluno=$_POST['aluno_id'];


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
             ecidade_matricula.matricula_situacao !='CANCELADO'
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

<?php 
  $res_aluno= pesquisar_dados_aluno_por_id($conexao,$aluno_id);
  $nome_aluno='';
    $naturalidade='';
    $uf_naturalidade='';
    $data_nascimento= '';
    $filiacao1='';
    $filiacao2='';
  foreach ($res_aluno as $key => $value) {
    $nome_aluno=$value['nome'];
    $naturalidade=$value['naturalidade'];
    $estado= $value['uf_endereco'];
    /*)if (ctype_digit($cidade_municipio)) {
      $res_nome_cidade = listar_cidade_por_id($conexao,$cidade_municipio);
      foreach ($res_nome_cidade as $keyC => $valueC) {
        $nome_cidade = $valueC['nome'];
      }
    }*/

    
    $localidade_id=$value['localidade'];
    $localidade="";
    $res_estado=listar_estado_por_id($conexao,$localidade_id);
    foreach ($res_estado as $key => $value2) {
      $localidade=$value2['nome'];
    }
    $uf_naturalidade=$value['uf_cartorio'];
    $data_nascimento= converte_data(trim($value['data_nascimento']));
    $filiacao1=$value['filiacao1'];
    $filiacao2=$value['filiacao2'];
  
         $result_ecidade_matricula=$conexao->query("SELECT
                    turma.nome_turma,
                    escola.nome_escola,
                    escola.idescola,
                    serie.nome as 'nome_serie',
                    ecidade_matricula.turno_nome as 'turno_nome',
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
                      ecidade_matricula.aluno_id = $aluno_id and 
                      ecidade_matricula.calendario_ano = $ano_letivo and 
                      ecidade_matricula.turma_id = turma.idturma and 
                      ecidade_matricula.turma_escola = escola.idescola and 
                      ecidade_matricula.turma_escola = $escola_id and 
                      ecidade_matricula.matricula_situacao !='CANCELADO'
                      ORDER by ecidade_matricula.calendario_ano desc");
                       $nome_escola="";
                       $nome_turma="";
                       $nome_serie="";
                       $turno="";
                      foreach ($result_ecidade_matricula as $key => $value) {
                         $nome_escola=$value['nome_escola'];
                         $nome_turma=($value['nome_turma']);
                         $nome_serie=$value['nome_serie'];
                         $turno=$value['turno_nome'];
                      }

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
   color:black;mso-fareast-language:PT-BR'>PREFEITURA LUÍS EDUARDO MAGALHÃES<o:p></o:p></span></b></p>

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









                                  <p class="MsoNormal" style="text-align: center; "><b><span style="font-size: 24pt; line-height: 107%; font-family: " source="" sans="" pro",="" sans-serif;="" background-image:="" initial;="" background-position:="" background-size:="" background-repeat:="" background-attachment:="" background-origin:="" background-clip:="" initial;"=""><br></span></b></p><p class="MsoNormal" style="margin: 0cm 3.25pt 22.55pt 19.6pt; text-indent: -0.5pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"></p><div style="text-align: center; text-indent: -0.666667px;"><span id="docs-internal-guid-06891f45-7fff-4fd8-3fb0-5ef60b2488a1"><span style="font-size: 20pt; font-family: Calibri, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">DECLARAÇÃO DE TERMINALIDADE DA EDUCAÇÃO INFANTIL – ETAPA
                                   <?php 
                                  if ($serie_id==1) {
                                    echo "MATERNAL";
                                  }else{
                                    echo "PRÉ-ESCOLA";
                                  } ?>
                                    
                                  </span></span><br></div><b><span style="font-size: 18pt; font-family: " source="" sans="" pro",="" sans-serif;"="">
                                  <!--[if !supportLineBreakNewLine]--><br>
                                  <!--[endif]--></span></b><span style="font-size: 16pt; font-family: " source="" sans="" pro",="" sans-serif;"=""><o:p></o:p></span><p></p><p class="MsoNormal" align="center" style="margin-top:0cm;margin-right:0cm;margin-bottom:21.3pt;margin-left:15.85pt;text-align:center;"><b><span style="font-size:18.0pt;line-height:107%;sans-serif;"><br></span></b></p><p class="MsoNormal" align="center" style="margin-top:0cm;margin-right:0cm;margin-bottom:21.3pt;margin-left:15.85pt;text-align:center;"><b><span style="font-size:18.0pt;line-height:107%;sans-serif;"><br></span></b></p><p class="MsoNormal" align="center" style="margin-top:0cm;margin-right:0cm;margin-bottom:21.3pt;margin-left:15.85pt;text-align:center;"><b><span style="font-size:18.0pt;line-height:107%;sans-serif;"><br></span></b></p><p class="MsoNormal" align="center" style="margin-top:0cm;margin-right:0cm;margin-bottom:21.3pt;margin-left:15.85pt;text-align:center;"><b><span style="font-size:18.0pt;line-height:107%;sans-serif;"><br></span></b></p>
                                  <p class="MsoNormal" style="margin: 0cm 3.25pt 22.55pt 19.6pt; text-align: justify; text-indent: -0.5pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="font-size: 18pt; font-family: " source="" sans="" pro",="" sans-serif;"=""><span style="background-color: transparent; color: rgb(0, 0, 0); font-family: Calibri, sans-serif; font-size: 18pt; white-space: pre-wrap; text-align: left;">Declaro para fins de comprovação que</span>&nbsp;<?php echo $nome_aluno; ?>,&nbsp;</span><span style="background-color: transparent; color: rgb(0, 0, 0); font-family: Calibri, sans-serif; font-size: 18pt; white-space: pre-wrap; text-align: left;">nascido em <?php echo $data_nascimento; ?>, </span><span style="background-color: transparent; color: rgb(0, 0, 0); font-family: Calibri, sans-serif; font-size: 18pt; white-space: pre-wrap; text-align: left;">filho de     <?php
                                if ($filiacao1 !='' && $filiacao2 !='') {
                                  echo $filiacao1." e ". $filiacao2 ; 
                                }elseif ($filiacao1 !='' && $filiacao2 =='') {
                                  echo $filiacao1."  "; 
                                }elseif ($filiacao1 =='' && $filiacao2 !='') {
                                  echo " ". $filiacao2." "; 
                                }

                                ?>, </span><span style="background-color: transparent; color: rgb(0, 0, 0); font-family: Calibri, sans-serif; font-size: 18pt; white-space: pre-wrap; text-align: left;">concluiu a <?php 
                                   
                                    echo substr($nome_turma, 0, -1);

                                  ?>  no ano letivo 2022, na  <?php echo $nome_escola; ?>. </span><span style="background-color: transparent; color: rgb(0, 0, 0); font-family: Calibri, sans-serif; font-size: 18pt; white-space: pre-wrap;">Estando apto a cursar o 1° ano do Ensino Fundamental.</span></p><p class="MsoNormal" style="margin: 0cm 3.25pt 22.55pt 19.6pt; text-align: justify; text-indent: -0.5pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="font-size: 18pt; font-family: " source="" sans="" pro",="" sans-serif;"=""><b><br></b></span></p>
                   
                   <p class="MsoNormal" style="margin: 0cm 3.25pt 22.55pt 19.6pt; text-align: justify; text-indent: -0.5pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="font-size: 18pt; font-family:  sans-serif;"><b><br></b></span></p><p class="MsoNormal" style="margin: 0cm 3.25pt 22.55pt 19.6pt; text-align: justify; text-indent: -0.5pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><br></p><p class="MsoNormal" style="margin: 0cm 3.25pt 22.55pt 19.6pt; text-align: justify; text-indent: -0.5pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><br></p>

     
    <p class="MsoNormal" style="margin-top:0cm;margin-right:3.25pt;margin-bottom:22.55pt;margin-left:19.6pt;text-align:justify;text-justify:inter-ideograph;text-indent:-.5pt;line-height:111%;"><span style="font-size:14.0pt;line-height:111%;font-family:" arial",sans-serif;"=""><b><br></b></span></p><p class="MsoNormal" style="margin-top:0cm;margin-right:3.25pt;margin-bottom:22.55pt;margin-left:19.6pt;text-align:justify;text-justify:inter-ideograph;text-indent:-.5pt;line-height:111%;"><span style="font-size:14.0pt;line-height:111%;font-family:" arial",sans-serif;"=""><b><br></b></span></p><p class="MsoNormal" style="margin-top:0cm;margin-right:3.25pt;margin-bottom:22.55pt;margin-left:19.6pt;text-align:justify;text-justify:inter-ideograph;text-indent:-.5pt;line-height:111%;"><span style="font-size:14.0pt;line-height:111%;font-family:" arial",sans-serif;"=""><b> </b> </span></p><p class="MsoNormal" style="margin-top:0cm;margin-right:3.25pt;margin-bottom:22.55pt;margin-left:19.6pt;text-align:justify;text-justify:inter-ideograph;text-indent:-.5pt;line-height:111%;"></p><div style="text-align: center;"><span style="font-family: Arial, sans-serif; font-size: 9pt; text-indent: -0.5pt;"></span></div><span style="font-family: Arial, sans-serif; font-size: 9pt; text-align: left;"><div style="text-align: center;"><span style="font-size: 14pt; text-indent: -0.5pt;"><!-- OBS.: Declaro que ... --><p></p><p></p>
           

                               <div style="text-align: center;"><span style="font-size: 1rem;"><br></span></div><div style="text-align: center;"><span style="font-size: 1rem;"><br></span></div><div style="text-align: center;"><span style="font-size: 1rem;"><br></span></div><div style="text-align: center;"><span style="font-size: 1rem;"><br></span></div><div style="text-align: center;"><span style="font-size: 1rem;"><br></span></div><div style="text-align: center;"><span style="font-size: 1rem;">______________________________</span></div><div style="text-align: center;"><span style="font-size: 1rem;"><span style="font-family: Arial, sans-serif; font-size: 9pt; text-indent: -0.5pt;">Luís Eduardo Magalhães, <?php echo date("d/m/Y"); ?> </span></span></div><p></p><p><br></p>
                                  </span></div></span>
                                  <center>
                                    
                                  <footer class="no-print">
                                    <i class="fa fa-print"></i>
                                    <a href='#'class="btn btn-primary " onclick='print();'>IMPRIMIR</a> <br><br>
                                  </footer>
                                  </center>
</p>
</td>
</tr>
</table>
</div>



</div>
</section>
</div>



</body>
</html>







</body>
</html>