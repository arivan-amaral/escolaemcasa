<?php
session_start();
include_once '../Model/Conexao.php';
include '../Model/Escola.php';
include '../Model/Coordenador.php';
include 'Conversao.php';


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
    <table class=table table-bordered table-striped' >
      
           <thead>
              <tr>
                <th>
                    TURMAS
                </th>   <th>
                    TOTAIS 
                </th>
              ";

                
           
                
              $result.="
                
                
                </tr>
            </thead>
            <tbody>";
            
               $res=listar_turmas_inicial_coordenador($conexao,$escola,$_SESSION['ano_letivo']);
             

        
             foreach ($res as $key => $value) {

               $idturma=$value['idturma'];
               $idserie=$value['idserie'];
               $seguimento=$value['seguimento'];

               $nome_serie=$value['nome_serie'];
               $nome_turma=($value['nome_turma']);
               $idescola=($value['idescola']);
               $turno=($value['turno']);
           
           
                $result.="<tr>
                    <td>$nome_turma</td>
                    <td>";
                    $res_total=pesquisa_relatorio_filtro_quantidade_sexo($conexao,$escola,$ano_letivo,$idturma);
                    foreach ($res_total as $key => $value) {
                        $result.=" <b>".$value['sexo']." = ". $value['quantidade']."</b> <br>";
                    }
                    $result.="
                    </td> 
                </tr>";
            }

            $result.="
 
            </tbody>
    </table>
    ";


    $result.="
    <table class=table table-bordered table-striped' >
      
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
                if ($parametros[$i]=='data_nascimento') {
                        $dado = converte_data($value[$parametros[$i]]);

                }else{
                    $dado = $value[$parametros[$i]];
                }
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
            if ($parametros[$i]=='data_nascimento') {
                    $dado = converte_data($value[$parametros[$i]]);

            }else{
                $dado = $value[$parametros[$i]];
            }
            $result.="<td>$dado</td>";
          }
          $result.="</tr>";
          $conta++;
          
      }
    }
     
     
      if ($conta==1) {

        $result.="<tr> <td> NADA ENCONTRADO </td> </tr>";
      }
    
   

    
    
$result.="</tbody>    </table>
";



echo "$result";
    
} catch (Exception $exc) {
   //echo " VERIFIQUE SUA CONEXÃO COM A INTERNET";
   echo $exc;
}
?>