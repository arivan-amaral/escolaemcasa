<?php
set_time_limit(0);
session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Escola.php';
include_once '../Model/Serie.php';

// Importa a biblioteca PHPSpreadsheet
require '../View/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

try {

    $data_inicial = $_GET['data_inicial'];
    $data_final = $_GET['data_final'];

    if ($_GET['escola']=='todas') {
     $escola = "ecidade_matricula.turma_escola >0  ";
      
    }else{
     $escola = " ecidade_matricula.turma_escola = ".$_GET['escola']." ";
 
    }
   
      $serie_id =$_GET['serie'];
   

if ($_GET['serie'] == 1 ) {
  $serie_id = " turma.serie_id >= 1 and turma.serie_id <= 2 ";
} else if ($_GET['serie'] == 2) {
  $serie_id = " turma.serie_id >= 3 and turma.serie_id <= 7 ";
} else if ($_GET['serie'] == 3) {
  $serie_id = " turma.serie_id >= 8 and turma.serie_id <= 11 ";
} else if ($_GET['serie'] == 4) {
  $serie_id = " turma.serie_id >= 12 and turma.serie_id <= 15 ";
} else if ($_GET['serie'] == 5) {
  $serie_id = " turma.serie_id = 16 ";
} else {
  $serie_id = " turma.serie_id>0 "; // nenhuma condição foi satisfeita
}




            if ($_GET['serie'] == 'todos') {
                $serie_inicial=1;
                $serie_final=16;
              }
              else if ($_GET['serie'] == '1') {
                $serie_inicial=1;
                $serie_final=2;
              }
              else if ($_GET['serie'] == '2') {
                $serie_inicial=3;
                $serie_final=7;
              }
              else if ($_GET['serie'] == '3') {
                $serie_inicial=8;
                $serie_final=11;
              }
              else if ($_GET['serie'] == '4') {
               $serie_inicial=12;
                $serie_final=15;
              }
              else if ($_GET['serie'] == '5') {
               $serie_inicial=16;
                $serie_final=16;
              }



    $ano_letivo = $_SESSION['ano_letivo'];

    $html="<table>";
    $html_pot_turma="";


    $result="
   <thead>
      <tr>
        <th  style='text-align: center;'>Série/Turma</th>
        
      </tr>
    </thead>
    <tbody>
    ";

    $conta=0;

    if ( $data_inicial != "") {

    
       $res_matriculas = pesquisa_matricula_mensal($conexao,$escola,$serie_id,$_SESSION["ano_letivo"]);
      $id_turma_passado = 0;
      $total_alunos = 0;
      $total_alunos_escola = 0;
      $total_matriculas = 0;

      $array_quant_anterior = array();
      $array_quant_matriculas = array();
      $array_quant_total = array();
      $result_por_turma=array();
      $result_por_escola_antigas=array();
      $result_por_escola_novas=array();
      $result_por_escola_total=array();
      $array_controle_escola_serie_turma=array();
      $nome_generico_turma_aux="";
      $nome_generico_turma="";
      foreach ($res_matriculas as $key => $value) {
          $turma = $value['turma_id'];
          $quant_matriculas = 0;
          $quant_total = 0;
          $nome_serie = "";
          $serie_id = $value['serie_id'];
          $nome_turma = $value['nome_turma'];
          $nome_escola = $value['nome_escola'];
          $idescola = $value['turma_escola'];
          $idturma = $value['idturma'];
          $escola = " ecidade_matricula.turma_escola = $idescola";

          //12/04/2023



          if (!array_key_exists($serie_id, $result_por_turma)) {
            $result_por_turma[$serie_id]=null;

          }
          if (!array_key_exists($serie_id, $array_quant_anterior)) {
            $array_quant_anterior[$serie_id]=0;

          }
          if (!array_key_exists($serie_id, $array_quant_matriculas)) {
            $array_quant_matriculas[$serie_id]=null;

          }

          if (!array_key_exists($serie_id, $array_quant_total)) {
            $array_quant_total[$serie_id]=null;

          }

          if ($id_turma_passado !=  $turma) {
            //
            $res_anterior = pesquisa_matricula_mensal_quant_anterior($conexao,$escola,$turma,$ano_letivo);
            foreach ($res_anterior as $key => $value) {
              $quant_total = $value['alunos'];
            }
            //
            $res_matriculas_quant = pesquisa_matricula_mensal_quant($conexao,$data_inicial,$data_final,$escola,$turma);
                  foreach ($res_matriculas_quant as $key => $value_q) {
                      $quant_matriculas = $value_q['alunos'];
                  }
        

          $quant_anterior =  $quant_total - $quant_matriculas;
          if ($quant_matriculas>0) {
            $cor="text-red";
             $cor_card="text-info";

          }else{
            $cor="";
             $cor_card="";

          }

          $array_nome_turma = explode(" ", $nome_turma);
          $nome_generico_turma=$array_nome_turma[0]." ".$array_nome_turma[1];



 $result_por_turma[$serie_id]=$result_por_turma[$serie_id]."<br> <b class='$cor_card'>$nome_escola</b><br> $nome_turma - Anterior = $quant_anterior + Novas=<b class='$cor'>$quant_matriculas</b> Total=$quant_total  <br>";
 
 $html_pot_turma.="<tr>";
     $html_pot_turma.="<td>";
      $html_pot_turma.="$nome_escola";
     $html_pot_turma.="</td>";

      $html_pot_turma.="<td>";
        $html_pot_turma.=" $nome_turma - Anterior = $quant_anterior + Novas=$quant_matriculas Total=$quant_total";
      $html_pot_turma.="</td>";
 $html_pot_turma.="</tr>";

      $res_por_serie_escola=pesquisa_matricula_mensal_quant_nome_generico_turma($conexao,$ano_letivo,$escola,$nome_generico_turma);

if ( !array_key_exists("$idescola$nome_generico_turma", $array_controle_escola_serie_turma)) {
     
     foreach ($res_por_serie_escola as $key => $value) {
        $result_por_turma[$serie_id].="<b>Total  $nome_generico_turma : ".$value['total_serie_escola']."</b><br>";
      }
    $array_controle_escola_serie_turma["$idescola$nome_generico_turma"]="$idescola$nome_generico_turma";
}


    
          $array_quant_anterior[$serie_id]=$array_quant_anterior[$serie_id]+$quant_anterior;
          $array_quant_matriculas[$serie_id]=$array_quant_matriculas[$serie_id]+$quant_matriculas;
          $array_quant_total[$serie_id]=$array_quant_total[$serie_id]+$quant_total;


          $id_turma_passado = $turma;
          }
          
          $total_alunos += $quant_total;
          $total_matriculas += $quant_matriculas;
          $conta++;

        


      }
      
      if ($conta==0) {

        $result.="<tr> <td> NADA ENCONTRADO </td> </tr>";
      }else{

          $res_series=pesquisar_serie_por_intervalo($conexao,$serie_inicial, $serie_final);

        foreach ($res_series as $key => $value) {
          $idserie=$value['id'];
          $nome_serie=$value['nome'];
          $serie_id = " turma.serie_id = $idserie ";

 

      // if ($array_quant_anterior[$idserie]>0) {
         if (isset($array_quant_anterior[$idserie])) {

           if ($array_quant_matriculas[$idserie]>0) {
             $cor_card="info";
           }else{
             $cor_card="";

           }

$html.="<tr>";
  $html.="<td>";
    $html.="$nome_serie";
  $html.="</td>";

  $html.="<td>";
    $html.="Total=".$array_quant_total[$idserie]."";
  $html.="</td>";
$html.="</tr>";

$html.=$html_pot_turma;

$html.="</table>";

          $result.="
            <tr>
              <td>

              <div class='card card-$cor_card collapsed-card'>
                              <div class='card-header' data-card-widget='collapse'>
                                <h3 class='card-title'>$nome_serie Total=".$array_quant_total[$idserie]."</h3>

                                <div class='card-tools'>
                                  <button type='button' class='btn btn-tool' data-card-widget='collapse'>
                                    <i class='fas fa-plus'></i>
                                  </button>
                                </div>               
                              </div>

                              <div class='card-body' style='display: none;'>
                              <div class='card-body'>
                                
                                
                                  ".$result_por_turma[$idserie]."
                                   
                                </div>
                          </div>
                       </div>
                 </div>

              </td>
            </tr>";
        }
          //       $result_por_turma
          //     ".$array_quant_anterior[$idserie]."</td>";
          // $result.="<td>".$array_quant_matriculas[$idserie]."</td>";
          // $result.="<td>".$array_quant_total[$idserie]."</td>";
          // $result.="</tr>";
        }
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
      <!-- <h5>TOTAL ALUNOS NA ESCOLA: $total_alunos_escola</h5> -->
    </div>
  </div>
  <br>
  <div class='row'>
    <div class='col-sm-12'>
      <h5>TOTAL MATRICULAS NOVAS: $total_matriculas</h5>
    </div>
  </div>";


if ($_GET['excel']!=1) {
  echo "$result";
    
}else if ($_GET['excel']==1) {

//    echo  htmlentities($html);
// exit();
         // Crie um novo objeto PhpSpreadsheet
         $spreadsheet = new Spreadsheet();
         $html="<meta charset='utf-8'>".$html;
         // Crie uma nova planilha e defina-a como a planilha ativa
         $worksheet = $spreadsheet->getActiveSheet();

         // Analise o conteúdo HTML da tabela usando a classe DOMDocument do PHP
         $dom = new DOMDocument();
         $dom->loadHTML($html);
         $tables = $dom->getElementsByTagName('table');
         $rows = $tables->item(0)->getElementsByTagName('tr');

         // Percorra as linhas da tabela HTML e adicione os dados na planilha do Excel
         $rowIndex = 1;
         foreach ($rows as $row) {
             $cellIndex = 1;
             $cells = $row->getElementsByTagName('td');
             foreach ($cells as $cell) {
                 $value = $cell->nodeValue;
                 $worksheet->setCellValueByColumnAndRow($cellIndex, $rowIndex, $value);
                 $cellIndex++;
             }
             $rowIndex++;
         }

         // Salve o arquivo Excel no formato desejado
         $writer = new Xlsx($spreadsheet);
        
                  // $writer->save('planilha.xlsx');

         // Define o cabeçalho para download do arquivo
                 header('Content-Type: application/vnd.ms-excel');
                 header('Content-Disposition: attachment;filename="relatorio-mensal-matricula.xlsx"');
                 header('Cache-Control: max-age=0');

                 // Salva a planilha no formato Excel
                  $writer->save('php://output');
}


} catch (Exception $exc) {
   //echo " VERIFIQUE SUA CONEXÃO COM A INTERNET";
   echo $exc;
}
?>