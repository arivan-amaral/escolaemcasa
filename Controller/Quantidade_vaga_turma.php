 <?php
session_start();
    include("../Model/Conexao.php");
    include("../Model/Turma.php");
    

try {
  

$serie_id = $_GET["serie_id"];
$escola_id = $_GET["escola_id"];
$turno = $_GET["turno"];
$ano_letivo_vigente=$_SESSION['ano_letivo_vigente'];
$turma_id=0;

if (isset($_GET['turma_id'])) {
  $turma_id=$_GET['turma_id'];
}



   $quantidade_vaga_total=0;
   $quantidade_vaga_restante=0;

     $res_quantidade= quantidade_vaga_turma($conexao,$escola_id,$turma_id,$turno,$ano_letivo_vigente);
     foreach ($res_quantidade as $key => $value) {
        $quantidade_vaga_total=$value['quantidade_vaga'];
     }

     $res_quantidade_vaga_restante= quantidade_aluno_na_turma($conexao,$escola_id,$turma_id,$turno,$ano_letivo_vigente);
     foreach ($res_quantidade_vaga_restante as $key => $value) {
        $quantidade_vaga_restante=$value['quantidade'];
     }
    $quantidade_vaga_restante=$quantidade_vaga_total-$quantidade_vaga_restante;
   

  $return="$quantidade_vaga_total|#|$quantidade_vaga_restante";

  echo $return;
} catch (Exception $e) {
  echo "teste: $e";
}