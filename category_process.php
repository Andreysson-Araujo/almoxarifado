<?php
require_once("db.php");
require_once("models/Categories.php");
require_once("models/Message.php");
require_once("dao/CategoryDAO.php");
require_once("globals.php");

$message = new Message($BASE_URL);
$categoryDao = new CategoryDAO($conn, $BASE_URL);

$type = filter_input(INPUT_POST, "type");
$categoryName = filter_input(INPUT_POST, "category");

if ($type === "create" && !empty($categoryName)) {
    $category = new Category();
    $category->category = $categoryName;
    
    $categoryDao->create($category);
} else {
    $message->setMessage("Por favor preencha todos os campos", "error", "back");
}
?>
