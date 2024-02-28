<?php
require_once("db.php");
require_once("models/Categories.php");
require_once("dao/CategoryDAO.php");
require_once("models/Message.php");

require_once("globals.php");

$categoryDao = new CategoryDAO($conn, $BASE_URL);
$message = new Message($BASE_URL);

// Verifica se foi enviado o ID da categoria a ser excluída
if (isset($_POST['delete_category_id'])) {
    $deleteCategoryId = $_POST['delete_category_id'];
    
    // Obtém os detalhes da categoria antes de excluir (opcional, apenas para registro)
    $categoryToDelete = $categoryDao->findById($deleteCategoryId);
    
    // Exclui a categoria
    $categoryDao->destroy($deleteCategoryId);
    

    // Define uma mensagem de sucesso para exibir ao usuário
    $this->message->setMessage("Categoria apagada com sucesso!", "success", "editprofile.php");
}

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
                            <!-- Formulário para exclusão -->
                            <form action="<?= $BASE_URL ?>showcategories.php" method="POST" style="display: inline;">
                                <input type="hidden" name="delete_category_id" value="<?= $category->id ?>">
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="addcategoria.php" id="btnbtn" class="btn btn-success">Registrar nova categoria</a>
    </div>
</div>

<?php include_once("templates/footer.php") ?>
