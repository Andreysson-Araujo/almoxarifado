<?php
require_once("globals.php");
require_once("db.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");


$message = new Message($BASE_URL);

$flassMessage = $message->getMessage();

if (!empty($flassMessage["msg"])) {
    // limpar msg
    $message->clearMessage();
}

//erro atual nessas linhas
$userDao = new UserDAO($conn, $BASE_URL);

$userData = $userDao->verifyToken(false);

// Obter os dados do usuário logado
if ($userData) {
    $is_admin = $userDao->isAdmin($userData->id);
}


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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.css" integrity="sha512-drnvWxqfgcU6sLzAJttJv7LKdjWn0nxWCSbEAtxJ/YYaZMyoNLovG7lPqZRdhgL1gAUfa+V7tbin8y+2llC1cw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--FONT AWESOME--->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--CSS-->
    <link rel="stylesheet" href="<?= $BASE_URL ?>css/styles.css">
</head>
<body>
    <header>
        <nav id="main-navbar" class="navbar navbar-expand-lg">
            <a href="<?= $BASE_URL ?>/showitens.php" class="navbar-brand">
                <img src="<?= $BASE_URL ?>img/logo.png" alt="MovieStar" id="logo">
                <span id="organize-title"></span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" area-label="Toggle navigation">
                <i class="fas fa-bars"> </i>
            </button>
            <!--<form action="" method="GET" id="search-form" class="form-inline my-2 my-lg-0">
                <input type="text" name="q" id="search" class="form-control mr-sm-2" type="search" placeholder="Buscar item" aria-label="Search">
                <button class="btn my-2 my-sm-0" type="submit">
                    <i class="fas fa-search"></i>
                </button>

            </form> -->
            
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav">
                    <?php if ($userData) : ?>
                        <li class="nav-item">
                            <a href="<?= $BASE_URL ?>choseTypeitem.php" class="nav-link"><i class="far fa-plus-square"></i>Add item</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $BASE_URL ?>showitens.php" class="nav-link">Ver items</a>
                        </li>
                        <li class="nav-item">
                        </li>
                        <li class="nav-item">
                            <a href="<?= $BASE_URL ?>showcategories.php" class="nav-link">Categorias</a>
                        </li>
                        <?php if ($is_admin) : ?>
                        <li class="nav-item">
                            <a href="<?= $BASE_URL ?>choseOptionsUser.php" class="nav-link">Usuarios</a>
                        </li>
                    <?php endif; ?>
                        <li class="nav-item">
                            <a href="<?= $BASE_URL ?>editprofile.php" class="nav-link"><strong><?= $userData->name ?></strong></a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $BASE_URL ?>logout.php" class="nav-link">Sair</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>
    <?php if (!empty($flassMessage["msg"])) : ?>
        <div class="msg-container">
            <p class="msg <?= $flassMessage['type'] ?>"><?= $flassMessage["msg"] ?></p>
        </div>
    <?php endif; ?>