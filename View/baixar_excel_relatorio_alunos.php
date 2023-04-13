<?php
// Importa a biblioteca PHPSpreadsheet
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Cria um array com os dados
$dados = array(
    array('Nome', 'Idade'),
  
);

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
header('Content-Disposition: attachment;filename="dados.xlsx"');
header('Cache-Control: max-age=0');

// Salva a planilha no formato Excel
$writer->save('php://output');
?>
