<?php

// Importa a biblioteca PHPSpreadsheet
require 'View/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
try {
    


// Carregue o conteúdo HTML da tabela em uma string
$html = "<table>
<tr><th>Nome</th><th>Email</th>

</tr><tr><td>João</td><td>joao@email.com</td></tr>
</table>";

// Crie um novo objeto PhpSpreadsheet
$spreadsheet = new Spreadsheet();

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
    echo $e;
}
