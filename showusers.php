<?php
require_once("db.php");
require_once("models/User.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");
require_once("globals.php");

$userDao = new UserDAO($conn, $BASE_URL);
$message = new Message($BASE_URL);

if (isset($_POST['delete_user_id'])) {
    $deleteUserId = $_POST['delete_user_id'];
    
    // Exclui o item
    $userDao->destroyUser($deleteUserId);
    
    // Define uma mensagem de sucesso para exibir ao usuário
    $this->$message->setMessage("Item apagado com sucesso!", "success", "showusers.php");
}

$users = $userDao->findAll();

include_once("templates/header.php");
?>

<div class="container-category">
    <h1 class="main-title">Gerenciamento de Usuarios</h1>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Nome </th>
                    <th>Usuario</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?= $user->name ?></td>
                        <td><?= $user->nickname ?></td>
                        <td>
                        <a href="edit_user.php?id=<?= $user->id ?>" class="btn btn-primary">Editar</a>
                            <!-- Formulário para exclusão -->
                            <form action="<?= $BASE_URL ?>showusers.php" method="POST" style="display: inline;">
                                <input type="hidden" name="delete_user_id" value="<?= $user->id ?>">
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
        <a href="add_user.php" id="btnbtn" class="btn btn-success">Registrar novo usuario</a>
    </div>
</div>

<?php include_once("templates/footer.php") ?>
