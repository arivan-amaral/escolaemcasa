<?php
session_start();
include '../Model/Conexao.php';
include '../Model/Escola.php';


try {

    $data_inicial = $_GET['data_inicial'];
    $data_final = $_GET['data_final'];

    
    $result="
   <thead>
      <tr>
        <th  style='text-align: center;'>Escola</th>
        <th  style='text-align: center;'>Serie</th>
        <th  style='text-align: center;'>Matriculas</th>
      </tr>
    </thead>
    <tbody>
    ";

    $conta=0;
if ($data_inicial != '') {
    $res_escola = pesquisa_escola($conexao);
    foreach ($res_escola as $key => $value) {
      $result.="<tr>";
      $quant_matriculas = 0;
      $idescola = $value['idescola'];
      $nome_escola = $value['nome_escola'];
      $nome_turma = "";
      $res_matriculas = pesquisa_matricula_mensal($conexao,$data_inicial,$data_final,$idescola);
      
      foreach ($res_matriculas as $key => $value) {
        $turma = $value['turma_id'];
        
        $nome_serie = "";
        $res_matriculas_quant = pesquisa_matricula_mensal_quant($conexao,$data_inicial,$data_final,$idescola,$turma);
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
        
        $result.="<td>$nome_escola</td>";
        //$result.="<td>$nome_turma</td>";
        $result.="<td>$nome_serie</td>";
        $result.="<td>$quant_matriculas</td>";
        $result.="</tr>";
        $conta++;

      }
      
    }
    
    if ($conta==0) {

      $result.="<tr> <td> NADA ENCONTRADO </td> </tr>";
    }
}else{
   
     $res_escola = pesquisa_escola($conexao);
    foreach ($res_escola as $key => $value) {
      $result.="<tr>";
      $quant_matriculas = 0;
      $idescola = $value['idescola'];
      $nome_escola = $value['nome_escola'];
      $nome_turma = "";
      $res_matriculas = pesquisa_matricula_mensal_todos($conexao,$idescola);
      
      foreach ($res_matriculas as $key => $value) {
        $turma = $value['turma_id'];
        
        $nome_serie = "";
        $res_matriculas_quant = pesquisa_matricula_mensal_quant_todos($conexao,$idescola,$turma);
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
        
        $result.="<td>$nome_escola</td>";
        //$result.="<td>$nome_turma</td>";
        $result.="<td>$nome_serie</td>";
        $result.="<td>$quant_matriculas</td>";
        $result.="</tr>";
        $conta++;

      }
      
    }
     
    if ($conta==0) {
        $result.="<tr> <td> NADA ENCONTRADO </td> </tr>";
    }
}
    
    
$result.="</tbody>";
echo "$result";
    
} catch (Exception $exc) {
   //echo " VERIFIQUE SUA CONEXÃO COM A INTERNET";
   echo $exc;
}
?>