<?php 
 session_start();
include '../Model/Conexao.php';

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