<?php
session_start();
    include("/Model/Conexao.php");

    

try {
if (isset($_GET['tokem_arivan'])) {
  // code...
$res=$conexao->query("SELECT * FROM funcionario WHERE descricao_funcao !='Coordenador' and  descricao_funcao =='Professor' or descricao_funcao =='Professora' ");
  $conta=1;
  foreach ($res as $key => $value) {
    $funcionario_id=$value['idfuncionario'];
   
    $conexao->exec("INSERT INTO bloquear_acesso(funcionario_id, calendario_letivo_id, funcionario_responsavel) VALUES ($funcionario_id, 1, 175) ");
    $conexao->exec("INSERT INTO bloquear_acesso(funcionario_id, calendario_letivo_id, funcionario_responsavel) VALUES ($funcionario_id, 2, 175) "); 
    $conexao->exec("INSERT INTO bloquear_acesso(funcionario_id, calendario_letivo_id, funcionario_responsavel) VALUES ($funcionario_id, 3, 175) ");
    echo"$conta - id: $funcionario_id <br>";
    $conta++;
  }
     
}
  
} catch (Exception $e) {
    echo "Erro:  $e";
}
?>