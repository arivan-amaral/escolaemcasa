<?php
session_start();
    include("Model/Conexao.php");

    

try {
if (isset($_GET['tokem_arivan'])) {
  // code...
$res=$conexao->query("SELECT professor_id FROM funcionario,ministrada, turma WHERE  
professor_id=idfuncionario and 
ministrada.turma_id = idturma and 
ministrada.escola_id >0
 group by professor_id ");


// $res=$conexao->query("SELECT professor_id FROM funcionario,ministrada, turma WHERE  
// professor_id=idfuncionario and 
// ministrada.turma_id = idturma and 
// serie_id <3 and 
// (
// descricao_funcao ='Professor' or descricao_funcao ='Professora'
// )
//  group by professor_id ");



  $conta=1;
  foreach ($res as $key => $value) {
    $funcionario_id=$value['professor_id'];
    for ($i=8; $i <= 8; $i++) { 
      //$conexao->exec("DELETE FROM bloquear_acesso where funcionario_id=$funcionario_id and calendario_letivo_id=4 ");
      echo "INSERT INTO bloquear_acesso(funcionario_id, calendario_letivo_id, funcionario_responsavel) VALUES ($funcionario_id, $i, 175)";
       // $conexao->exec("INSERT INTO bloquear_acesso(funcionario_id, calendario_letivo_id, funcionario_responsavel) VALUES ($funcionario_id, $i, 175) ");
      // code...
    }
     
    echo"$conta - id: $funcionario_id <br>";
    $conta++;
  }
     
}
  
} catch (Exception $e) {
    echo "Erro:  $e";
}
?>