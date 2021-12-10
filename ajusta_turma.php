<?php
include 'Model/Conexao.php';
// ajusta_turma.php
 set_time_limit(0);
try {
     
if(isset($_GET['tokem_arivan'])){

$res=$conexao->query("SELECT historico_nota.id, serie.nome, escola.nome_escola FROM historico_nota, serie, turma ,escola WHERE 
historico_nota.escola_id = escola.idescola and 
historico_nota.turma_id = turma.idturma AND
turma.serie_id = serie.id AND 
serie.id !=7 AND serie.id !=11 and serie.id !=15 and serie.id !=13 ");
foreach ($res as $key => $value) {
  $id=$value['id'];
  $conexao->query("DELETE FROM historico_nota  where id = $id ");
echo "tokem_arivan <br>";
}
}

// $res=$conexao->query("SELECT * FROM ecidade_matricula where turma_id IS NULL limit 0,80000 ");
//  foreach ($res as $key => $value) {
//      $matricula_codigo=$value['matricula_codigo'];
     
//      $res_2=$conexao->query("SELECT * FROM ecidade_movimentacao_escolar
//       where  matricula_codigo=$matricula_codigo limit 1");
//      $idturma="";
//       foreach ($res_2 as $key2 => $value2) {
//           $idturma=$value2['turma_id'];
//       }
//           if($idturma!=''){
//           $conexao->exec("UPDATE ecidade_matricula set turma_id=$idturma where matricula_codigo=$matricula_codigo ");
//                echo "UPDATE ecidade_matricula set turma_id=$idturma where matricula_codigo=$matricula_codigo ; <br>";
//           }
     

//  }


} catch (Exception $e) {
 echo $e;    
}