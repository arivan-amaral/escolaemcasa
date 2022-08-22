<?php
session_start();
include "../Model/Conexao.php";
include "../Model/Chamada.php";
try {
	$verificar =0;
	$texto = "";
    $funcionario=$_SESSION["idfuncionario"];
    if($_SESSION["idfuncionario"] != 1179){
        $res_id_setor =  buscar_id_setor($conexao,$funcionario);
        foreach ($res_id_setor as $key => $value) {
          $setor = $value['setor_id'];
          $res_setor = verificar_atraso_setor($conexao,$setor);
          $id_passado = 0;
            foreach ($res_setor as $key => $value) {
                $protocolo = $value['id_chamada'];
                $mensagem = $value['mensagem'];
                $res_verificar = pesquisa_chamada($conexao,$protocolo);
                foreach ($res_verificar as $key => $value) {
                    $status = $value['status'];
                    if($status== 'atrasado'){
                        if($id_passado !=$protocolo){
                            $texto.=" Mensagem do secretario - protocolo ".$protocolo.": ";
                            $texto.="".$mensagem."";
                            $verificar++;
                        }
                        
                    }
                }
            }
        }
    
        $res = verificar_atraso($conexao,$funcionario);
        foreach ($res as $key => $value) {
            $protocolo = $value['id_chamada'];
            $mensagem = $value['mensagem'];
            $res_verificar = pesquisa_chamada($conexao,$protocolo);
            foreach ($res_verificar as $key => $value) {
                $status = $value['status'];
                if($status== 'atrasado'){
                    $texto.=" Mensagem do secretario - protocolo ".$protocolo.": ";
                    $texto.="".$mensagem."";
                    $verificar++;
                }
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