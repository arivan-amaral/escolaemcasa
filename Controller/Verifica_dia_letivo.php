<?php
	session_start();
    include("../Model/Conexao.php");
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