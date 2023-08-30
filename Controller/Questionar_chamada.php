<?php
session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once "../Model/Chamada.php";
try {

    $chamada = $_GET['chamada'];
    $funcionario=$_GET['funcionario'];
    $setor=$_GET['setor'];
    $mensagem=$_GET['mensagem'];
    $data =date('Y-m-d');

    $res_chamada =  pesquisar_chamado($conexao,$chamada);
    foreach ($res_chamada as $key => $value) {
    	$resposta = $value['func_respondeu_id'];
    	if($resposta == 0){
    		questionar_chamado($conexao,$chamada,0,$data,$mensagem,$setor);
	    }else{
	    	
	    	questionar_chamado($conexao,$chamada,$funcionario,$data,$mensagem,0);
	    }
    }
    
    

   
    
    
} catch (Exception $exc) {

    //echo $exc;
}
?>