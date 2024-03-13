<?php
require_once("db.php");
require_once("models/Items.php");
require_once("dao/ItemDAO.php");
require_once("models/Message.php");

require_once("globals.php");

$itemDao = new ItemDAO($conn, $BASE_URL);
$items = $itemDao->findAll();

include_once("templates/header.php");
?>

<div class="container-category">
    <h1 class="main-title">Registro de entrada e saída de itens</h1>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Patrimônio</th>
                    <th>Data de Registro</th>
                    <th>Registro de</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item) : ?>
                    <tr>
                        <td><?= $item->name ?></td>
                        <td><?= $item->patrimony ?></td>
                        <td><?= $item->public_date ?></td>
                        <td class="<?= ($item->register_as === 'Entrada') ? 'text-success' : 'text-danger' ?>">
                            <?= $item->register_as ?>
                        </td>
                        <td>
                            <a href="edititem.php?id=<?= $item->id ?>" class="btn btn-primary">Editar</a>
                            <!-- Formulário para exclusão -->
                            <form action="<?= $BASE_URL ?>showitens.php" method="POST" style="display: inline;">
                                <input type="hidden" name="delete_category_id" value="<?= $item->id ?>">
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="addItem.php" id="btnbtn" class="btn btn-success">Registrar novo item</a>
    </div>
</div>

<?php include_once("templates/footer.php") ?>
