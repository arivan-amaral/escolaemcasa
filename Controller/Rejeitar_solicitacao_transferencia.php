<?php session_start();
include'../Model/Conexao.php';
include'../Model/Escola.php';


try {

    $profissional_resposta=$_SESSION['idfuncionario'];
    $idsolicitacao=$_POST["idsolicitacao"];
    $resposta_solicitacao=$_POST["resposta_solicitacao"];
    $aceita=2;
   
    rejeitar_solicitacao_transferencia($conexao,$profissional_resposta,$idsolicitacao,$resposta_solicitacao,$aceita);

    echo "Ação concluída";         

} catch (Exception $e) {
   echo "ERRO: $e";
    
}

?>