<?php
require_once("db.php");
require_once("models/Items.php");
require_once("dao/ItemDAO.php");
require_once("models/Message.php");

require_once("globals.php");

$itemDao = new ItemDAO($conn, $BASE_URL);
$message = new Message($BASE_URL);

// Verifica se um item deve ser excluído
if (isset($_POST['delete_item_id'])) {
    $deleteItemId = $_POST['delete_item_id'];
    
    // Exclui o item
    $itemDao->destroy($deleteItemId);
    
    // Define uma mensagem de sucesso para exibir ao usuário
    $message->setMessage("Item apagado com sucesso!", "success", "showitens.php");
}

// Obtém todos os itens
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
                    <th>Quantidade</th>
                    <th>Registro de</th>
                    <th>Feito por</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item) : ?>
                    <tr>
                        <td><?= $item->name ?></td>
                        <td><?= !empty($item->patrimony) ? $item->patrimony : "<strong>Não tem</strong>" ?></td>
                        <td><?= $item->public_date ?></td>
                        <td><?= $item->quantity ?></td>
                        <td class="<?= ($item->register_as === 'Entrada') ? 'text-success' : 'text-danger' ?>">
                            <?= $item->register_as ?>
                        </td>
                        <td><?= $item->made_by ?></td>
                        <td>
                            <a href="edititem.php?id=<?= $item->id ?>" class="btn btn-primary">Editar</a>
                            <!-- Formulário para exclusão -->
                            <form action="<?= $BASE_URL ?>showitens.php" method="POST" style="display: inline;">
                                <input type="hidden" name="delete_item_id" value="<?= $item->id ?>">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza de que deseja excluir este item?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="choseTypeitem.php" id="btnbtn" class="btn btn-success">Registrar novo item</a>
        <a href="download_xml.php" id="btnbtn" class="btn btn-secondary">Baixar registros </a>

    </div>
</div>

<?php include_once("templates/footer.php") ?>
