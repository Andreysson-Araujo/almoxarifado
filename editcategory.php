<?php
require_once("templates/header.php");
require_once("models/Categories.php");
require_once("dao/CategoryDAO.php");

$category = new Category();

$categoryDao = new CategoryDAO($conn, $BASE_URL);




?>
<!-- Aqui você pode incluir o formulário de edição preenchido com os detalhes da categoria -->
<div class="container">
    <h1 class="main-title">Editar Categoria</h1>
    <form action="<?= $BASE_URL ?>category_process.php" method="POST">
        <input type="hidden" name="category_id" value="<?= $category->id ?>">
        <div class="form-group">
            <label for="category">Nome da Categoria:</label>
            <input type="text" class="form-control" id="category" name="category" value="<?= $ca ?>">
        </div>
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </form>
</div>

