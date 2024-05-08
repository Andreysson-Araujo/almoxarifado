<?php
require_once("globals.php");
//require_once("db.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");


$message = new Message($BASE_URL);

$flassMessage = $message->getMessage();

if(!empty($flassMessage["msg"])) {
    // limpar msg
    $message->clearMessage();
}

/*
//erro atual nessas linhas
$userDao = new UserDAO($conn, $BASE_URL);

$userData = $userDao->verifyToken(false);
*/

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8" />
    <title>Organize</title>
    <link rel="short icon" href="<?= $BASE_URL ?>img/moviestar.ico" type="image/x-icon">
    <!--BOOTSTRAP-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.css"
        integrity="sha512-drnvWxqfgcU6sLzAJttJv7LKdjWn0nxWCSbEAtxJ/YYaZMyoNLovG7lPqZRdhgL1gAUfa+V7tbin8y+2llC1cw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--FONT AWESOME--->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--CSS-->
    <link rel="stylesheet" href="<?= $BASE_URL ?>css/styles.css">
</head>

<body>
