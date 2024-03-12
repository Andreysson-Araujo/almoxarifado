<?php
include_once("models/Items.php");
include_once("models/Message.php");
include_once("dao/CategoryDAO.php");
require_once("dao/ItemDAO.php");
require_once("db.php");

$message = new Message($BASE_URL);
$itemDao = new ItemDAO($conn, $BASE_URL); // Aqui está o problema

// Resgata o tipo do formulário
$type = filter_input(INPUT_POST, "type");

if($type === "create") {

    print_r($_POST);

    $name = filter_input(INPUT_POST, "name");
    $patrimony = filter_input(INPUT_POST, "patrimony");
    $register_as = filter_input(INPUT_POST, "register_as");
    $public_date = filter_input(INPUT_POST, "public_date");
    $made_by = filter_input(INPUT_POST,"made_by");
    $observations = filter_input(INPUT_POST, "observation");

    $item = new Item();
    
    if(!empty($name) && !empty($patrimony)){
        $item->name = $name;
        $item->patrimony = $patrimony;
        $item->register_as = $register_as;
        $item->public_date = $public_date;
        $item->made_by = $made_by;
        $item->observations =$observations;

    } else {
        $message->setMessage("Você precisa preencher pelo menos o nome do produto e o patrimônio", "error", "back");
    }

    // $itemDao($item); // Esta linha não é necessária
    // print_r($_POST); print_r($_FILES); exit; // Remova esta linha, pois impedirá a execução do código abaixo

    $itemDao->create($item);
    // Aqui você pode adicionar qualquer lógica adicional, como redirecionar para outra página
    $message->setMessage("Informações válidas", "success", "back");
} else {
    $message->setMessage("Tipo de operação inválido", "error", "index.php");
}
?>
