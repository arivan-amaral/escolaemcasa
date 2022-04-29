<?php 
session_start();
include_once '../Model/Conexao.php';
include_once '../Model/Turma.php';
 try {
 $aceitar_idescola_destino=$_GET['aceitar_idescola_destino'];
 $aceitar_idserie_destino=$_GET['aceitar_idserie_destino'];
 $aceitar_ano_letivo=$_GET['aceitar_ano_letivo'];
 $aceitar_turno=$_GET['aceitar_turno'];
  $idsolicitacao=$_GET['idsolicitacao'];

      $result=lista_de_turmas_das_escolas_rematricula($conexao,$aceitar_idserie_destino,$aceitar_idescola_destino,$aceitar_turno,$aceitar_ano_letivo);

      $return="<option></option>";
      foreach ($result as $key => $value) {
        $idturma=$value['idturma'];
        $nome_turma=$value['nome_turma'];
        $return.="<option value='$idturma'> $nome_turma</option>";
      }
      echo "$return";
 
 	
 } catch (Exception $e) {
 	echo "ERRO:  $e";
 	
 }

?>