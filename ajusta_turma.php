<?php
include 'Model/Conexao.php';
// ajusta_turma.php
 set_time_limit(0);
try {
     

$res=$conexao->query("SELECT * FROM ecidade_matricula where turma_id IS NULL limit 0,80000 ");
 foreach ($res as $key => $value) {
     $matricula_codigo=$value['matricula_codigo'];
     
     $res_2=$conexao->query("SELECT * FROM ecidade_movimentacao_escolar
      where  matricula_codigo=$matricula_codigo limit 1");
     $idturma="";
      foreach ($res_2 as $key2 => $value2) {
          $idturma=$value2['turma_id'];
      }
          if($idturma!=''){
          $conexao->exec("UPDATE ecidade_matricula set turma_id=$idturma where matricula_codigo=$matricula_codigo ");
               echo "UPDATE ecidade_matricula set turma_id=$idturma where matricula_codigo=$matricula_codigo ; <br>";
          }
     

 }


} catch (Exception $e) {
 echo $e;    
}