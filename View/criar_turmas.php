<?php
  include '../Model/Conexao.php';
  $res=$conexao->query("SELECT * FROM serie  where id >2 and id <12");
  foreach ($res as $key => $value) {
  	$nome_serie=$value['nome'];
  	$serie_id=$value['id'];

  	$alfabeto = array(
  		'1' => "A",
  		'2' => "B",
  		'3' => "C",
  		'4' => "D",
  		'5' => "E",
  		'6' => "F",
  		'7' => "G",
  		'8' => "H",
  		'9' => "I",
  		'10' => "J",
  		'11' => "K",
  		'12' => "L",
  		'13' => "M",
  		'14' => "N",
  		'15' => "O",
  		'16' => "P",
  		'17' => "Q",
  		'18' => "R",
  		'19' => "S",
  		'20' => "T",
  		'21' => "U",
  		'22' => "V",
  		'23' => "W",
  		'24' => "X",
  		'25' => "Y",
  		'26' => "Z",
  		
  		 );
  	foreach ($alfabeto as $value2) {
  		$nome_turma=$nome_serie." ".$value2;
      $nome_turma=str_replace("º", '', $nome_turma);
      $nome_turma=strtoupper($nome_turma);
  		$conexao->exec("INSERT INTO turma (nome_turma,serie_id)VALUES('$nome_turma',$serie_id)");
  	}
  }
?>

