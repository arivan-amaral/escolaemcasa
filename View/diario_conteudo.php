<?php
session_start();
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

 
  
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

 



</head>

<body lang=PT-BR style=''>



<?php
$idescola=$_GET['idescola'];
$idturma=$_GET['idturma'];
$idserie=$_GET['idserie'];
$nome_escola="";
$res=buscar_escola_por_id($conexao,$idescola);
foreach ($res as $key => $value) {
    $nome_escola=$value['nome_escola'];
}
$pes=listar_disciplina_da_turma($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);

foreach ($pes as $chave => $linha) {
  $nome_disciplina=($linha['nome_disciplina']);
  $iddisciplina=$linha['iddisciplina'];
  $nome_professor=$linha['nome'];
  $nome_turma=$linha['nome_turma'];
  diario_conteudo($conexao,$idescola,$idturma,$iddisciplina,$idserie,$nome_disciplina,$nome_professor,$nome_turma,$nome_escola,$data_inicio_trimestre1,$data_fim_trimestre1,"I TRIMESTRE"); 


    echo "<div class='pagebreak'> </div>";


  diario_conteudo($conexao,$idescola,$idturma,$iddisciplina,$idserie,$nome_disciplina,$nome_professor,$nome_turma,$nome_escola,$data_inicio_trimestre2,$data_fim_trimestre2,"II TRIMESTRE"); 


    echo "<div class='pagebreak'> </div>";


  diario_conteudo($conexao,$idescola,$idturma,$iddisciplina,$idserie,$nome_disciplina,$nome_professor,$nome_turma,$nome_escola,$data_inicio_trimestre3,$data_fim_trimestre3,"III TRIMESTRE"); 


    echo "<div class='pagebreak'> </div>";

}




 ?>

 </body>

</html>