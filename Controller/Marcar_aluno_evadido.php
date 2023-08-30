<?php 
 session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";

 try {
$idfuncionario=$_SESSION['idfuncionario'];

$matricula=$_GET['matricula'];
$matricula_situacao=$_GET['matricula_situacao'];

$conexao->exec("UPDATE ecidade_matricula set matricula_situacao='$matricula_situacao' WHERE matricula_codigo=$matricula ");
echo "certo";

} catch (Exception $e) {
    echo "$e";
}
?>