<?php
require_once("globals.php");
require_once("db.php");
require_once("models/User.php");
require_once("dao/UserDAO.php");
require_once("models/Message.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);

$type = filter_input(INPUT_POST, "type");

// Verificar tipo de operação
if ($type === "update") {
    // Receber dados do post
    $userId = filter_input(INPUT_POST, "user_id");
    $name = filter_input(INPUT_POST, "name");
    $nickname = filter_input(INPUT_POST, "nickname");
    $email = filter_input(INPUT_POST, "email");

    // Criar um novo objeto de usuário
    $user = new User();

    // Preencher os dados do usuário
    $user->id = $userId;
    $user->name = $name;
    $user->nickname = $nickname;
    $user->email = $email;

    // Atualizar o usuário
    $userDao->update($user);

    // Redirecionar após a atualização
    header("Location: showusers.php");
    exit;
} else if ($type === "changepassword") {
    // Receber dados do post
    $password = filter_input(INPUT_POST, "password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

    // Resgatar dados do usuário
    $userData = $userDao->verifyToken();
    $id = $userData->id;

    if ($password == $confirmpassword) {
        // Criar um novo objeto de usuário
        $user = new User();

        // Gerar senha criptografada
        $finalPassword = $user->generatePassword($password);

        // Preencher os dados do usuário
        $user->password = $finalPassword;
        $user->id = $id;

        // Alterar a senha do usuário
        $userDao->changePassword($user);

        // Redirecionar após a alteração de senha
        header("Location: editprofile.php");
        exit;
    } else {
        // Senhas não coincidem
        $message->setMessage("As senhas não são iguais!", "error", "back");
    }
} else {
    // Tipo de operação inválido
    $message->setMessage("Informações inválidas!", "error", "back");
}
?>
