<?php
    require_once("db.php");
    require_once("models/Categories.php");
    require_once("models/Message.php");
    //require_once("dao/CategoryDao.php");
    require_once("globals.php");

    $type = filter_input(INPUT_POST, "type");
    $categoryName = filter_input(INPUT_POST, "category");

    if($type === "create" && !empty($categoryName)) {
        $category = filter_input(INPUT_POST, "category ");

        $category = new Category();

        $category->category = $categoryName;
        
        echo $categoryName;
    } 

?>