<?php
session_start();
if (!isset($_SESSION['usuariobd'])) {
  // Se não estiver definida, atribui o valor padrão 'educ_lem'
  $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd = $_SESSION['usuariobd'];
include_once "../Model/Conexao_" . $usuariobd . ".php";
include_once '../Controller/Conversao.php';
include_once '../Model/Aluno.php';
include_once '../Model/Turma.php';
// include_once 'ata_resultado_final_funcao.php';


require '../View/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


$idturma=$_GET['idturma'];
$idescola=$_GET['idescola'];

$html = "<table class='table table-bordered table-striped'>
    <thead>
        <tr>
        <td>ALUNO(A)</td>
        <td>SEXO</td>
        <td>DATA DE NASCIMENTO</td>
        <td>DATA DE ENTRADA</td>
        <td>DATA DE SAÍDA</td>
        <td>OBSERVAÇÃO</td>
        </tr>
    </thead>
    <tbody>
    ";



$conta_aluno=1; 
$matricula_aluno="";

  $matricula="";
  $datasaida="";
  $data_matricula="";
// $res_alunos=listar_aluno_da_turma_ata_resultado_final($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);

  if ($_SESSION['ano_letivo']==$_SESSION['ano_letivo_vigente']) {
    $res_alunos=listar_aluno_da_turma_ata_resultado_final($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
  }else{
    $res_alunos=listar_aluno_da_turma_ata_resultado_final_matricula_concluida($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
  }

 foreach ($res_alunos as $key => $value) {

  $idaluno=$value['idaluno'];
  $datasaida=$value['datasaida'];
  $data_matricula=$value['data_matricula'];
  $nome_aluno=($value['nome_aluno']);
  $sexo_aluno=$value['sexo'];
  $data_nascimento=$value['data_nascimento'];
  $matricula_aluno=$value['matricula'];

  if ($conta_aluno%2==0) {
    $cor_linha="#E0E0E0";
  }else{
    $cor_linha="white";

  }

  if ($data_nascimento !='') {
    $data_nascimento=converte_data($data_nascimento);
  }

// pesquisar_aluno_da_turma_ata_resultado_final


 
      if ($datasaida!="") {
        $datasaida=converte_data($datasaida);
      }     
      if ($data_matricula!="") {
        $data_matricula=converte_data($data_matricula);
      }
  

$html .= "
        <tr>
        <td>$nome_aluno</td>
        <td>$sexo_aluno</td>
        <td>$data_nascimento</td>
        <td>$data_matricula</td>
        <td>$datasaida</td>
        <td></td>
        </tr>
    ";




}

$html .= "
    </tbody>
</table>";




// Crie um novo objeto PhpSpreadsheet
$spreadsheet = new Spreadsheet();
$html = "<meta charset='utf-8'>" . $html;

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

// Define o cabeçalho para download do arquivo
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="capa_da_turma.xlsx"');
header('Cache-Control: max-age=0');

// Salva a planilha no formato Excel
$writer->save('php://output');
?>
