<?php
session_start();
include_once '../Model/Conexao.php';
include_once '../Model/Escola.php';
include_once '../Model/Coordenador.php';
include_once 'Conversao.php';
// Importa a biblioteca PHPSpreadsheet
require '../View/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


try {

    $texto = $_GET['texto'];
    
    $ordenacao = $_GET['ordenacao'];
    $necessidade_especial = $_GET['necessidade_especial'];
    
    $operacao_cond_idade = $_GET['operacao_cond_idade'];
    $operacao_idade = $_GET['operacao_idade'];
    $data_minima_idade=data_minima_para_idade($operacao_idade);
    $data_maxima_idade=data_maxima_para_idade($operacao_idade);

     if ($operacao_cond_idade==">=") {//idade maior
        $data_nascimento =" AND  data_nascimento  <= '$data_maxima_idade' ";
    }elseif ($operacao_cond_idade==">=") {//idade menor
        $data_nascimento =" AND  data_nascimento  >= '$data_maxima_idade' ";
    }else{
        $data_nascimento =" AND ( data_nascimento  BETWEEN '$data_minima_idade'  and  '$data_maxima_idade' ) ";
    }
    if ($_GET['escola']=='Todas') {
     $escola = "  > 0  ";
      
    }else{
     $escola = "  = ".$_GET['escola']." ";
 
    }

    if ($ordenacao=="endereco") {
        $ordenacao="  aluno.bairro_endereco asc, aluno.endereco asc, aluno.nome asc ";
    }elseif ($ordenacao=="turma.nome_turma") {
        $ordenacao="  turma.nome_turma asc,  aluno.nome asc, aluno.endereco asc ";
    }else{
        $ordenacao="  aluno.nome asc ";

    }    

    if ($necessidade_especial=="Todos") {
        $necessidade_especial=" ";

    }else if ($necessidade_especial=="sim") {
        $necessidade_especial=" AND aluno.necessidade_especial='S'   ";
    }else{
        $necessidade_especial=" AND aluno.necessidade_especial !='S'   ";

    }


    $parametro = $_GET['parametro'];
    $titulo = $_GET['titulo'];
  
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
            
               $res=relatorio_turmas_inicial_coordenador($conexao,$escola,$_SESSION['ano_letivo']);
             

        
             foreach ($res as $key => $value) {

               $idturma=$value['idturma'];
               $idserie=$value['idserie'];
               $seguimento=$value['seguimento'];

               $nome_serie=$value['nome_serie'];
               $nome_turma=($value['nome_turma']);
               $idescola=($value['idescola']);
               $turno=($value['turno']);
           
           
                    $res_total=relatorio_pesquisa_relatorio_filtro_quantidade_sexo($conexao,$escola,$ano_letivo,$idturma,$necessidade_especial, $data_nascimento);
                    foreach ($res_total as $key => $value) {
                        $result.="<tr>
                            <td>$nome_turma</td>
                            <td>";
                                $result.=" <b>".$value['sexo']." = ". $value['quantidade']."</b> <br>";
                            $result.="
                            </td> 
                        </tr>";
                    }
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

     $cabecalho_excel=array();
     $dados_excel=array();
         array_push($cabecalho_excel,'#');

      foreach ($titulos as $key => $value) {
         $result.="<th  style='text-align: center;'>".$titulos[$key]."</th>";
          
         array_push($cabecalho_excel,$titulos[$key]);
      }
        
    // array_push($dados_excel,$cabecalho_excel);
        
    $result.="</tr>
    </thead>
    <tbody>
    ";

    $conta=1;
    $tamanho = count($parametros);
    $result.="<tr>";
    if($sexo == "todos"){
    $res_matriculas = relatorio_pesquisa_relatorio_filtro_todos($conexao,$texto,$escola,$ano_letivo,$necessidade_especial, $data_nascimento,$ordenacao);
        
         
          foreach ($res_matriculas as $key => $value) {
                $result.="<td>$conta</td>";

               for ($i=0; $i < $tamanho; $i++) { 
                if ($parametros[$i]=='data_nascimento') {
                        $dado = converte_data($value[$parametros[$i]]);

                }else{
                    $dado = $value[$parametros[$i]];
                }
                $result.="<td>$dado</td>";

                array_push($dados_excel,array($conta,$dado));



              }
              $result.="</tr>";
                

              $conta++;
              
          }
      // echo "$result";



    }else{
       $res_matriculas = relatorio_pesquisa_relatorio_filtro($conexao,$texto,$sexo,$escola,$ano_letivo,$ordenacao,$necessidade_especial, $data_nascimento);
    
     
      foreach ($res_matriculas as $key => $value) {
        


            $result.="<td>$conta</td>";

          for ($i=0; $i < $tamanho; $i++) { 
            if ($parametros[$i]=='data_nascimento') {
                    $dado = converte_data($value[$parametros[$i]]);

            }else{
                $dado = $value[$parametros[$i]];
            }
            $result.="<td>$dado</td>";
            array_push($dados_excel,array($conta,$dado));
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


if ($_GET['excel']!=1) {
    echo "$result";
}


if ($_GET['excel']==1) {

        // Cria um array com os dados
        $dados = array(
            $cabecalho_excel
          
        );
        // $dados_excel
        $dados_aux=array();
        for ($i=0; $i < count($dados_excel); $i++) { 
            array_push($dados_aux,$dados_excel[0][$i]);
echo $dados_excel[0][$i]."<br><br><br>";
              
            if ($i%count($cabecalho_excel)==0) {
                 array_push($dados,$dados_aux);
                $dados_aux=array();

            }
        }

// var_dump($cabecalho_excel);
// echo "<br><br><br><br><br><br><br><br><br>";
 print_r($dados_excel);
exit();


        // Cria um objeto Spreadsheet
        $spreadsheet = new Spreadsheet();

        // Define o título da planilha
        $spreadsheet->getActiveSheet()->setTitle('Relatorio de alunos');

        // Define os dados na planilha
        $spreadsheet->getActiveSheet()->fromArray($dados, null, 'A1');

        // Cria um objeto Writer para salvar a planilha em formato Excel
        $writer = new Xlsx($spreadsheet);

        // Define o cabeçalho para download do arquivo
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="relatorio-de-alunos.xlsx"');
        header('Cache-Control: max-age=0');

        // Salva a planilha no formato Excel
         $writer->save('php://output');
}

    
} catch (Exception $exc) {
   //echo " VERIFIQUE SUA CONEXÃO COM A INTERNET";
   echo $exc;
}
?>