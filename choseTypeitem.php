<?php
require_once("globals.php");
require_once("db.php");
require_once("models/Message.php");
include_once("templates/header.php");
require_once("dao/UserDAO.php");
?>

<div class="container-category">
    <h1 class="main-title">Escolha o tipo de item</h1>
    <div class="modal-content">
        <div class="modal-body">
            <h3>Tipo de item:</h3>
            <a href="addItem.php?type=equipment" class="btn btn-primary">Equipamento</a>
            <a href="add_consumible.php?type=consumable" class="btn btn-primary">Bem de Consumo</a>
            <a href="add_consumible.php?type=consumable" class="btn btn-primary">Perifericos</a>
        </div>
    </div>
</div>


<?php
include_once("templates/footer.php");
?>