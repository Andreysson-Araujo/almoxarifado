<?php
require_once("db.php");
require_once("models/Items.php");
require_once("dao/ItemDAO.php");
require_once("models/Message.php");
require_once("globals.php");

$message = new Message($BASE_URL);
$itemDao = new ItemDAO($conn, $BASE_URL);

// Resgata o tipo do formulário
$type = filter_input(INPUT_POST, "type");

if ($type === "create") {
    $name = filter_input(INPUT_POST, "name");
    $patrimony = filter_input(INPUT_POST, "patrimony");
    $categories_id = filter_input(INPUT_POST, "category");
    $quantity = filter_input(INPUT_POST, "quantity");
    $register_as = filter_input(INPUT_POST, "register_as");
    $public_date = filter_input(INPUT_POST, "public_date");
    $made_by = filter_input(INPUT_POST, "made_by");
    $observations = filter_input(INPUT_POST, "observation");

    // Obtém a data atual no formato Y-m-d
    $currentDate = date("Y-m-d");

    // Converte as datas para o formato Y-m-d para garantir que a comparação seja correta
    $publicDateFormatted = date("Y-m-d", strtotime($public_date));

    // Verifica se a data informada é uma data futura
    if ($publicDateFormatted > $currentDate) {
        $message->setMessage("ERRO! Não é possível cadastrar uma data futura!", "error", "back");
    } else {
        // Verifica se o patrimônio já está em uso
        $stmt = $conn->prepare("SELECT * FROM items WHERE patrimony = :patrimony");
        $stmt->bindParam(":patrimony", $patrimony);
        $stmt->execute();
        $existingItem = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingItem) {
            $message->setMessage("ERRO! Já existe um item com este número de patrimônio!", "error", "back");
        } else {
            $item = new Item();
            $item->name = $name;
            $item->patrimony = $patrimony;
            $item->categories_id = $categories_id;
            $item->quantity = $quantity;
            $item->register_as = $register_as;
            $item->public_date = $public_date;
            $item->made_by = $made_by;
            $item->observations = $observations;

            $itemDao->create($item);
            $message->setMessage("Item criado com sucesso", "success", "showitens.php");
        }
    }
} elseif ($type === "update") {
    $itemId = filter_input(INPUT_POST, "item_id");
    

    if (!empty($itemId)) {
        $item = $itemDao->findById($itemId);

        if ($item) {
            $name = filter_input(INPUT_POST, "name");
            $patrimony = filter_input(INPUT_POST, "patrimony");
            $categories_id = filter_input(INPUT_POST, "category");
            $register_as = filter_input(INPUT_POST, "register_as");
            $public_date = filter_input(INPUT_POST, "public_date");
            $made_by = filter_input(INPUT_POST, "made_by");
            $observations = filter_input(INPUT_POST, "observation");

            $currentDate = date("Y-m-d");
            $publicDateFormatted = date("Y-m-d", strtotime($public_date));

            if ($publicDateFormatted > $currentDate) {
                $message->setMessage("ERRO! Não é possível cadastrar uma data futura!", "error", "back");
            } else {
                // Verifica se o patrimônio já está em uso, exceto para o item atual
                $stmt = $conn->prepare("SELECT * FROM items WHERE patrimony = :patrimony AND id != :id");
                $stmt->bindParam(":patrimony", $patrimony);
                $stmt->bindParam(":id", $itemId);
                $stmt->execute();
                $existingItem = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($existingItem) {
                    $message->setMessage("ERRO! Já existe um item com este número de patrimônio!", "error", "back");
                } else {
                    $item->name = $name;
                    $item->patrimony = $patrimony;
                    $item->categories_id = $categories_id;
                    $item->register_as = $register_as;
                    $item->public_date = $public_date;
                    $item->made_by = $made_by;
                    $item->observations = $observations;

                    $itemDao->update($item);
                    $message->setMessage("Item atualizado com sucesso", "success", "showitens.php");
                }
            }
        } else {
            $message->setMessage("Item não encontrado", "error", "showitens.php");
        }
    } else {
        $message->setMessage("ID do item não fornecido", "error", "showitens.php");
    }
} elseif ($type === "delete") {
    $itemId = filter_input(INPUT_POST, "delete_item_id");

    // Chama o método de exclusão no ItemDAO
    $itemDao->destroy($itemId);
} else {
    $message->setMessage("Tipo de operação inválido", "error", "back");
}
