<?php
require_once("db.php");
require_once("models/Categories.php");
require_once("models/Message.php");
require_once("dao/CategoryDAO.php");
require_once("globals.php");

$message = new Message($BASE_URL);
$categoryDao = new CategoryDAO($conn, $BASE_URL);

//resgata o tipo do formulario
$type = filter_input(INPUT_POST, "type");
$categoryName = filter_input(INPUT_POST, "category");
$categoryId = filter_input(INPUT_POST, "category_id");

if ($type === "create" && !empty($categoryName)) {
    $category = new Category();
    $category->category = $categoryName;
    
    $categoryDao->create($category);
} elseif ($type === "update") {

    
    $categoryName =  filter_input(INPUT_POST, "category");
    $categoryId = filter_input(INPUT_POST, "category_id");

    $category = new Category();
    $category->id = $categoryId;
    $category->category = $categoryName;

    $categoryDao->update($category);
    
} elseif ($type === "delete"){
    
    
    $category->id = $categoryId;

    // Chama o método de exclusão no CategoryDAO
    $categoryDao->destroy($category);
    

}else {
    $message->setMessage("Por favor preencha todos os campos", "error", "back");
}
?>
