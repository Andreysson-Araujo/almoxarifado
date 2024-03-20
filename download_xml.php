<?php
require 'vendor/autoload.php'; // Caminho para o autoload do Composer

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once("db.php");
require_once("dao/ItemDAO.php");

// Crie uma instância do ItemDAO
$itemDao = new ItemDAO($conn, $BASE_URL);

// Obtém todos os itens
$items = $itemDao->findAll();

// Cria uma nova instância da planilha
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Definir cabeçalhos
$sheet->setCellValue('A1', 'Nome');
$sheet->setCellValue('B1', 'Patrimônio');
$sheet->setCellValue('C1', 'Quantidade');
$sheet->setCellValue('D1', 'Data');
$sheet->setCellValue('E1', 'Registrar como');
$sheet->setCellValue('F1', 'Feito por');
$sheet->setCellValue('G1', 'Observações');

// Adiciona cada item à planilha
$row = 2; // Começa na linha 2, após o cabeçalho
foreach ($items as $item) {
    $sheet->setCellValue('A' . $row, $item->name);
    $sheet->setCellValue('B' . $row, $item->patrimony);
    $sheet->setCellValue('C' . $row, $item->quantity);
    $sheet->setCellValue('D' . $row, $item->public_date);
    $sheet->setCellValue('E' . $row, $item->register_as);
    $sheet->setCellValue('F' . $row, $item->made_by);
    $sheet->setCellValue('G' . $row, $item->observations);
    $row++;
}

// Cria um objeto de escrita para salvar a planilha
$writer = new Xlsx($spreadsheet);

// Define os cabeçalhos para forçar o download do arquivo Excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="registros.xlsx"');
header('Cache-Control: max-age=0');

// Salva o arquivo no buffer de saída
$writer->save('php://output');
