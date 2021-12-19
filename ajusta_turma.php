<?php
include 'Model/Conexao.php';
// ajusta_turma.php
 set_time_limit(0);
try {
     
if(isset($_GET['tokem_arivan'])){
  $inicio=$_GET['pagina'];
  $limite=$_GET['limite'];
// $res=$conexao->query("SELECT historico_nota.id, serie.nome, escola.nome_escola FROM historico_nota, serie, turma ,escola WHERE 
// historico_nota.escola_id = escola.idescola and 
// historico_nota.turma_id = turma.idturma AND
// turma.serie_id = serie.id AND 
// serie.id !=7 AND serie.id !=11 and serie.id !=15 and serie.id !=13 ");
// foreach ($res as $key => $value) {
//   $id=$value['id'];
//   $conexao->query("DELETE FROM historico_nota  where id = $id ");
// echo "tokem_arivan <br>";
// }
// 

echo "<form action='Controller/ajusta_turma.php' method='post'> ";

$res=$conexao->query("SELECT turma_id,matricula_turma,aluno_id,matricula_codigo, turma_descr FROM ecidade_matricula GROUP by matricula_turma  
ORDER BY ecidade_matricula.turma_descr ASC limit $inicio , $limite");
$conta=1;
    $array_cor=array('0' =>'blue' , '1' =>'red' , '2' =>'greem','3' =>'grey');
$nome_tur_aux="";
foreach ($res as $key => $value) {
  $aluno_id=$value['aluno_id'];
  $turma_id=$value['turma_id'];
  $matricula_codigo=$value['matricula_codigo'];
  $matricula_turma=$value['matricula_turma'];
  $turma_descr=$value['turma_descr'];
  if ($nome_tur_aux!= $turma_descr) {
  // if ($conta%10==0) {
    $cor=$array_cor[rand(0,3)];
  }
  $nome_tur_aux=$turma_descr;
      echo "<span style='color:$cor'>$conta | $aluno_id - $matricula_codigo - <b>$matricula_turma - $turma_descr </b> </span> ";
$res_nome_tur=$conexao->query("SELECT * FROM turma order by nome_turma");
$nome_turma_educalem="";
  echo " <input type='hidden' name='matricula_turma[]' value='$matricula_turma'>";
  // required
  echo "<select name='turma_educalem[]' >";
     echo "<option></option>";
foreach ($res_nome_tur as $key => $value) {
  $idturma=$value['idturma'];
  $nome_turma_educalem=$value['nome_turma'];
  if ($turma_id==$idturma) {
     echo "<option value='$idturma' selected>$nome_turma_educalem</option>";
     
  }else{
     echo "<option value='$idturma'>$nome_turma_educalem</option>";

  }

}
  echo "</select> <br>";
  // <b style='color:red'> $nome_turma_educalem</b> <br>";

$conta++;

}


echo "
<input type='submit' value='ENVIAR'>
</form> ";

}




//$res=$conexao->query("SELECT * FROM ecidade_matricula where turma_id IS NULL limit 0,80000 ");
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