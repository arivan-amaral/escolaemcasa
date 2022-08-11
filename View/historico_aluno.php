<?php 
include_once "../Model/Conexao.php";
include_once "../Model/Disciplina.php";
?>
 <!-- <H1> <font color='red'>PÁGINA EM MANUTENÇÃO</font> </H1><BR> -->

<html>
<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=Generator content="Microsoft Word 15 (filtered)">

</head>

<body lang=PT-BR link=blue vlink="#954F72">

<?php
  include_once'historico.php';
  include_once'../Model/Conexao.php';
  hitorico_aluno($conexao);
?>



</body>
</html>