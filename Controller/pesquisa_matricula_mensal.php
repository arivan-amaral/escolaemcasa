<?php
session_start();
include '../Model/Conexao.php';
include '../Model/Escola.php';


try {

    $data_inicial = $_GET['data_inicial'];
    $data_final = $_GET['data_final'];
    $escola = $_GET['escola'];
    $ano_letivo = $_SESSION['ano_letivo'];

    
    $result="
   <thead>
      <tr>
        <th  style='text-align: center;'>Turma</th>
        <th  style='text-align: center;'>Série</th>
        <th  style='text-align: center;'>Anteriores</th>
        <th  style='text-align: center;'>Novas</th>
        <th  style='text-align: center;'>Total</th>
      </tr>
    </thead>
    <tbody>
    ";

    $conta=0;

    if ( $data_inicial != "") {
       $res_matriculas = pesquisa_matricula_mensal($conexao,$escola,$_SESSION["ano_letivo"]);
      $id_turma_passado = 0;
      $total_alunos = 0;
      $total_alunos_escola = 0;
      $total_matriculas = 0;
      foreach ($res_matriculas as $key => $value) {
          $turma = $value['turma_id'];
          $quant_matriculas = 0;
          $quant_total = 0;
          $nome_serie = "";
          $nome_turma = "";
          if ($id_turma_passado !=  $turma) {
            $res_anterior = pesquisa_matricula_mensal_quant_anterior($conexao,$escola,$turma,$ano_letivo);
            foreach ($res_anterior as $key => $value) {
              $quant_total = $value['alunos'];
            }
            $res_matriculas_quant = pesquisa_matricula_mensal_quant($conexao,$data_inicial,$data_final,$escola,$turma);
                  foreach ($res_matriculas_quant as $key => $value) {
                      $quant_matriculas = $value['alunos'];
                  }
          $res_turma = pesquisa_turma($conexao,$turma);
          foreach ($res_turma as $key => $value) {             
                $serie_id = $value['serie_id'];
                $nome_turma = $value['nome_turma'];
                $res_nome_serie = pesquisa_serie($conexao,$serie_id);
                foreach ($res_nome_serie as $key => $value) {
                    $nome_serie = $value['nome'];
                }  
            }
          $quant_anterior =  $quant_total - $quant_matriculas;
          
          $result.="<td>$nome_turma</td>";
          $result.="<td>$nome_serie</td>";
          $result.="<td>$quant_anterior</td>";
          $result.="<td>$quant_matriculas</td>";
          $result.="<td>$quant_total</td>";
          $result.="</tr>";
          $id_turma_passado = $turma;
          }
          
          $total_alunos += $quant_total;
          $total_matriculas += $quant_matriculas;
          $conta++;
      }
      
      if ($conta==0) {

        $result.="<tr> <td> NADA ENCONTRADO </td> </tr>";
      }
    }
   

    
    
$result.="</tbody>";
$res_total_aluno_escola = total_alunos_escola($conexao,$escola);
foreach ($res_total_aluno_escola as $key => $value) {
  $total_alunos_escola = $value['alunos'];
}
$result.="<br>
  <div class='row'>
    <div class='col-sm-12'>
      <h5>TOTAL ALUNOS POR TURMAS: $total_alunos</h5>
    </div>
  </div>
  <br>
  <div class='row'>
    <div class='col-sm-12'>
      <h5>TOTAL ALUNOS NA ESCOLA: $total_alunos_escola</h5>
    </div>
  </div>
  <br>
  <div class='row'>
    <div class='col-sm-12'>
      <h5>TOTAL MATRICULAS NOVAS: $total_matriculas</h5>
    </div>
  </div>";

echo "$result";
    
} catch (Exception $exc) {
   //echo " VERIFIQUE SUA CONEXÃO COM A INTERNET";
   echo $exc;
}
?>