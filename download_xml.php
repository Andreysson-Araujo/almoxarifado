<?php
require_once("db.php");
require_once("dao/ItemDAO.php");

// Crie uma instância do ItemDAO
$itemDao = new ItemDAO($conn, $BASE_URL);

// Obtém todos os itens
$items = $itemDao->findAll();

// Cria o cabeçalho XML
$xml = '<?xml version="1.0" encoding="UTF-8"?>';
$xml .= '<items>';

// Adiciona cada item ao XML
foreach ($items as $item) {
    $xml .= '<item>';
    $xml .= '<name>' . $item->name . '</name>';
    $xml .= '<patrimony>' . $item->patrimony . '</patrimony>';
    $xml .= '<public_date>' . $item->public_date . '</public_date>';
    $xml .= '<register_as>' . $item->register_as . '</register_as>';
    $xml .= '<made_by>' . $item->made_by . '</made_by>';
    $xml .= '<observations>' . $item->observations . '</observations>';
    $xml .= '</item>';
}

$xml .= '</items>';

// Define os cabeçalhos para forçar o download do arquivo XML
header('Content-Type: application/xml');
header('Content-Disposition: attachment; filename="registros.xml"');

// Exibe o conteúdo do XML
echo $xml;
