<?php
session_start();
include_once"../Model/Conexao.php";
include_once"../Model/Escola.php";
include"../Controller/Conversao.php";
include"../Model/Coordenador.php";
include"../Model/Aluno.php";
include"../Model/Professor.php";

include_once"conteudos_registrados_infantil.php";
include_once"conteudos_registrados_fund1.php";
include_once"conteudos_registrados_fund2.php";
 
 $ano_letivo=$_SESSION['ano_letivo'];


     $data_inicio_trimestre1="";
     $data_fim_trimestre1="";

     $data_inicio_trimestre2="";
     $data_fim_trimestre2="";
     
     $data_inicio_trimestre3="";
     $data_fim_trimestre3="";
  
  
  $res_calendario=listar_data_periodo($conexao,$ano_letivo);
  foreach ($res_calendario as $key => $value) {
  
      if ($value['periodo_id']==1) {
          $data_inicio_trimestre1=$value['inicio'];
          $data_fim_trimestre1=$value['fim'];
      }elseif ($value['periodo_id']==2){
          $data_inicio_trimestre2=$value['inicio'];
          $data_fim_trimestre2=$value['fim'];
      }elseif ($value['periodo_id']==3){
          $data_inicio_trimestre3=$value['inicio'];
          $data_fim_trimestre3=$value['fim'];
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


    @media print {
      .no-print, .no-print *
      {
          display: none !important;
      }
        .pagebreak { page-break-before: always; } /* page-break-after works, as well */
    }

  
  .button {
    width: 100%;
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    background-color: #008CBA;

  } /* Blue */

</style>

 
  
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

 



</head>

<body lang=PT-BR style=''>

<p class="no-print">
  <br>
  <br>
  
<a href='#'class="btn btn-block btn-primary button " onclick='print();'>IMPRIMIR</a> 

</p>

<?php
$idescola=$_GET['idescola'];
$idturma=$_GET['idturma'];
$idserie=$_GET['idserie'];
$nome_escola="";
$res=buscar_escola_por_id($conexao,$idescola);
foreach ($res as $key => $value) {
    $nome_escola=$value['nome_escola'];
}

 
if ($idserie <3) {
// echo " <h1><font color='red'> PÁGINA EM MANUTEÇÃO</font> </H1>";
// 
// 
  $nome_professor= " ";

  $res=listar_nome_professor_turma_ministrada($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
  // listar_nome_professor_turma($conexao,$idaluno,$_SESSION['ano_letivo']);
  // $res=listar_nome_professor_turma($conexao,$idaluno,$_SESSION['ano_letivo']);
  $conta_virgula=0;

  foreach ($res as $key => $value) {
    if($conta_virgula>0){
      $nome_professor.= ", ";
    }
   $nome_professor.= $value['nome_professor'];
   $conta_virgula++;
  }
  $nome_professor.= ".";
  
    $pes=listar_disciplina_da_turma($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
      $nome_disciplina="";
      // $nome_professor="";
      $nome_turma="";

    foreach ($pes as $chave => $linha) {
      $nome_disciplina=($linha['nome_disciplina']);
      $iddisciplina=$linha['iddisciplina'];
      // $nome_professor=$linha['nome'];
      $nome_turma=$linha['nome_turma'];
    }


    diario_conteudo_infantil($conexao,$idescola,$idturma,$idserie,$iddisciplina, $nome_professor,$nome_turma,$nome_escola,$data_inicio_trimestre1,$data_fim_trimestre1,"I TRIMESTRE",$ano_letivo);
    
   
     echo "<div class='pagebreak'> </div>";


   diario_conteudo_infantil($conexao,$idescola,$idturma,$idserie,$iddisciplina, $nome_professor,$nome_turma,$nome_escola,$data_inicio_trimestre2,$data_fim_trimestre2,"II TRIMESTRE",$ano_letivo); 
     echo "<div class='pagebreak'> </div>";


   diario_conteudo_infantil($conexao,$idescola,$idturma,$idserie,$iddisciplina, $nome_professor,$nome_turma,$nome_escola,$data_inicio_trimestre3,$data_fim_trimestre3,"III TRIMESTRE",$ano_letivo); 
     echo "<div class='pagebreak'> </div>";


}elseif ($idserie>2 && $idserie<8) {

    $pes=listar_disciplina_da_turma($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);

    foreach ($pes as $chave => $linha) {
      $nome_disciplina=($linha['nome_disciplina']);
      $iddisciplina=$linha['iddisciplina'];
      $nome_professor=$linha['nome'];
      $nome_turma=$linha['nome_turma'];

      diario_conteudo_fund1($conexao,$idescola,$idturma,$iddisciplina,$idserie,$nome_disciplina,$nome_professor,$nome_turma,$nome_escola,$data_inicio_trimestre1,$data_fim_trimestre1,"I TRIMESTRE"); 
        echo "<div class='pagebreak'> </div>";


      diario_conteudo_fund1($conexao,$idescola,$idturma,$iddisciplina,$idserie,$nome_disciplina,$nome_professor,$nome_turma,$nome_escola,$data_inicio_trimestre2,$data_fim_trimestre2,"II TRIMESTRE"); 
        echo "<div class='pagebreak'> </div>";


      diario_conteudo_fund1($conexao,$idescola,$idturma,$iddisciplina,$idserie,$nome_disciplina,$nome_professor,$nome_turma,$nome_escola,$data_inicio_trimestre3,$data_fim_trimestre3,"III TRIMESTRE"); 
        echo "<div class='pagebreak'> </div>";
      }
}else{

    $pes=listar_disciplina_da_turma($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
    foreach ($pes as $chave => $linha) {
      $nome_disciplina=($linha['nome_disciplina']);
      $iddisciplina=$linha['iddisciplina'];
      $nome_professor=$linha['nome'];
      $nome_turma=$linha['nome_turma'];
      
      diario_conteudo_fund2($conexao,$idescola,$idturma,$iddisciplina,$idserie,$nome_disciplina,$nome_professor,$nome_turma,$nome_escola,$data_inicio_trimestre1,$data_fim_trimestre1,"I TRIMESTRE"); 
        echo "<div class='pagebreak'> </div>";


      diario_conteudo_fund2($conexao,$idescola,$idturma,$iddisciplina,$idserie,$nome_disciplina,$nome_professor,$nome_turma,$nome_escola,$data_inicio_trimestre2,$data_fim_trimestre2,"II TRIMESTRE"); 
        echo "<div class='pagebreak'> </div>";


      diario_conteudo_fund2($conexao,$idescola,$idturma,$iddisciplina,$idserie,$nome_disciplina,$nome_professor,$nome_turma,$nome_escola,$data_inicio_trimestre3,$data_fim_trimestre3,"III TRIMESTRE"); 
        echo "<div class='pagebreak'> </div>";
    }

}




 ?>

 </body>

</html>