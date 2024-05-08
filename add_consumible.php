<?php
include_once("templates/header.php");
include_once("models/Categories.php");
require_once("dao/CategoryDAO.php");

$categoryDao = new CategoryDAO($conn, $BASE_URL);
$categories = $categoryDao->findAll();

?>
<div class="container">
    <?php include_once("templates/backbtn.html"); ?>
    <h1 class="main-title">Adicionar bem de consumo ou periferico</h1>
    <form id="create-form form-item" action="<?= $BASE_URL ?>item_process.php" method="POST">
        <input type="hidden" name="type" value="create">
        <div class="form-group">
            <label for="name">Nome do item:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Digite o nome do item" required>
        </div>
        
        <div class="form-group">
            <label for="category">Categoria:</label>
            <select name="category" id="category" class="form-control" required>
                <option value="">Selecione uma categoria</option> <!-- Correção aqui -->
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category->id ?>"><?= $category->category ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="quantity">Quantidade:</label>
            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Digite a quantidade de perifericos">
        </div>
        <div class="form-group">
            <label for="register_as">Registrar como:</label>
            <br>
            <input type="radio" name="register_as" id="entry" value="Entrada" class="form-radio" required>
            <label for="entry">Entrada</label>
            <input type="radio" name="register_as" id="exit" value="Saída" class="form-radio" required>
            <label for="exit">Saída</label>
        </div>

        <div class="form-group">
            <label for="date">Data:</label>
            <input type="date" name="public_date" id="public_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="user">Feito por:</label>
            <input type="text" class="form-control" id="made_by" name="made_by" value="<?= $userData->name ?>" readonly>
        </div>
        <div class="form-group">
            <label for="observations">Observações:</label>
            <textarea type="text" class="form-control" id="observations" name="observation" placeholder="Sobre esse item produto" rows="3"></textarea>
        </div>
        <button text="submit" id="btnbtn" class="btn btn-success">Registrar</button>
    </form>
</div>


<?php
include_once("templates/footer.php")
?>