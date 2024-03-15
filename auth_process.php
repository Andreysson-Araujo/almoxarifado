<?php

require_once("globals.php");
require_once("db.php");
require_once("models/User.php");
require_once("dao/UserDAO.php");
require_once("models/Message.php");
require_once("templates/header.php");
require_once("templates/footer.php");



$message = new Message($BASE_URL);

$userDao = new UserDAO($conn, $BASE_URL);


$type = filter_input(INPUT_POST, "type");

if($type == "register") {

  $name = filter_input(INPUT_POST, "name");
  $nickname = filter_input(INPUT_POST, "nickname");
  $email = filter_input(INPUT_POST, "email");
  $adm = filter_input(INPUT_POST, "user_is");
  $password = filter_input(INPUT_POST, "password");
  $confirmPassword = filter_input(INPUT_POST, "confirmpassword");
  

  if($name && $nickname && $email && $password && $adm !== null) {

    if($password === $confirmPassword) {

      //Verificar se o e-mail ja esta cadastrado no sistema
      if($userDao->findyByEmail($email) === false) {

       $user = new User();

       $userToken = $user->generateToken();
       $finalPassword = $user->generatePassword($password);

       $user->name = $name;
       $user->nickname = $nickname;
       $user->email = $email;
       $user->adm = $adm;
       $user->password = $finalPassword;
       $user->token = $userToken;

       $auth = true;

       $userDao->create($user);
       $message->setMessage("Usuário criado com sucesso!", "success", "back");

      } else {

        $message->setMessage("usuario cadastrado tente outro email.","error", "back");
      }

      
    } else{
      $message->setMessage("As senhas não são inguais","error", "back");
    }

  } else {
    $message->setMessage("Por favor prencha todos os campos", "error", "back");
  }

} else if ($type === "login") {
  $nickname = filter_input(INPUT_POST, "nickname");
  $password = filter_input(INPUT_POST, "password");

  // Tenta autenticar Usuario
  if($userDao->authenticateUser($nickname, $password)) {
   $message->setMessage("Seja bem-vindo!", "success", "editprofile.php");

  } else {
    //Redirecionar Usuario, se não conseguir autenticar
    $message->setMessage("Usuario e/ou senha incorretos", "error", "back");

  }
} else {
  $message->setMessage("Informações invalidas", "error", "back");
}