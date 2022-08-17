<?php
session_start();
include "../Model/Conexao.php";
include "../Model/Chamada.php";
try {
	$verificar =0;
	$texto = "visite a pagina chamados questionados encontra no menu chamados.
    CHAMADAS QUESTIONADAS PELO SECRETARIO  Protocolos:";
    $funcionario=$_SESSION["idfuncionario"];
    $res = verificar_atraso($conexao,$funcionario);
    foreach ($res as $key => $value) {
    	$protocolo = $value['id_chamada'];
    	$res_verificar = pesquisa_chamada($conexao,$protocolo);
    	foreach ($res_verificar as $key => $value) {
    		$status = $value['status'];
    		if($status== 'atrasado'){
    			$texto.="  | ".$protocolo;
    			$verificar++;
    		}
    	}
    }
    if ($verificar > 0) {
    	echo $texto;
    }else{
    	echo "nada";
    }
   	
} catch (Exception $exc) {

    echo $exc;
}
?>