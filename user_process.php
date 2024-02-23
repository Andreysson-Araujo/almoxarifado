<?php
require_once("globals.php");
require_once("db.php");
require_once("models/User.php");
require_once("dao/UserDAO.php");
require_once("models/Message.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);

$type = filter_input(INPUT_POST, "type");
$password_type = filter_input(INPUT_POST, "password_type");

// Verificar tipo de operação
if ($type === "update") {
    // Resgatar dados do usuário
    $userData = $userDao->verifyToken();

    // Receber dados do post
    $name = filter_input(INPUT_POST, "name");
    $nickname = filter_input(INPUT_POST, "nickname");
    $email = filter_input(INPUT_POST, "email");

    // Criar um novo objeto de usuário
    $user = new User();

    // Preencher os dados do usuário
    $userData->name = $name;
    $userData->nickname = $nickname;
    $userData->email = $email;

    // Upload da imagem
    if (isset($_FILES['image']) && !empty($_FILES["image"]["tmp_name"])) {
        $image = $_FILES["image"];
        $imageTypes = ["image/jpeg", "image/jpg", "image/png"];

        // Checar tipo da imagem
        if (in_array($image["type"], $imageTypes)) {
            // Checar se é jpg
            if (in_array($image["type"], ["image/jpeg", "image/jpg"])) {
                $imageFile = imagecreatefromjpeg(($image["tmp_name"]));
            } else {
                $imageFile = imagecreatefrompng($image["tmp_name"]);
            }

            $imageName = $user->generateImageName();

            imagejpeg($imageFile, "./img/users/" . $imageName, 100);

            $userData->image = $imageName;
        } else {
            $message->setMessage("Tipo inválido de imagem, insira png ou jpg!", "error", "editprofile.php");
        }
    }

    $userDao->update($userData);

    }  else if($type === "changepassword") {

        // Receber dados do post
        $password = filter_input(INPUT_POST, "password");
        $confirmpassword = filter_input(INPUT_POST, "confirmpassword");
    
        // Resgata dados do usuário
        $userData = $userDao->verifyToken();
        
        $id = $userData->id;
    
        if($password == $confirmpassword) {
    
          // Criar um novo objeto de usuário
          $user = new User();
    
          $finalPassword = $user->generatePassword($password);
    
          $user->password = $finalPassword;
          $user->id = $id;
    
          $userDao->changePassword($user);
    
        } else {
          $message->setMessage("As senhas não são iguais!", "error", "back");
        }
    
      } else {
    
        $message->setMessage("Informações inválidas!", "error", "index.php");
    
      }
?>
