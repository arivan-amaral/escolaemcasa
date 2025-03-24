<?php 
 session_start();
 if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
    $idfuncionario = $_SESSION['idfuncionario'];

include_once "../Model/Conexao_".$usuariobd.".php";
 include_once '../Model/Aluno.php';
 include_once 'Conversao.php';
 include_once '../Model/Escola.php';
 
try {
  $id=$_GET['id'];
  $status=$_GET['status'];
  $acao="Status lista de espera alterado status para $status pelo usuário $idfuncionario";
    aceitar_lista_espera($conexao,$id,$status);
    registrarLog($conexao, $idfuncionario, $acao);

 
} catch (Exception $e) {
    echo "errado $e";
}
?>