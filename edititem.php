<?php
require_once("templates/header.php");
require_once("models/Items.php");
require_once("dao/ItemDAO.php");
require_once("dao/CategoryDAO.php");

if (isset($_GET["id"])) {
    $itemId = $_GET["id"];

    $itemDao = new ItemDAO($conn, $BASE_URL);
    $item = $itemDao->findById($itemId);
}
$categoryDao = new CategoryDAO($conn, $BASE_URL);
$categories = $categoryDao->findAll();
include_once("templates/header.php");
?>

<div class="container">
    <?php include_once("templates/backbtn.html"); ?>
    <h1 class="main-title">Editar Item: </h1>
    <form action="<?= $BASE_URL ?>item_process.php" method="POST">
        <input type="hidden" name="type" value="update">
        <input type="hidden" name="item_id" value="<?= $item->id ?>">
        <div class="form-group">
            <label for="name">Nome do Item a ser editado:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $item->name ?>">
        </div>

        <div class="form-group">
            <label for="patrimony">Patrimônio a ser editado:</label>
            <input type="text" class="form-control" id="patrimony" name="patrimony" value="<?= $item->patrimony ?>">
        </div>
        <div class="form-group">
            <label for="quantity">Quantidade:</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="<?= $item->quantity?>">
        </div>

        <div class="form-group">
            <label for="category">Categoria a ser editada:</label>
            <select name="category" id="category" class="form-control">
                <?php foreach ($categories as $category) : ?>
                    <?php if ($category->id === $item->categories_id) : ?>
                        <option value="<?= $category->id ?>" selected><?= $category->category ?></option>
                    <?php else : ?>
                        <option value="<?= $category->id ?>"><?= $category->category ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="register_as">Registrar como:</label>
            <br>
            <input type="radio" name="register_as" id="entry" value="Entrada" class="form-radio" <?= ($item->register_as === 'Entrada') ? 'checked' : '' ?> required>
            <label for="entry">Entrada</label>
            <input type="radio" name="register_as" id="exit" value="Saída" class="form-radio" <?= ($item->register_as === 'Saída') ? 'checked' : '' ?> required>
            <label for="exit">Saída</label>
        </div>

        <div class="form-group">
            <label for="public_date">Data:</label>
            <input type="date" name="public_date" id="public_date" class="form-control" value="<?= $item->public_date ?>" required>
        </div>

        <div class="form-group">
            <label for="made_by">Usuario que vai registrar edição:</label>
            <input type="text" class="form-control" id="made_by" name="made_by" value="<?= $userData->name ?>" readonly>
        </div>

        <div class="form-group">
            <label for="observations">Observações:</label>
            <textarea class="form-control" id="observations" name="observation" rows="3"><?= $item->observations ?></textarea>
        </div>

        <button type="submit" id="btnbtn" class="btn btn-primary">Salvar Alterações</button>
        <a href="<?= $BASE_URL ?>showitens.php" id="btnbtn" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
<?php
include_once("templates/footer.php")
?>