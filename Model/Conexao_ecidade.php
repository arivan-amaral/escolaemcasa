<?php

error_reporting(E_ALL); 
ini_set('display_errors', '1');


function conecta(){  
    try {
      $pdo = new PDO("pgsql:dbname='xdg'; host='200.223.86.171'; user='postgres'; password='p5qDCK5s2v^';port='5432'"); 
      $pdo->exec( "select fc_startsession();" );
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $pdo;
    } catch (PDOException $e){
      echo "Erros: " . $e->getMessage();
    }
}
 
$pdo = conecta();
if(!$pdo) die ("Não foi possível conectar ao banco. Tente novamente.");


function listar_alunos($pdo){  
  try {
      $stmt = $pdo->prepare("SELECT * FROM matricula limit 1");
      $stmt->execute();

      $resultado = $stmt->fetchAll();
      return $resultado;

    } catch (PDOException $e){
      echo $e->getMessage();
    }
}


//Conexão ao banco de destino
// function conecta2(){
//   try {
//     $pdo2 = new PDO("pgsql:dbname='xdg'; host='200.223.86.171'; user='postgres'; password='OMiTioNAnt';port='5432'"); 
//     $pdo2->exec( "select fc_startsession();" );                                                                          
//     $pdo2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                                                      
//     return $pdo2;                                                                                                        
//   } catch (PDOException $e){                                                                                                
//     echo "Erro: " . $e->getMessage();
//   }
// }

//Conecta no banco de dados de origem
// $pdo = conecta();
// if(!$pdo) {
//   die ("Não foi possível conectar ao banco de origem! Tente novamente.");
// }else{
//   pg_set_client_encoding($pdo, 'LATIN1');
// }

//Conecta no banco de dados destino
// $pdo2 = conecta2();
// if(!$pdo2) {
//   die ("Não foi possível conectar ao banco de destino! Tente novamente.");
// }
//else{
//   pg_set_client_encoding($pdo2, 'LATIN1');
// }

// echo "<br>\n Exeucanto atualização de Dados! ...<br>\n";

//Recebe os dados do banco de origem
// $recencemantos = Rec($pdo,$tabela);

//Atualiza os registros na base de destino
function updatealunos($pdo2, $dados,$id){
  try{
    $stmt = $pdo->prepare("UPDATE aluno SET ed47_v_ender= :ed47_v_ender, ed47_v_compl= :ed47_v_compl, ed47_v_bairro= :ed47_v_bairro, ed47_v_cep= :ed47_v_cep, ed47_c_numero= :ed47_c_numero WHERE ed47_i_codigo = :id");
    $stmt->execute(array(
        "ed47_v_ender"   => $dados["ed47_v_ender"],
        "ed47_v_compl"   => $dados["ed47_v_compl"],
        "ed47_v_bairro"  => $dados["ed47_v_bairro"],
        "ed47_v_cep"     => $dados["ed47_v_cep"],
        "ed47_c_numero"  => $dados["ed47_c_numero"]
      ));
    return ($stmt->rowCount() > 0) ? $stmt : false;
  } catch(PDOExpcetion $e){
    echo "Erro: " . $e->getMessage();
  }
}

//Pega cada registro da tabela de ORIGEM e atualiza na tabela de DESTINO
// $total = 0;
// foreach($recencemantos as $recencemanto){
//   $dados['ed47_v_ender']  = $recencemanto->ed47_v_ender;
//   $dados['ed47_v_compl']  = $recencemanto->ed47_v_compl;
//   $dados['ed47_v_bairro'] = $recencemanto->ed47_v_bairro ;
//   $dados['ed47_v_cep']    = $recencemanto->ed47_v_cep;
//   $dados['ed47_c_numero'] = $recencemanto->ed47_c_numero;

//   if(updatealunos($pdo2, $dados, $id)){
//     $total++;
//     $resultado = "Aluno " . $dados['ed47_i_codigo'] . " atualizado com sucesso.";
//   } else {
//     $resultado = "Aluno " . $dados['ed47_i_codigo'] . " não pode ser atualizado. Favor verificar.";
//     gravar_arquivo($arqlog, $resultado);
//     die('Erro! Favor verificar.');
//   }
//   echo "<br>\n" . $resultado . "<br>\n";  

// }

// $echo "<br>\n" 'Total atualizado: ' . $total . "<br>\n";  
// echo "<br>"."<br>";

?>