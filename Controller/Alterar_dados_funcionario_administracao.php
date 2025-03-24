<?php 
 session_start();
 if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
 include_once '../Model/Professor.php';
 include_once '../Model/Escola.php';
 
 try {
$idfuncionario=$_POST['idfuncionario'];

$nome=$_POST['nome'];
$email=$_POST['email'];
$senha=$_POST['senha'];
$whatsapp=$_POST['whatsapp'];



    alterar_dados_professor($conexao,$nome, $email, $senha,$whatsapp,$idfuncionario);
      $acao="Alterado  $nome, $email, $senha,$whatsapp,$idfuncionario  por $idfuncionario";
    registrarLog($conexao, $idfuncionario, $acao);
    
 	$_SESSION['status']=1;
    header("Location:../View/pesquisar_professor_associar.php?status=1");
} catch (Exception $e) {
	$_SESSION['status']=0;
    echo"$e";
    header("../View/pesquisar_professor_associar.php?status=0");
 }
?>