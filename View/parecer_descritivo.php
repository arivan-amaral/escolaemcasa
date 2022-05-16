<?php 
session_start();
include_once"../Model/Conexao.php";
include_once"../Model/Escola.php";
include_once"parecere_descritivo_cheche.php";
  include"../Controller/Conversao.php";
  include"../Model/Coordenador.php";
  include"../Model/Aluno.php";
 
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
$nome_disciplina='';

  // $res_alunos=listar_aluno_da_turma_professor($conexao,$idturma,$idescola);
  // 
  
  if ($_SESSION['ano_letivo']==$_SESSION['ano_letivo_vigente']) {
    $res_alunos=listar_aluno_da_turma_ata_resultado_final($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
  }else{
    $res_alunos=listar_aluno_da_turma_ata_resultado_final_matricula_concluida($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
  }

  $conta=1;
  // $res_alunos= listar_aluno_da_turma_ata_resultado_final($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
  foreach ($res_alunos as $key => $value) {
    $idaluno=$value['idaluno'];
    $nome_aluno=$value['nome_aluno'];
    $nome_turma=$value['nome_turma'];
    parecere_descritivo_cheche($conexao,$idescola,$idturma,$idserie,$nome_disciplina,$nome_escola,$nome_aluno,$nome_turma,$idaluno,$_SESSION['ano_letivo']); 
    echo" <br>";
    if ($conta%2==0) {
      echo "<div class='pagebreak'> </div>";
    }
    $conta++;
  }
?>
</body>
</html>

 