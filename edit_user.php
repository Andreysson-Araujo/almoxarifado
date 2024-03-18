<?php
require_once("templates/header.php");
require_once("dao/UserDAO.php");

// Verifica se foi fornecido um ID válido
if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $userId = $_GET["id"];

    // Instancia o DAO do usuário
    $userDao = new UserDAO($conn, $BASE_URL);

    // Busca as informações do usuário pelo ID
    $user = $userDao->findById($userId);
} else {
    // Redireciona se o ID não for válido
    header("Location: index.php");
    exit;
}
echo $userId;
?>

<div class="container">
    <?php include_once("templates/backbtn.html"); ?>
    <h1 class="main-title">Editar Usuário: <?= $user->name ?></h1>
    <form action="<?= $BASE_URL ?>update_user.php" method="POST">
        <input type="hidden" name="user_id" value="<?= $user->id ?>">
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $user->email ?>">
        </div>
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $user->name ?>">
        </div>
        <div class="form-group">
            <label for="nickname">Usuário:</label>
            <input type="text" class="form-control" id="nickname" name="nickname" value="<?= $user->nickname ?>">
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="<?= $BASE_URL ?>show_users.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
<?php
include_once("templates/footer.php");
?>
