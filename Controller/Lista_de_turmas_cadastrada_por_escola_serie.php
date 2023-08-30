<?php
session_start();
    if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
    include("../Model/Turma.php");
    

try {

$serie_id = $_GET["serie_id"];
$escola_id = $_GET["escola_id"];
$turno = $_GET["turno"];
$ano_letivo_vigente=$_SESSION['ano_letivo'];
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
      <td><a class='btn btn-block btn-danger' onclick='alterar_valor_vagas($id,$escola_id,$ano_letivo_vigente,$idturma,$quantidade_vaga,0);'>-</a> </td>
      <td id='quantidade$id'><b>$quantidade_vaga </b></td>   
       <td><a class='btn btn-block btn-success' onclick='alterar_valor_vagas($id,$escola_id,$ano_letivo_vigente,$idturma,$quantidade_vaga,1);'>+</a></td>
      <td><b><a class='btn btn-block btn-danger' onclick='remover_turma_escola($id);'>APAGAR</a></b></td>   
  </tr>   


  ";
}

echo $return;
  
} catch (Exception $e) {
   // echo "Erro ao listar  $e";
}
?>