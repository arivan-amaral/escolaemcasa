<?php
session_start();
include_once '../Model/Conexao.php';
include '../Model/Escola.php';


try {

    $texto = $_GET['texto'];
    $parametro = $_GET['parametro'];
    $titulo = $_GET['titulo'];
    $escola = $_GET['escola'];
    $sexo = $_GET['sexo'];
    $ano_letivo = $_SESSION['ano_letivo'];

    $titulos = explode ("-", $titulo);
    $parametros = explode ("-", $parametro);
    $result="
   <thead>
      <tr>
      ";
         $result.="<th  style='text-align: center;'>#</th>";

      foreach ($titulos as $key => $value) {
         $result.="<th  style='text-align: center;'>".$titulos[$key]."</th>";
      }
        
        
    $result.="</tr>
    </thead>
    <tbody>
    ";

    $conta=1;
    $tamanho = count($parametros);
    $result.="<tr>";
    if($sexo == "todos"){
    $res_matriculas = pesquisa_relatorio_filtro_todos($conexao,$texto,$escola,$ano_letivo);
        
         
          foreach ($res_matriculas as $key => $value) {
                $result.="<td>$conta</td>";

              for ($i=0; $i < $tamanho; $i++) { 
                $dado = $value[$parametros[$i]];
                $result.="<td>$dado</td>";
              }
              $result.="</tr>";
              $conta++;
              
          }
    }else{
       $res_matriculas = pesquisa_relatorio_filtro($conexao,$texto,$sexo,$escola,$ano_letivo);
    
     
      foreach ($res_matriculas as $key => $value) {
            $result.="<td>$conta</td>";

          for ($i=0; $i < $tamanho; $i++) { 
            $dado = $value[$parametros[$i]];
            $result.="<td>$dado</td>";
          }
          $result.="</tr>";
          $conta++;
          
      }
    }
     
     
      if ($conta==1) {

        $result.="<tr> <td> NADA ENCONTRADO </td> </tr>";
      }
    
   

    
    
$result.="</tbody>";



echo "$result";
    
} catch (Exception $exc) {
   //echo " VERIFIQUE SUA CONEXÃO COM A INTERNET";
   echo $exc;
}
?>