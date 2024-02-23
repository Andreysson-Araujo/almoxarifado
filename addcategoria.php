<?php
include_once("templates/header.php");
include_once("models/Category.php");
require_once("dao/UserDAO.php");
    ?>
<div class="container">
    <?php include_once("templates/backbtn.html"); ?>
    <h1 class="main-title">Adicionar Categoria</h1>
    <form id="create-form form-item" action="<?= $BASE_URL?>category_process.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="type" value="create">
        <div class="form-group">
            <label for="name">Nome da categoria:</label>
            <input type="text" class="form-control" id="category" name="category" placeholder="Digite o nome da categoria" required>
        </div>
        <button text="submit"  class="btn btn-primary">Registrar Categoria</button>
    </form>
</div>


<?php
include_once("templates/footer.php")
    ?>