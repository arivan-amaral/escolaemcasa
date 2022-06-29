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

      $idescola = $value['idescola'];
      $nome_escola = $value['nome_escola'];

      $res_matriculas = pesquisa_matricula_mensal($conexao,$data_inicial,$data_final,$escola,$turma);
      foreach ($res_matriculas as $key => $value) {
        $quant_matriculas = $value['alunos']; 
      }
      $result.="<td>$nome_escola</td>";
      $result.="<td>teste</td>";
      $result.="<td>$quant_matriculas</td>";
      $conta++;
    }
    
        

   
          
   
      
      
      
    
    
    if ($conta==0) {

      $result.="<tr> <td> NADA ENCONTRADO </td> </tr>";
    }
}else{
    $res_escola = pesquisa_escola($conexao);
    foreach ($res_escola as $key => $value) {
      

      $idescola = $value['idescola'];
      $nome_escola = $value['nome_escola'];
      $result.="<tr>";
      $res_matriculas = pesquisa_matricula_mensal_todos($conexao,$escola);
      foreach ($res_matriculas as $key => $value) {
        $quant_matriculas = $value['alunos']; 
      }
      $result.="<td>$nome_escola</td>";
      $result.="<td>teste</td>";
      $result.="<td>$quant_matriculas</td>";
     
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