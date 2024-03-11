<?php
include_once("templates/header.php");
include_once("models/Categories.php");
require_once("dao/CategoryDAO.php");

$categoryDao = new CategoryDAO($conn, $BASE_URL);
$categories = $categoryDao->findAll();

?>
<div class="container">
    <?php include_once("templates/backbtn.html"); ?>
    <h1 class="main-title">Adicionar Item</h1>
    <form id="create-form form-item" action="<?= $BASE_URL?>item_process.php" method="POST">
        <input type="hidden" name="type" value="create">
        <div class="form-group">
            <label for="name">Nome do item:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Digite o nome do item" required>
        </div>
        <div class="form-group">
            <label for="phone">Patrimonio:</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Digite o numero de patrimonio se tiver" required>
        </div>
        <div class="form-group">
            <label for="email">Categoria:</label>
            <select name="" id="" class="form-control" required>
                <option value="">Selecione uma categoria</option>
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category->id ?>"><?= $category->category ?></option>
                    <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="email">Registrar como:</label>
            </br>
            <input type="radio" name="oi" id="" class="form-radio">Entrada
            <input type="radio" name="oi" id="" class="form-radio">Saida
        </div>
        <div class="form-group">
            <label for="date">Data:</label>
            <input type="date" name="" id="">
        </div>
        <div class="form-group">
            <label for="user">Feito por:</label>
            <input type="text" class="form-control" id="name" name="name"  value="<?= $userData->name ?>" readonly>
        </div>
        <div class="form-group">
            <label for="description">Observações:</label>
            <textarea type="text" class="form-control" id="observations" name="observation" placeholder="Sobre esse item produto" rows="3"></textarea>
        </div>
        <button text="submit" id="btnbtn" class="btn btn-primary">Registrar</button>
    </form>
</div>


<?php
include_once("templates/footer.php")
    ?>