<?php
require_once("globals.php");
require_once("db.php");
require_once("models/Message.php");
include_once("templates/header.php");
require_once("dao/UserDAO.php");
?>

<div class="container-category">
    <h1 class="main-title">Qual Ação deseja realizar?</h1>
    <div class="modal-content">
        <div class="modal-body">
            <h3>Ação:</h3>
            <a href="add_user.php" class="btn btn-primary">Criar novo usuario</a>
            <a href="showusers.php" class="btn btn-primary">Ver Usuarios</a>
        </div>
    </div>
</div>


<?php
include_once("templates/footer.php");
?>