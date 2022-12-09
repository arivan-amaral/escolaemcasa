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
include_once 'declaracao_termino_pre.php';

$idfuncionario=$_SESSION['idfuncionario'];




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
	<center>
	  
	<footer class="no-print">
	  <i class="fa fa-print"></i>
	  <a href='#'class="btn btn-block btn-primary " onclick='print();'>IMPRIMIR</a> <br><br>
	</footer>
	</center>
<?php 	
// foreach ($_POST['idaluno'] as $key => $value) {
$turma_id=$_POST['turma_id'];
$serie_id=$_POST['serie_id'];
$ano_letivo=$_SESSION['ano_letivo_vigente'];
$status=1;
if (isset($_POST['escola_id_origem'])) {
		$escola_id=$_POST['escola_id_origem'];
}else{
		$escola_id=$_POST['escola_id'];

}if (isset($_POST['idturma'])) {
		$turma_id=$_POST['idturma'];
}else{
		$turma_id=$_POST['turma_id'];

}

 
foreach ($_POST['idaluno'] as $key => $value) {
		$aluno_id=$_POST['idaluno'][$key];
   gerar_declaracao_terminalidade($conexao, $aluno_id, $escola_id, $turma_id, $serie_id,$ano_letivo);
   echo "	<div class='no-print'><br><br><br><br><br><br><br><br></div>
";
}

?>
 </body>
 </html>