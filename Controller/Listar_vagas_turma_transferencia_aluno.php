<?php
session_start();
include_once '../Model/Conexao.php';
include_once '../Model/Turma.php';
include_once '../Model/Aluno.php';



try {
  $idescola=$_GET['escola'];
  $idserie=$_GET['serie'];
  $ano_letivo_vigente=$_SESSION["ano_letivo_vigente"];
  
$result="<div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>TURMAS NA ESCOLA ESCOLHIDA</h3>

         
              </div>
          
              <div class='card-body table-responsive p-0' style='height: 300px;'>
                <table class='table table-head-fixed text-nowrap'>
                  <thead>
                    <tr>
                      <th>Escola</th>
                      <th>Turma</th>
                      <th>Turno</th>
                      <th>Qnt vagas na turma</th>
                      
                    </tr>
                  </thead>
                  <tbody>";
                 $res= listar_turma_turno_escola($conexao,$idescola,$idserie);
                 $conta_turma =0;
                 foreach ($res as $key => $value) {
                    $nome_escola=$value['nome_escola'];
                    $nome_turma=$value['nome_turma'];
                    $idturma=$value['idturma'];
                    $turno=$value['turno'];
                    $quantidade_vaga_restante=0;
                   
                    $res_quantidade= quantidade_vaga_turma($conexao,$idescola,$idturma,$turno,$ano_letivo_vigente);
                      $quantidade_vaga_total=0;
                       foreach ($res_quantidade as $key => $value) {
                          $quantidade_vaga_total=$value['quantidade_vaga'];
                       }


                       $res_quantidade_vaga_restante= quantidade_aluno_na_turma($conexao,$idescola,$idturma,$turno,$ano_letivo_vigente);
                       $quantidade_vaga_restante=0;
                       foreach ($res_quantidade_vaga_restante as $key => $value) {
                          $quantidade_vaga_restante=$value['quantidade'];
                       }
                    $quantidade_vaga_restante=$quantidade_vaga_total-$quantidade_vaga_restante;



                    $result.="<tr>
                      <td>$nome_escola</td>
                      <td>$nome_turma</td>
                      <td>$turno</td>
                      <td>$quantidade_vaga_restante</td>
                    </tr>";
                    $conta_turma++;
                 }
                 if ($conta_turma==0) {
                    $result.="<tr>
                      <td colspan='100%'><b class='text-danger'>A ESCOLA NÃO POSSUI VAGA PARA ESSA SÉRIE</b></td>
                       
                    </tr>";
                 }



                $result.=" 
                </tbody>
                </table>
              </div>
  
            </div>
     
          </div>
        </div>";

echo "$result";
} catch (Exception $e) {
  echo "Erro ao carregar, verifique sua conexão com a internet".$e;
}

?>

