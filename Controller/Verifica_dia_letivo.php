<?php
	session_start();
    if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
    include("Conversao.php");
    include("../Model/Escola.php");
   
    

try {
    $professor_id=$_SESSION['idfuncionario'];
    $data=$_GET['data'];
    $verifica_dia=verifica_dia_letivo($conexao,$data);
    if (count($verifica_dia)>0) {
        echo converte_data($data);
    }else{
        echo "certo";
    }

} catch (Exception $e) {
   echo "Erro: $e";

}
?>