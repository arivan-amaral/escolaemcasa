<?php
session_start();
    include("Model/Conexao.php");

    

try {
 
$res=$conexao->query("SELECT * from dadod_src ");

  foreach ($res as $key => $value) {
    
    $nome=trim($value['nome']);
    $nome=strtoupper($nome);
    $res_real=$conexao->query("SELECT idfuncionario, nome, count(*) as quantidade from dados_reais_src where nome like '$nome' ");
     // echo "SELECT idfuncionario, nome, count(*) as quantidade from dados_reais_src where nome like '$nome' <br>";
    foreach ($res_real as $key_r => $value_r) {
      $id=trim($value_r['idfuncionario']);
      $nome_real=trim($value_r['nome']);
      $nome_real=strtoupper($nome_real);

      $quantidade=$value_r['quantidade'];

  
       if ($quantidade==1){
        //echo "$quantidade UPDATE  dadod_src SET idreal = $id where nome like '$nome' <br>";
          $conexao->exec("UPDATE  dadod_src SET idreal = $id where nome like '$nome_real'");
       }

    }
  }
} catch (Exception $e) {
    echo "Erro:  $e";
}
?>