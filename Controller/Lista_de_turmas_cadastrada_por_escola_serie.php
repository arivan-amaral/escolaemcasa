<?php
session_start();
    include("../Model/Conexao.php");
    include("../Model/Turma.php");
    

try {

$serie_id = $_GET["serie_id"];
$escola_id = $_GET["escola_id"];
$turno = $_GET["turno"];
$ano_letivo_vigente=$_SESSION['ano_letivo_vigente'];
$result=lista_de_turmas_das_escolas($conexao,$serie_id,$escola_id,$turno,$ano_letivo_vigente);
 
$return="      
";
foreach ($result as $key => $value) {
  $id = $value['id'];
  $idturma=$value['idturma'];
  $nome_turma=$value['nome_turma'];
  $ano=$value['ano'];
  $nome_escola=$value['nome_escola'];
  $turno=$value['turno'];
  $quantidade_vaga=$value['quantidade_vaga'];
  $return.="
  <tr class='table-primary' >
      <td><b>$nome_escola</b></td>   
      <td><b class='text-danger'>$turno</b></td>   
      <td></td>   
      <td><b>$nome_turma</b></td>   
      <td><b>$ano</b></td>   
      <td><b>$quantidade_vaga</b></td>   
      <td><b><a class='btn btn-block btn-danger' onclick='remover_turma_escola($id);'>APAGAR</a></b></td>   
  </tr>   


  ";
}

echo $return;
  
} catch (Exception $e) {
   // echo "Erro ao listar  $e";
}
?>