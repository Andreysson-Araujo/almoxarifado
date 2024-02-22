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

//atualizar usuario
    if($type === "update"){
        //Resgata dados do usuario
        $userData = $userDao->verifyToken();

        //receber dados do post
        $name = filter_input(INPUT_POST, "name");
        $nickname = filter_input(INPUT_POST, "nickname");
        $email = filter_input(INPUT_POST, "email");
    
        //Criar um novo objeto de usuario
        $user = new User();

        //Prencher os dados do usuario

        $userData->name = $name;
        $userData->nickname = $nickname;
        $userData->email = $email;

        //Upload da imagem
        if(isset($_FILES['image']) && !empty($_FILES["image"]["tmp_name"])) {
            
            $image = $_FILES["image"];

            if(in_array($image["type"], ["image/jpeg", "image/jpg", "image/png"])) {

                //chegar se jpg
                if(in_array($image["type"], ["image/jpeg", "image/jpg"])) {
                    $imageFile = imagecreatefromjpeg(($image["tmp_name"]));
                    
                 // Imagem é png  
                }else{

                    $imageFile = imagecreatefrompng($image["tmp_name"]);
                }

                $imageName = $user->generateImageName();

                imagejpeg($imageFile, "./img/users/" .$imageName, 100);

                $userData->image = $imageName;

            } else {
                $message->setMessage("Tipo invalido e imagem, insira png ou jpg!", "error", "editprofile.php");
            }
        }


        $userDao->update($userData);

        print_r($userData);
    
    //atualizar senha
    } else if($type === "changepassword") {
        $password = filter_input(INPUT_POST, "password");
        $confirmPassword = filter_input(INPUT_POST, "confirmpassword");
        $id = filter_input(INPUT_POST, "id");

        if($password == $confirmPassword) {

        } else {
            $message->setMessage("As senhas não sao iguais!", "error", "index.php");    
        }

        
    } else {
        $message->setMessage("Informações inválidas!", "error", "index.php");
    }
?>
