<?php 
session_start();
set_time_limit(0);
include_once "../Model/Conexao.php";
include_once "../Model/Disciplina.php";

include_once '../Model/Escola.php';
include_once '../Model/Aluno.php';
include_once '../Controller/Cauculos_notas.php';


  include_once'historico.php';
 
  include_once'../Model/Nota.php';
?>
 <!-- <H1> <font color='red'>PÁGINA EM MANUTENÇÃO</font> </H1><BR> -->

<html>
<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=Generator content="Microsoft Word 15 (filtered)">

<style type="text/css">
  
  .form-submit-button {

background: #0066A2;

color: white;

border-style: outset;

border-color: #0066A2;

height: 5%;

width: 100%;

font: bold 15px arial, sans-serif;

text-shadow:none;

}

@media print {
      .no-print, .no-print *
      {
          display: none !important;
      }
        .pagebreak { page-break-before: always; } /* page-break-after works, as well */
    }

</style>

</head>

<body lang=PT-BR link=blue vlink="#954F72">
<p class="no-print">
  <br>
  <br>
  
<a href='#'class="form-submit-button" onclick='print();'>IMPRIMIR</a> 

</p>
<?php
try {
  

  $idaluno=$_GET['idaluno'];
  $idserie=$_GET['idserie'];
  $idescola=$_GET['idescola'];



if ($_SESSION['nivel_acesso_id']>0) {
  for ($ano_conta=2021; $ano_conta <= date("Y") ; $ano_conta++) { 
    $resultado=registrar_sistema_atual_nota_historico($conexao, $idaluno, $ano_conta); 
    foreach ($resultado as $key => $value) {
      $idescola=$value['idescola'];
      $idturma=$value['idturma'];
      $idserie=$value['idserie'];
      $matricula=$value['matricula'];
      $calendario_ano=$value['calendario_ano'];
      $matricula_situacao=$value['matricula_situacao'];
      $res_displina=$conexao->query("SELECT * FROM disciplina where facultativo =0 and infantil=0");
      foreach ($res_displina as $key_dis => $value_dis) {
        $iddisciplina=$value_dis['iddisciplina'];
         $media=gerar_media_ata($conexao,$idescola,$idturma,$iddisciplina,$idaluno,$ano_conta,$idserie);
      }
    }

  }
}


  hitorico_aluno($conexao,$idaluno,$idserie,$idescola);
  } catch (Exception $e) {
    echo "Divergência de dados encontrada: $e";
    
  }
?>



</body>
</html>