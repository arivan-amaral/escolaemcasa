<?php
session_start();
    include("Model/Conexao.php");

    

try {
  $escola_id= $_GET['escola_id'];
 $calendario_letivo_id= $_GET['calendario_letivo_id'];
if (isset($_GET['tokem_arivan'])) {
  // code...
$res=$conexao->query("SELECT professor_id FROM funcionario,ministrada, turma WHERE  
professor_id=idfuncionario and 
ministrada.turma_id = idturma and 
ministrada.escola_id = $escola_id and 
(
descricao_funcao ='Professor' or descricao_funcao ='Professora'
)
 group by professor_id ");


// $res=$conexao->query("SELECT professor_id FROM funcionario,ministrada, turma WHERE  
// professor_id=idfuncionario and 
// ministrada.turma_id = idturma and 
// ministrada.escola_id = 10 and 
// serie_id <3 and 
// (
// descricao_funcao ='Professor' or descricao_funcao ='Professora'
// )
//  group by professor_id ");



  $conta=1;
  foreach ($res as $key => $value) {
    $funcionario_id=$value['professor_id'];
    
      $conexao->exec("DELETE FROM bloquear_acesso where funcionario_id=$funcionario_id and calendario_letivo_id= $calendario_letivo_id");
      // code...
    echo"$conta - id: $funcionario_id <br>";
    $conta++;
    }
     
  }
     

  
} catch (Exception $e) {
    echo "Erro:  $e";
}
?>