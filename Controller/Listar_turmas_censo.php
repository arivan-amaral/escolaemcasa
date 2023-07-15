<?php session_start();
include'../Model/Conexao.php';
include'../Model/Coordenador.php';
require '../View/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

?>
<!-- <style>
  table {
    border-collapse: collapse;
  }

  td, th {
    border: 1px solid black;
    padding: 8px;
  }
</style>
 -->
<?php 
try {
  

  $idescola=$_GET['idescola'];
  if ($_SESSION['ano_letivo']==$_SESSION['ano_letivo_vigente']) {
    $res=listar_turmas_inicial_coordenador($conexao,$idescola,$_SESSION['ano_letivo']);
  }elseif ($_SESSION['ano_letivo']==2021) {
    $res=listar_turmas_coordenador_remoto($conexao,$idescola,$_SESSION['ano_letivo']);
  }else{
    $res=listar_turmas_coordenador($conexao,$idescola,$_SESSION['ano_letivo']);
  }

  $result="<table class=table table-bordered table-striped'>
  <tbody>
  <tr>
   
 
  <th>idprofessor </th>
  <th>nome professor </th>
  <th>idturma </th>
  <th>nome_turma </th>
  <th>idescola </th>
  <th>nome_disciplina </th>
  <th>iddisciplina </th>
  </th>
  ";
  $turno="";
  foreach ($res as $key => $value) {

    $idturma=$value['idturma'];
    $idserie=$value['idserie'];
    $seguimento=$value['seguimento'];

    $nome_serie=$value['nome_serie'];
    $nome_turma=($value['nome_turma']);
    $idescola=($value['idescola']);
    $nome_escola=($value['nome_escola']);
    if (isset($value['turno'])) {
        $turno=($value['turno']);
    }else{
      $turno="REMOTO";
    }
    
    

      
      $pes=listar_disciplina_da_turma_censo($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);

      foreach ($pes as $chave => $linha) {
        $idfuncionario=($linha['idfuncionario']);
        $nome_disciplina=($linha['nome_disciplina']);
        $iddisciplina=$linha['iddisciplina'];
        $nome=$linha['nome'];

        $result.= "
       <tr >
     
        <td>$idfuncionario</td>
         
         <td>$nome</td>
        <td>$idturma</td>
        
        
        <td>$nome_turma</td>
        
        <td>$idescola</td>
        <td>$nome_disciplina</td>
        <td>$iddisciplina</td>

        
        </a>      
        
        ";
      } 
 }
  $result.="
  </tbody>
  </table>";

  $html=$result;



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
                    header('Content-Disposition: attachment;filename="relatorio-de-alunos.xlsx"');
                    header('Cache-Control: max-age=0');

                    // Salva a planilha no formato Excel
                     $writer->save('php://output');


} catch (Exception $e) {
  echo "$e";
}
?>