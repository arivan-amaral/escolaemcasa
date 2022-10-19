<?php session_start();
include'../Model/Conexao.php';
include'../Model/Escola.php';


try {

    $profissional_resposta=$_SESSION['idfuncionario'];
    $idsolicitacao=$_POST["idsolicitacao"];
    $resposta_solicitacao=$_POST["resposta_solicitacao"];
    $matricula_codigo=$_POST["matricula_aluno"];
    $aceita=2;
   
    rejeitar_solicitacao_transferencia($conexao,$profissional_resposta,$idsolicitacao,$resposta_solicitacao,$aceita);

    retornar_aluno_apos_transferencia_rejeitada($conexao,$matricula_codigo);

    echo "Ação concluída";         

} catch (Exception $e) {
   echo "ERRO: $e";
    
}

?>