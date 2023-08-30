<?php
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Questionario.php';
    $id=$_GET['id'];
    $data=$_GET['data'];
    $data_final=$_GET['data_fim'];
    
try {
	$resultado=alterar_data_questionario($conexao,$id,$data,$data_final);
	
	echo "certo";

} catch (Exception $e) {
	echo "erro";
	
}

?>