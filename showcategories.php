<?php
require_once("db.php");
require_once("models/Categories.php");
require_once("dao/CategoryDAO.php");
require_once("models/Message.php");
require_once("globals.php");

$categoryDao = new CategoryDAO($conn, $BASE_URL);

// Obtém todas as categorias
$categories = $categoryDao->findAll();

include_once("templates/header.php");
?>

<div class="container-category">
    <h1 class="main-title">Lista de Categorias</h1>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Categoria</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category) : ?>
                    <tr>
                        <td><?= $category->category ?></td>
                        <td>
                            <a href="editcategory.php?id=<?= $category->id ?>" class="btn btn-primary">Editar</a>
                            <button class="btn btn-danger">Excluir</button>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
        <button type="submit" id="btnbtn" class="btn btn-success">Registrar nova categoria</button>
    </div>
</div>
<?php
    include_once("templates/footer.php")
?>